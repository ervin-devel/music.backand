<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function index()
    {
    }


    public function login()
    {
        return view('user.login');
    }

    public function loginRequest()
    {

    }

    public function forgotPassword()
    {
        return view('user.forgot');
    }

    public function register()
    {

    }
}
