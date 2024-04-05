<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store(){

        //Metodo para Cerrar Sesion
        auth()->logout();

        //Redireccionar al login
        return redirect()->route('login');
    }
}
