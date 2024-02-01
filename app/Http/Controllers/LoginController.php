<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function form()
    {
        return view("login.login");
    }

    // fazer login com as credenciais do formulário login
    public function logar(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ],
            [
                'email.required' => 'Email deve ser digitado',
                'email.email' => 'Email deve ser digitado corretamente',
                'password.required' => 'Senha deve ser digitada',
            ]
        );

        // fazer login e gerar session
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Não foi possivel fazer login com esses dados',
        ])->onlyInput('email');
    }

    public function sair()
    {
        Auth::logout();
        return redirect('/');
    }

    // usuario de teste padrão
    public function criar()
    {
        // $user = new User();
        // $user->name = "admin";
        // $user->email = "admin@gmail.com";
        // $user->password = bcrypt("1234");

        // $user->save();
    }
}
