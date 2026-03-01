<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    private $key = "?key=AIzaSyDp_V5toh_KO4R7SDm4lHNKP4OHYBIrwRI";
    private $projectUrl = "https://firestore.googleapis.com/v1/projects/mi-pagina-ec6da/databases/(default)/documents/";

    public function login()
    {
        return view('auth.login');
    }

    public function procesarLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        // 1. Buscar en Administradores
        $adminResponse = Http::get($this->projectUrl . "administradores" . $this->key)->json();
        if (isset($adminResponse['documents'])) {
            foreach ($adminResponse['documents'] as $doc) {
                $fields = $doc['fields'];
                if (isset($fields['correo']['stringValue']) && $fields['correo']['stringValue'] == $email &&
                    isset($fields['contraseña']['stringValue']) && $fields['contraseña']['stringValue'] == $password) {
                    
                    $pathArray = explode('/', $doc['name']);
                    $firebaseId = end($pathArray);

                    session([
                        'firebase_id' => $firebaseId,
                        'usuario' => $fields['nombre']['stringValue'],
                        'email_usuario' => $fields['correo']['stringValue'],
                        'rol' => 'admin',
                    ]);
                    return redirect('/home');
                }
            }
        }

        // 2. Buscar en Usuarios
        $userResponse = Http::get($this->projectUrl . "users" . $this->key)->json();
        if (isset($userResponse['documents'])) {
            foreach ($userResponse['documents'] as $doc) {
                $fields = $doc['fields'];
                if (isset($fields['email']['stringValue']) && $fields['email']['stringValue'] == $email &&
                    isset($fields['password']['stringValue']) && $fields['password']['stringValue'] == $password) {
                    
                    $pathArray = explode('/', $doc['name']);
                    $firebaseId = end($pathArray);

                    session([
                        'firebase_id' => $firebaseId,
                        'usuario' => $fields['name']['stringValue'],
                        'email_usuario' => $fields['email']['stringValue'],
                        'rol' => 'user',
                    ]);
                    return redirect('/panel-usuario');
                }
            }
        }

        return redirect()->back()->with('error', 'Credenciales incorrectas');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}