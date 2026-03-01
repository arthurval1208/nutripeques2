<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FirebaseController extends Controller
{
    private $key = "?key=AIzaSyDp_V5toh_KO4R7SDm4lHNKP4OHYBIrwRI";
    private $projectUrl = "https://firestore.googleapis.com/v1/projects/mi-pagina-ec6da/databases/(default)/documents/";

    public function store(Request $request)
    {
        $url = $this->projectUrl . "users" . $this->key;
        $datos = [
            'fields' => [
                'name'       => ['stringValue' => (string)$request->input('name')],
                'last_name'  => ['stringValue' => (string)$request->input('last_name')],
                'email'      => ['stringValue' => (string)$request->input('email')],
                'password'   => ['stringValue' => (string)$request->input('password')],
                'created_at' => ['stringValue' => date('Y-m-d H:i:s')],
                'updated_at' => ['stringValue' => date('Y-m-d H:i:s')],
            ]
        ];
        $response = Http::post($url, $datos);
        if ($response->successful()) {
            return redirect('/login')->with('status', 'Usuario registrado correctamente');
        }
        return redirect()->back()->with('error', 'Error al registrar usuario');
    }

    public function showProfile()
    {
        // Usamos la sesión que creamos en el LoginController
        if (session()->has('firebase_id')) {
            $firebaseUserId = session('firebase_id');
            $response = Http::get($this->projectUrl . 'users/' . $firebaseUserId . $this->key)->json();

            if (isset($response['fields'])) {
                return view('perfil', ['user' => $response['fields']]);
            }
            return redirect()->back()->with('error', 'No se encontraron datos en Firebase');
        }

        return redirect()->route('login')->with('error', 'Por favor inicie sesión');
    }

    public function updateProfile(Request $request)
{
    if (!session()->has('firebase_id')) {
        return redirect()->route('login')->with('error', 'Sesión expirada');
    }

    $firebaseId = session('firebase_id');
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'nueva_contrasena' => 'nullable|min:6',
    ]);

    // 1. Preparamos los campos
    $fields = [
        'name' => ['stringValue' => $validated['nombre']],
        'updated_at' => ['stringValue' => date('Y-m-d H:i:s')],
    ];

    // 2. Construimos la URL con updateMask para proteger los demás campos
    // El updateMask le dice a Firebase: "SOLO toca estos campos, deja el resto igual"
    $mask = "?updateMask.fieldPaths=name&updateMask.fieldPaths=updated_at";

    if (!empty($validated['nueva_contrasena'])) {
        $fields['password'] = ['stringValue' => $validated['nueva_contrasena']];
        $mask .= "&updateMask.fieldPaths=password"; // Añadimos password a la máscara si se cambia
    }

    // Limpiamos la key para unirla a la máscara
    $apiKey = str_replace('?', '&', $this->key);
    $url = $this->projectUrl . "users/" . $firebaseId . $mask . $apiKey;

    $response = Http::patch($url, [
        'fields' => $fields
    ]);

    if ($response->successful()) {
        session(['usuario' => $validated['nombre']]);
        return redirect()->route('perfil')->with('status', '¡Perfil actualizado con éxito sin borrar datos!');
    }

    return redirect()->back()->with('error', 'Error al actualizar datos');
}

    public function storeServicio(Request $request)
    {
        $url = $this->projectUrl . "servicios" . $this->key;
        $datos = [
            'fields' => [
                'nombre'      => ['stringValue' => (string)$request->input('nombre')],
                'descripcion' => ['stringValue' => (string)$request->input('descripcion')],
                'precio'      => ['integerValue' => (int)$request->input('precio')],
                'created_at'  => ['stringValue' => date('Y-m-d H:i:s')],
                'updated_at'  => ['stringValue' => date('Y-m-d H:i:s')],
            ]
        ];
        $response = Http::post($url, $datos);
        return $response->successful() ? redirect('/ver-servicios')->with('status', 'Servicio creado') : redirect()->back();
    }

    public function storeContacto(Request $request)
    {
        $url = $this->projectUrl . "contacts" . $this->key;
        $datos = [
            'fields' => [
                'Nombre'     => ['stringValue' => (string)$request->input('nombre')],
                'Correo'     => ['stringValue' => (string)$request->input('correo')],
                'Mensaje'    => ['stringValue' => (string)$request->input('mensaje')],
                'asunto'     => ['stringValue' => (string)$request->input('asunto')],
                'Prioridad'  => ['stringValue' => (string)$request->input('prioridad')],
                'created_at' => ['stringValue' => date('Y-m-d H:i:s')],
                'updated_at' => ['stringValue' => date('Y-m-d H:i:s')],
            ]
        ];
        $response = Http::post($url, $datos);
        return $response->successful() ? redirect('/contacto')->with('status', 'Enviado') : redirect()->back();
    }

    public function crearServicio() { return view('crear_servicio'); }
    public function crearContacto() { return view('crear_contacto'); }
}