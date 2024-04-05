<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){

        //Validar los campos
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        /*
            El $request->remeber es para mantener la sesion activa
            el metodo attempt() tiene dos parametros, uno donde se le pasan los datos 
            para la validacion y el otro donde se indica si se tiene o no la sesion activada
        */
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        //return redirect()->route('posts.index', auth()->user()->username);
        return redirect()->route('home');
    }
}
