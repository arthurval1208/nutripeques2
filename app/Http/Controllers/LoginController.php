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

        // Buscar admin
        $adminResponse = Http::get($this->projectUrl . "administradores" . $this->key)->json();

        if (isset($adminResponse['documents'])) {
            foreach ($adminResponse['documents'] as $doc) {
                $fields = $doc['fields'];

                if (
                    $fields['correo']['stringValue'] == $email &&
                    $fields['contraseña']['stringValue'] == $password
                ) {
                    session([
                        'usuario' => $fields['nombre']['stringValue'],
                        'rol' => 'admin'
                    ]);

                    return redirect('/home');
                }
            }
        }

        // Buscar usuario
        $userResponse = Http::get($this->projectUrl . "users" . $this->key)->json();

        if (isset($userResponse['documents'])) {
            foreach ($userResponse['documents'] as $doc) {
                $fields = $doc['fields'];

                if (
                    $fields['email']['stringValue'] == $email &&
                    $fields['password']['stringValue'] == $password
                ) {
                    session([
                        'usuario' => $fields['name']['stringValue'],
                        'rol' => 'user'
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