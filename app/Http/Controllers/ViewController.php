<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ViewController extends Controller
{
    private $key = "?key=AIzaSyDp_V5toh_KO4R7SDm4lHNKP4OHYBIrwRI";
    private $baseUrl = "https://firestore.googleapis.com/v1/projects/mi-pagina-ec6da/databases/(default)/documents/";

    // --- VISTAS DE LISTADO ---

    public function verUsuarios() {
        $response = Http::get($this->baseUrl . "users" . $this->key)->json();
        $usuarios = $this->limpiarDatos($response, 'users');
        return view('ver_usuarios', compact('usuarios'));
    }

    public function verServicios() {
        $response = Http::get($this->baseUrl . "servicios" . $this->key)->json();
        $servicios = $this->limpiarDatos($response, 'servicios');
        return view('ver_servicios', compact('servicios'));
    }

    public function verContactos() {
        $response = Http::get($this->baseUrl . "contacts" . $this->key)->json();
        $contactos = $this->limpiarDatos($response, 'contacts');
        return view('ver_contactos', compact('contactos'));
    }

    // --- LÓGICA DE EDICIÓN (PÁGINA NUEVA) ---

    /**
     * Muestra el formulario de edición para un documento específico
     */
    public function editarDoc($coleccion, $id) {
        $url = $this->baseUrl . $coleccion . "/" . $id . $this->key;
        $response = Http::get($url)->json();

        if (isset($response['error'])) {
            return redirect()->back()->with('error', 'No se encontró el registro.');
        }

        $documento = [];
        if (isset($response['fields'])) {
            foreach ($response['fields'] as $key => $value) {
                // Extraemos el valor real (sea stringValue, integerValue, etc.)
                $documento[$key] = reset($value);
            }
        }

        $documento['id'] = $id;
        $documento['coleccion'] = $coleccion;

        return view('editar_documento', compact('documento'));
    }

    /**
     * Procesa la actualización en Firebase
     */
    public function actualizarDoc(Request $request, $coleccion, $id) {
        $fields = [];
        $updateMask = "";

        // Recorremos los campos enviados desde el formulario
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            // Detectar tipo de dato
            if ($key == 'precio' || (is_numeric($value) && $key != 'telefono')) {
                $fields[$key] = ['integerValue' => (int)$value];
            } else {
                $fields[$key] = ['stringValue' => (string)$value];
            }
            // Construir máscara para que Firebase sepa qué actualizar
            $updateMask .= "&updateMask.fieldPaths=" . $key;
        }

        $url = $this->baseUrl . $coleccion . "/" . $id . $this->key . $updateMask;
        
        // Enviamos la petición PATCH a Firestore
        $response = Http::patch($url, ['fields' => $fields]);

        if ($response->successful()) {
            // Redirigimos según la colección para volver a la tabla correcta
            $ruta = $coleccion == 'users' ? 'ver-usuarios' : ($coleccion == 'servicios' ? 'ver-servicios' : 'ver-contactos');
            return redirect($ruta)->with('status', 'Registro actualizado con éxito.');
        }

        return redirect()->back()->with('error', 'Error al intentar actualizar.');
    }

    // --- ACCIONES DE ELIMINAR Y ESTADO ---

    public function eliminarDoc($coleccion, $id) {
        Http::delete($this->baseUrl . $coleccion . "/" . $id . $this->key);
        return redirect()->back()->with('status', 'Registro eliminado.');
    }

    public function estadoContacto($id, $estado) {
        $url = $this->baseUrl . "contacts/" . $id . $this->key . "&updateMask.fieldPaths=estado";
        Http::patch($url, ['fields' => ['estado' => ['stringValue' => $estado]]]);
        return redirect()->back()->with('status', 'Estado actualizado.');
    }

    // --- FUNCIÓN DE LIMPIEZA ---

    private function limpiarDatos($response, $tipo) {
        $items = [];
        if (isset($response['documents'])) {
            foreach ($response['documents'] as $doc) {
                $f = $doc['fields'];
                $path = explode('/', $doc['name']);
                $id = end($path);
                $fecha = isset($doc['createTime']) ? date('d/m/Y H:i', strtotime($doc['createTime'])) : 'N/A';

                if ($tipo == 'users') {
                    $items[] = [
                        'id' => $id,
                        'nombre' => $f['name']['stringValue'] ?? ($f['nombre']['stringValue'] ?? 'Sin nombre'),
                        'email' => $f['email']['stringValue'] ?? 'N/A',
                        'fecha' => $fecha
                    ];
                } elseif ($tipo == 'servicios') {
                    $items[] = [
                        'id' => $id,
                        'nombre' => $f['nombre']['stringValue'] ?? 'N/A',
                        'desc' => $f['descripcion']['stringValue'] ?? 'N/A',
                        'precio' => $f['precio']['integerValue'] ?? ($f['precio']['stringValue'] ?? '0'),
                        'fecha' => $fecha
                    ];
                } elseif ($tipo == 'contacts') {
                    $items[] = [
                        'id' => $id,
                        'nombre' => $f['Nombre']['stringValue'] ?? 'N/A',
                        'asunto' => $f['asunto']['stringValue'] ?? 'N/A',
                        'mensaje' => $f['Mensaje']['stringValue'] ?? 'N/A',
                        'estado' => $f['estado']['stringValue'] ?? 'Pendiente',
                        'fecha' => $fecha
                    ];
                }
            }
        }
        return $items;
    }
}