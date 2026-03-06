<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ViewController extends Controller
{
    // Configuración de Firebase Firestore
    private $key = "AIzaSyDp_V5toh_KO4R7SDm4lHNKP4OHYBIrwRI";
    private $baseUrl = "https://firestore.googleapis.com/v1/projects/mi-pagina-ec6da/databases/(default)/documents/";

    /* ============================================================
       1. VISTAS DE ADMINISTRADOR (TABLAS PRINCIPALES)
       ============================================================ */

    // Ver Clientes/Usuarios Registrados
    public function verUsuarios() {
        $response = Http::get($this->baseUrl . "users?key=" . $this->key)->json();
        $usuarios = $this->limpiarDatos($response, 'users');
        return view('ver_usuarios', compact('usuarios'));
    }

    // Ver Catálogo de Servicios
    public function verServicios() {
        $response = Http::get($this->baseUrl . "servicios?key=" . $this->key)->json();
        $servicios = $this->limpiarDatos($response, 'servicios');
        return view('ver_servicios', compact('servicios'));
    }

    // Ver Bandeja de Mensajes de Contacto
    public function verContactos() {
        $response = Http::get($this->baseUrl . "contacts?key=" . $this->key)->json();
        $contactos = $this->limpiarDatos($response, 'contacts');
        return view('ver_contactos', compact('contactos'));
    }

    // Ver Expedientes de todos los Niños (Admin/Nutriólogo)
    public function verTodosLosNinos() {
        $url = $this->baseUrl . "Ninios?key=" . $this->key;
        $response = Http::get($url)->json();
        
        $ninos = [];
        if (isset($response['documents'])) {
            foreach ($response['documents'] as $doc) {
                $f = $doc['fields'];
                $path = explode('/', $doc['name']);
                
                // Conversión de tipos (Firebase los trae como string o int)
                $peso = (float)($f['peso']['stringValue'] ?? ($f['peso']['integerValue'] ?? 0));
                $tallaRaw = (float)($f['estatura']['stringValue'] ?? ($f['estatura']['integerValue'] ?? 0));
                
                // Normalización de Estatura (cm a m)
                $talla = ($tallaRaw > 3) ? ($tallaRaw / 100) : $tallaRaw;
                
                // Cálculo de IMC Automático
                $imc = ($talla > 0) ? round($peso / ($talla * $talla), 1) : 0;

                $ninos[] = [
                    'id'     => end($path),
                    'nombre' => ($f['nombre']['stringValue'] ?? '') . ' ' . ($f['apellido']['stringValue'] ?? ''),
                    'correo' => $f['id_padre']['stringValue'] ?? 'N/A',
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

    /* ============================================================
       2. ASIGNACIÓN DE PLANES NUTRICIONALES
       ============================================================ */

    // Cargar pantalla de prescripción con datos del niño
    public function pantallaAsignarPlan($id) {
        $url = $this->baseUrl . "Ninios/" . $id . "?key=" . $this->key;
        $response = Http::get($url)->json();

        if (isset($response['error'])) return redirect()->back()->with('error', 'Expediente no encontrado.');

        $nino = [];
        foreach ($response['fields'] as $campo => $valor) { $nino[$campo] = reset($valor); }
        $nino['id'] = $id;

        // IMC para referencia visual en la vista
        $peso = (float)($nino['peso'] ?? 0);
        $tallaRaw = (float)($nino['estatura'] ?? 0);
        $talla = ($tallaRaw > 3) ? ($tallaRaw / 100) : $tallaRaw;
        $nino['imc_calculado'] = ($talla > 0) ? round($peso / ($talla * $talla), 1) : 0;

        // Sugerencia dinámica por edad
        $edad = (int)($nino['edad'] ?? 0);
        $sugerencia = "PLAN SUGERIDO PARA PACIENTE DE " . $edad . " AÑOS:\n- Desayuno: Avena con fruta.\n- Almuerzo: Proteína magra y vegetales.\n- Cena: Ligera.";

        return view('asignar_plan_nino', compact('nino', 'sugerencia'));
    }

    // Guardar el plan y subir archivo PDF/TXT
    public function guardarPlanNino(Request $request, $id) {
        $urlArchivo = "sin_archivo";
        
        if ($request->hasFile('archivo_adjunto')) {
            $archivo = $request->file('archivo_adjunto');
            $nombre = $id . '_' . time() . '.' . $archivo->getClientOriginalExtension();
            
            // Asegurar que la carpeta existe
            if (!file_exists(public_path('uploads/planes'))) {
                mkdir(public_path('uploads/planes'), 0777, true);
            }
            
            $archivo->move(public_path('uploads/planes'), $nombre);
            $urlArchivo = '/uploads/planes/' . $nombre;
        }

        $fields = [
            'nino_id'      => ['stringValue' => (string)$id],
            'titulo'       => ['stringValue' => (string)$request->titulo_plan],
            'detalle'      => ['stringValue' => (string)$request->detalle_plan],
            'calorias'     => ['integerValue' => (int)$request->calorias],
            'proxima_cita' => ['stringValue' => (string)($request->proxima_cita ?? 'Pendiente')],
            'url_archivo'  => ['stringValue' => $urlArchivo],
            'fecha_creado' => ['stringValue' => date('Y-m-d')]
        ];

        Http::post($this->baseUrl . "planes?key=" . $this->key, ['fields' => $fields]);
        return redirect()->route('ver.ninos')->with('status', '¡Plan asignado y archivo guardado!');
    }

    /* ============================================================
       3. GESTIÓN DE HIJOS (VISTA PADRE)
       ============================================================ */

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
       4. UTILIDADES (PATCH, DELETE, LIMPIEZA)
       ============================================================ */

    public function estadoContacto($id, $estado) {
        $url = $this->baseUrl . "contacts/" . $id . "?key=" . $this->key . "&updateMask.fieldPaths=estado";
        Http::patch($url, ['fields' => ['estado' => ['stringValue' => $estado]]]);
        return redirect()->back()->with('status', 'Estado del mensaje actualizado.');
    }

    /* ============================
       ====== EDICIÓN DE PERFIL =====
       ============================ */

    public function editarDocPerfil($id) {
        // 1. Detectamos el rol del usuario en sesión
        $rol = session('rol');

        // 2. Definimos la colección de Firebase según el rol
        $coleccion = ($rol == 'admin') 
            ? 'administradores' 
            : (($rol == 'nutriologo') ? 'nutriologo' : 'users');

        // 3. Llamamos a la función genérica de edición
        return $this->editarDoc($coleccion, $id);
    }

    public function editarDoc($coleccion, $id) {
        // Consultamos el documento específico en Firebase
        $url = $this->baseUrl . $coleccion . "/" . $id . "?key=" . $this->key;
        $response = Http::get($url)->json();

        if (isset($response['error'])) {
            return redirect()->back()->with('error', 'No se encontró el registro en la colección: ' . $coleccion);
        }

        // Limpiamos los datos para que la vista los entienda
        $documento = [];
        if (isset($response['fields'])) {
            foreach ($response['fields'] as $campo => $valor) {
                $documento[$campo] = reset($valor);
            }
        }

        $documento['id'] = $id;
        $documento['coleccion'] = $coleccion;

        return view('editar_perfil', compact('documento'));
    }

    public function eliminarDoc($coleccion, $id) {
        Http::delete($this->baseUrl . $coleccion . "/" . $id . "?key=" . $this->key);
        return redirect()->back()->with('status', 'Registro eliminado correctamente.');
    }

    public function actualizarDoc(Request $request, $coleccion, $id) {
        $fields = [];
        $queryParts = ["key=" . $this->key];
        foreach ($request->except(['_token', '_method']) as $campo => $valor) {
            if ($valor === null) continue;
            
            if (in_array(strtolower($campo), ['peso', 'estatura', 'edad', 'precio'])) {
                $fields[$campo] = ['integerValue' => (int)$valor];
            } else {
                $fields[$campo] = ['stringValue' => (string)$valor];
            }
            $queryParts[] = "updateMask.fieldPaths=" . urlencode($campo);
        }
        $url = $this->baseUrl . $coleccion . "/" . $id . "?" . implode('&', $queryParts);
        Http::patch($url, ['fields' => $fields]);
        return redirect()->back()->with('status', 'Actualizado con éxito.');
    }

    private function limpiarDatos($response, $tipo) {
        $items = [];
        if (isset($response['documents'])) {
            foreach ($response['documents'] as $doc) {
                $f = $doc['fields'];
                $path = explode('/', $doc['name']);
                $id = end($path);
                $fecha = isset($doc['createTime']) ? date('d/m/Y', strtotime($doc['createTime'])) : 'N/A';

                if ($tipo == 'users') {
                    $items[] = [
                        'id'     => $id,
                        'nombre' => $f['name']['stringValue'] ?? ($f['nombre']['stringValue'] ?? 'Sin nombre'),
                        'email'  => $f['email']['stringValue'] ?? ($f['correo']['stringValue'] ?? 'N/A'),
                        'fecha'  => $fecha
                    ];
                } elseif ($tipo == 'servicios') {
                    $items[] = [
                        'id'     => $id,
                        'nombre' => $f['nombre']['stringValue'] ?? 'N/A',
                        'desc'   => $f['descripcion']['stringValue'] ?? 'N/A',
                        'precio' => $f['precio']['integerValue'] ?? ($f['precio']['stringValue'] ?? '0'),
                        'fecha'  => $fecha
                    ];
                } elseif ($tipo == 'contacts') {
                    $items[] = [
                        'id'      => $id,
                        'nombre'  => $f['nombre']['stringValue'] ?? ($f['Nombre']['stringValue'] ?? 'Anónimo'),
                        'asunto'  => $f['asunto']['stringValue'] ?? 'Sin asunto',
                        'mensaje' => $f['mensaje']['stringValue'] ?? ($f['Mensaje']['stringValue'] ?? 'Sin mensaje'),
                        'estado'  => $f['estado']['stringValue'] ?? 'Pendiente',
                        'fecha'   => $fecha
                    ];
                }
            }
        }
        return $items;
    }
}