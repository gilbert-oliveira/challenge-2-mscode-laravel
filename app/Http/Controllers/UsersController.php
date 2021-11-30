<?php

namespace App\Http\Controllers;

use Str;
use App\{
    Http\Requests\UserRequest,
    Mail\sendNewLogin,
    Mail\sendUserActivation,
    Mail\sendUserDisablement,
    Models\User
};
use Illuminate\{
    Contracts\Foundation\Application,
    Contracts\View\Factory,
    Contracts\View\View,
    Http\RedirectResponse,
    Routing\Redirector,
    Support\Facades\Mail
};

class UsersController extends Controller
{
    /**
     * Função para listar os usuários
     * @return Application|Factory|View
     */
    public function getUsers()
    {
        // Busca todos os usuários
        $users = User::all();

        // Retorna a view com os usuários
        return view('dashboard.users', compact('users'));
    }

    /**
     * Função para cadastrar um novo usuário
     * @param UserRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function postUsers(UserRequest $request)
    {
        // Gera uma senha aleatória
        $password = Str::random(10);

        // Cria um novo usuário
        $user = new User();
        $user->fill($request->all('name', 'email'));// Preenche os campos do usuário
        $user->cpf = preg_replace('/\D/', '', $request->cpf);// Remove os caracteres especiais do cpf
        $user->master = false;// Não é um usuário master
        $user->active = true;// O usuário está ativo
        $user->password = password_hash($password, PASSWORD_DEFAULT);// Gera uma senha criptografada

        // Verifica se já existe um usuário com o mesmo email
        if (User::where('email', request('email'))->first())
            return redirect()->back()->withInput()->with('error', 'E-mail já cadastrado!');
        // Verifica se já existe um usuário com o mesmo CPF
        if (User::where('cpf', preg_replace('/\D/', '', $request->cpf))->first())
            return redirect()->back()->withInput()->with('error', 'CPF já cadastrado!');

        // Salva o usuário
        $user->save();

        // Envia um e-mail com as credenciais
        Mail::send(new sendNewLogin($user, $password));

        // Retorna a view com o usuário cadastrado
        return redirect(route('dashboard.users'))->with('success', 'Usuário cadsatrado !');
    }

    /**
     * Função para exibir a view de recuperação de senha
     * @return Application|Factory|View
     */
    public function getChangePassword()
    {
        // Retorna a view de recuperação de senha
        return view('auth.change-password');
    }

    /**
     * Função para alterar a senha do usuário
     * @return RedirectResponse
     */
    public function postChangePassword()
    {
        // Verifica se as senhas foram digitadas corretamente
        if (request('new_password') != request('new_password_confirmation'))
            return redirect()->back()->withInput()->with('error', 'Senhas não conferem!');

        // Verifica se a senha atual está correta
        if (!password_verify(request('current_password'), auth()->user()->password))
            return redirect()->back()->with('error', 'Senha atual incorreta!');

        // Recupera o usuário
        $user = auth()->user();
        // Criptografa a nova senha
        $user->password = password_hash(request('new_password'), PASSWORD_DEFAULT);
        // Salva o usuário
        $user->save();

        // Retorna para telas de login
        return redirect()->route('login')->with('success', 'Senha alterada com sucesso!');
    }

    /**
     * Função para desativar um usuário
     * @return RedirectResponse
     */
    public function disableUser()
    {
        // Recupera o usuário
        $id = request()->id;
        $user = User::find($id);

        // Desativa o usuário
        $user->active = 0;
        $user->save();

        //Envia um e-mail de desativação
        Mail::send(new sendUserDisablement($user));
        // Retorna para a lista de usuários
        return redirect()->back()->with('success', "Usuário $user->name desativado com sucesso!");
    }

    /**
     * Função para ativar um usuário
     * @return RedirectResponse
     */
    public function enableUser()
    {
        // Recupera o usuário
        $id = request()->id;
        $user = User::find($id);

        // Ativa o usuário
        $user->active = 1;
        $user->save();

        //Envia um e-mail de ativação
        Mail::send(new sendUserActivation($user));
        // Retorna para a lista de usuários
        return redirect()->back()->with('success', "Usuário $user->name ativado com sucesso!");
    }
}
