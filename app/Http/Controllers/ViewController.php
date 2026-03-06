<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ViewController extends Controller
{
    // Credenciales de Firebase
    private $key = "AIzaSyDp_V5toh_KO4R7SDm4lHNKP4OHYBIrwRI";
    private $baseUrl = "https://firestore.googleapis.com/v1/projects/mi-pagina-ec6da/databases/(default)/documents/";

    /* ============================================================
       1. GESTIÓN DE NIÑOS (VISTAS DE ADMIN Y PADRE)
       ============================================================ */

    // Ver todos los niños en el panel de Administrador
    public function verTodosLosNinos() {
        $url = $this->baseUrl . "Ninios?key=" . $this->key;
        $response = Http::get($url)->json();
        
        $ninos = [];
        if (isset($response['documents'])) {
            foreach ($response['documents'] as $doc) {
                $f = $doc['fields'];
                $path = explode('/', $doc['name']);
                
                // Conversión de datos (Firebase los trae como string o int)
                $peso = (float)($f['peso']['stringValue'] ?? ($f['peso']['integerValue'] ?? 0));
                $tallaRaw = (float)($f['estatura']['stringValue'] ?? ($f['estatura']['integerValue'] ?? 0));
                
                // Normalización: si mide 170 (cm), pasamos a 1.70 (m)
                $talla = ($tallaRaw > 3) ? ($tallaRaw / 100) : $tallaRaw;
                $imc = ($talla > 0) ? round($peso / ($talla * $talla), 1) : 0;

                $ninos[] = [
                    'id'     => end($path),
                    'nombre' => ($f['nombre']['stringValue'] ?? '') . ' ' . ($f['apellido']['stringValue'] ?? ''),
                    'correo' => $f['id_padre']['stringValue'] ?? 'Sin tutor',
                    'edad'   => $f['edad']['integerValue'] ?? ($f['edad']['stringValue'] ?? 0),
                    'peso'   => $peso,
                    'talla'  => $talla,
                    'imc'    => $imc,
                    'genero' => ($f['sexo']['stringValue'] ?? '') == 'masculino'
                ];
            }
        }
        return view('ver_ninos', compact('ninos'));
    }

    // Ver solo los hijos del padre que inició sesión
    public function verHijosRegistrados() {
        $padreId = session('user_id');
        $response = Http::get($this->baseUrl . "Ninios?key=" . $this->key)->json();
        
        $todosLosNinios = [];
        if (isset($response['documents'])) {
            foreach ($response['documents'] as $doc) {
                $f = $doc['fields'];
                if (isset($f['id_padre']['stringValue']) && $f['id_padre']['stringValue'] == $padreId) {
                    $peso = (float)($f['peso']['stringValue'] ?? 0);
                    $tallaRaw = (float)($f['estatura']['stringValue'] ?? 0);
                    $tallaM = ($tallaRaw > 3) ? ($tallaRaw / 100) : $tallaRaw;
                    $imc = ($tallaM > 0) ? ($peso / ($tallaM * $tallaM)) : 0;

                    $path = explode('/', $doc['name']);
                    $todosLosNinios[] = [
                        'id'       => end($path),
                        'nombre'   => $f['nombre']['stringValue'] ?? 'N/A',
                        'apellido' => $f['apellido']['stringValue'] ?? 'N/A',
                        'edad'     => $f['edad']['integerValue'] ?? '0',
                        'peso'     => $peso,
                        'estatura' => $tallaRaw,
                        'imc'      => number_format($imc, 1), 
                    ];
                }
            }
        }
        return view('hijos_registrados', compact('todosLosNinios'));
    }

    /* ============================================================
       2. PLANES NUTRICIONALES Y ARCHIVOS
       ============================================================ */

    // Carga la pantalla para que el Admin redacte el plan
    public function pantallaAsignarPlan($id) {
        $url = $this->baseUrl . "Ninios/" . $id . "?key=" . $this->key;
        $response = Http::get($url)->json();

        if (isset($response['error'])) return redirect()->back()->with('error', 'No encontrado.');

        $nino = [];
        foreach ($response['fields'] as $campo => $valor) { $nino[$campo] = reset($valor); }
        $nino['id'] = $id;

        // IMC para referencia del Admin
        $peso = (float)($nino['peso'] ?? 0);
        $tallaRaw = (float)($nino['estatura'] ?? 0);
        $talla = ($tallaRaw > 3) ? ($tallaRaw / 100) : $tallaRaw;
        $nino['imc_calculado'] = ($talla > 0) ? round($peso / ($talla * $talla), 1) : 0;

        // Sugerencia automática
        $edad = (int)($nino['edad'] ?? 0);
        $sugerencia = "PLAN SUGERIDO:\n- Desayuno: Avena y fruta.\n- Almuerzo: Pollo y vegetales.\n- Cena: Ligera.";

        return view('asignar_plan_nino', compact('nino', 'sugerencia'));
    }

    // Procesa el formulario y sube el PDF/TXT
    public function guardarPlanNino(Request $request, $id) {
        $urlArchivo = "sin_archivo";
        if ($request->hasFile('archivo_adjunto')) {
            $archivo = $request->file('archivo_adjunto');
            $nombre = $id . '_' . time() . '.' . $archivo->getClientOriginalExtension();
            $archivo->move(public_path('uploads/planes'), $nombre);
            $urlArchivo = '/uploads/planes/' . $nombre;
        }

        $fields = [
            'nino_id'      => ['stringValue' => (string)$id],
            'titulo'       => ['stringValue' => (string)$request->titulo_plan],
            'detalle'      => ['stringValue' => (string)$request->detalle_plan],
            'calorias'     => ['integerValue' => (int)$request->calorias],
            'proxima_cita' => ['stringValue' => (string)($request->proxima_cita ?? 'Pendiente')],
            'url_archivo'  => ['stringValue' => $urlArchivo]
        ];

        $response = Http::post($this->baseUrl . "planes?key=" . $this->key, ['fields' => $fields]);
        return redirect()->route('ver.ninos')->with('status', '¡Plan guardado con éxito!');
    }

    /* ============================================================
       3. MENSAJES DE CONTACTO Y ESTADOS
       ============================================================ */

    public function verContactos() {
        $response = Http::get($this->baseUrl . "contacts?key=" . $this->key)->json();
        $contactos = $this->limpiarDatos($response, 'contacts');
        return view('ver_contactos', compact('contactos'));
    }

    public function estadoContacto($id, $estado) {
        $url = $this->baseUrl . "contacts/" . $id . "?key=" . $this->key . "&updateMask.fieldPaths=estado";
        Http::patch($url, [
            'fields' => ['estado' => ['stringValue' => $estado]]
        ]);
        return redirect()->back()->with('status', 'Estado actualizado.');
    }

    /* ============================================================
       4. EDICIÓN GENERAL Y UTILIDADES
       ============================================================ */

    public function actualizarDoc(Request $request, $coleccion, $id) {
        $fields = [];
        $queryParts = ["key=" . $this->key];
        foreach ($request->except(['_token', '_method']) as $campo => $valor) {
            if ($valor === null) continue;
            if (in_array(strtolower($campo), ['peso', 'estatura', 'edad'])) {
                $fields[$campo] = ['integerValue' => (int)$valor];
            } else {
                $fields[$campo] = ['stringValue' => (string)$valor];
            }
            $queryParts[] = "updateMask.fieldPaths=" . urlencode($campo);
        }
        $url = $this->baseUrl . $coleccion . "/" . $id . "?" . implode('&', $queryParts);
        Http::patch($url, ['fields' => $fields]);
        return redirect()->back()->with('status', 'Actualizado.');
    }

    public function eliminarDoc($coleccion, $id) {
        Http::delete($this->baseUrl . $coleccion . "/" . $id . "?key=" . $this->key);
        return redirect()->back()->with('status', 'Registro eliminado.');
    }

    private function limpiarDatos($response, $tipo) {
        $items = [];
        if (isset($response['documents'])) {
            foreach ($response['documents'] as $doc) {
                $f = $doc['fields'];
                $path = explode('/', $doc['name']);
                $id = end($path);
                if ($tipo == 'contacts') {
                    $items[] = [
                        'id'      => $id,
                        'nombre'  => $f['nombre']['stringValue'] ?? ($f['Nombre']['stringValue'] ?? 'N/A'),
                        'asunto'  => $f['asunto']['stringValue'] ?? 'Sin asunto',
                        'mensaje' => $f['mensaje']['stringValue'] ?? ($f['Mensaje']['stringValue'] ?? 'Sin mensaje'),
                        'estado'  => $f['estado']['stringValue'] ?? 'Pendiente',
                        'fecha'   => isset($doc['createTime']) ? date('d/m/Y', strtotime($doc['createTime'])) : 'N/A'
                    ];
                }
            }
        }
        return $items;
    }
}