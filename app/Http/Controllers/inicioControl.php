<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class inicioControl extends Controller
{
    public function __invoke(){
        if(!Auth::user()){

            return view('auth.login');
        }
        else{
            return view('dash.index');
        }
    }
}
