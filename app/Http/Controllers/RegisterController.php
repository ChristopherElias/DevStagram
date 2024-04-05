<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index() {
        return view('auth.register');
    }

    public function store(Request $request){
        //dd($request); //muestra la info del get que obtenemos
        //dd($request->get('email')); //muestra el valor del name email del get

        //Modificar el Request
        $request->request->add(['username' => Str::slug($request->username)]);

        //Validacion
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        //Guardar los datos
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        //Autenticar un Usuario
        /*auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);*/

        //Otra forma de autenticar
        /* Sirve para enviar los valores a la vista y obtener los datos del usuario
        en esa vista */
        auth()->attempt($request->only('email', 'password')); 

        //Redireccionar 
        return redirect()->route('post.index');

    }

}
