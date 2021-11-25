<?php

namespace App\Http\Controllers;

use App\Models\User;
use Str;

class UsersController extends Controller
{

    public function activeUser()
    {
        $id = request()->id;
        $user = User::find($id);
        $user->active = 1;
        $user->save();
        return redirect()->back()->with('success', "Usuário $user->name Ativado com sucesso!");
    }

    public function disableUser()
    {
        $id = request()->id;
        $user = User::find($id);
        $user->active = 0;
        $user->save();
        return redirect()->back()->with('success', "Usuário $user->name desativado com sucesso!");
    }

    public function enableUser()
    {
        $id = request()->id;
        $user = User::find($id);
        $user->active = 1;
        $user->save();
        return redirect()->back()->with('success', "Usuário $user->name ativado com sucesso!");
    }

    public function getUsers()
    {

        $users = User::all();
        return view('dashboard.users', compact('users'));
    }

    public function postUsers()
    {
        $user = new User();
        $user->fill(request()->all());
        $user->master = false;
        $user->active = true;
        $password = Str::random(8);
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->save();

        return redirect(route('dashboard.users'))->with('success', 'Usuário cadsatrado  !');
    }
}
