<?php

namespace App\Http\Controllers;

use App\{Mail\sendNewObservation, Models\Observation};
use Illuminate\{Http\RedirectResponse, Support\Facades\Mail};

/**
 * Classe para manipulação de observações.
 */
class ObservationController extends Controller
{

    /**
     *  Método responsável por cadastrar uma nova observação.
     * @return RedirectResponse
     */
    public function postObservation()
    {

        // Cria um nova observação.
        $observation = new Observation();

        // Preenche os dados da observação.
        $observation->users_id = request('user_id');
        $observation->text = request('observation');
        $observation->tickets_id = request('ticket_id');
        $observation->public = request('public');

        // Salva a observação.
        $observation->save();

        // Envia um e-mail para o usuário informando que sua observação foi cadastrada.
        if (request('public'))
            Mail::send(new sendNewObservation($observation));

        // Redireciona para a página anterior com mensagem de sucesso.
        return redirect()->back()->with('success', 'Observação adicionada com sucesso!');
    }

    /**
     * Método responsável cadastrar uma nova observação pública.
     * @return RedirectResponse
     */
    public function postPublicObservation()
    {

        // Cria um nova observação.
        $observation = new Observation();

        // Preenche os dados da observação.
        $observation->text = request('observation');
        $observation->tickets_id = request('ticket_id');
        $observation->by_customer = true;
        $observation->public = true;

        // Salva a observação.
        $observation->save();

        // Redireciona para a página anterior com mensagem de sucesso.
        return redirect()->back()->with('success', 'Observação adicionada com sucesso!');
    }
}
