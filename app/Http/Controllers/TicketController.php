<?php

namespace App\Http\Controllers;

use App\{Http\Requests\TicketRequest,
    Mail\sendFinishedTicket,
    Mail\sendNewTicket,
    Mail\sendReopenedTicket,
    Models\Attachment,
    Models\Ticket
};
use Illuminate\{Contracts\Foundation\Application,
    Contracts\View\Factory,
    Contracts\View\View,
    Http\RedirectResponse,
    Support\Facades\Mail,
    Support\Str
};

/**
 * Classe para manipulação de tickets.
 */
class TicketController extends Controller
{

    /**
     * Méto responsável por listar todos os tickets.
     * @return Application|Factory|View
     */
    public function newTickets()
    {
        // Lista todos os tickets.
        return view('dashboard.tickets.new_tickets');
    }

    /**
     * Método responsável por cadsatrar um novo ticket.
     * @param TicketRequest $request
     * @return RedirectResponse
     */
    public function postTickets(TicketRequest $request)
    {

        // Cria um novo ticket.
        $ticket = new Ticket();

        // Preenche os dados do ticket.
        $ticket->categories_id = $request->category;
        $ticket->customers_id = $request->customer;
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->finished = false;
        $ticket->reopened = false;
        $ticket->token = Str::random(32); // Gerando um token aleatório.

        // Salva o ticket.
        $ticket->save();

        // Verifica se o usuário enviou algum arquivo.
        if ($request->file()) {

            // Percorre todos os arquivos enviados.
            foreach ($request->file('attachments') as $file) {

                // Cria um novo anexo.
                $attachment = new Attachment();

                $attachment->tickets_id = $ticket->id; // Preenche os dados do anexo.
                $attachment->path = $file->storeAs('attachments', $file->getClientOriginalName());// Salva o anexo na pasta.
                $attachment->save(); // Salva o anexo no banco de dados.
            };
        }

        // Envia um email para o cliente informando que o ticket foi aberto.
        Mail::send(new sendNewTicket($ticket));

        // Retorna para a página de tickets.
        return redirect()->route('dashboard.tickets.new')->with('success', 'Ticket criado com sucesso');
    }

    /**
     * Método responsável por listar todos os tickets abertos.
     * @return Application|Factory|View
     */
    public function getOpenTickets()
    {
        // Recupera todos os tickets abertos.
        $openTickets = Ticket::all()->where('finished', 0)->where('users_id', null);

        // Retorna para a página de tickets abertos.
        return view('dashboard.tickets.open_tickets', compact('openTickets'));
    }

    /**
     * Método responsável por ver detalhes públicos de um ticket.
     * @param string $token
     * @return Application|Factory|View
     */
    public function getDetailsPublic(string $token)
    {

        // Recupera o ticket pelo token.
        $ticket = Ticket::where('token', $token)->first();

        // Verifica se o ticket existe.
        if (!$ticket)
            abort('401'); // Aborta a requisição.

        // Retorna para a página pública de detalhes do ticket.
        return view('public.tickets.details', compact('ticket'));
    }

    /**
     * Método responsável por ver detalhes privados de um ticket.
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function detailTicket(int $id)
    {

        // Recupera o ticket pelo id.
        $ticket = Ticket::find($id);

        // Verifica se o ticket existe.
        if ($ticket)
            return view('dashboard.tickets.detail_tickets', compact('ticket')); // Retorna para a página de detalhes do ticket.

        // Retorna para a página de tickets com mensagem de erro.
        return redirect()->route('dashboard.tickets.open')->with('error', 'Ticket não encontrado');
    }

    /**
     * Método responsável por listar todos os tickets fechados.
     * @return Application|Factory|View
     */
    public function getFinishedTickets()
    {

        // Recupera todos os tickets fechados que pertencem ao usuário logado.
        $finishedTickets = Ticket::all()->where('users_id', auth()->user()->id)->where('finished', true);

        // Redireciona para a página de tickets fechados.
        return view('dashboard.tickets.finished_tickets', compact('finishedTickets'));
    }

    /**
     * Método responsável por listar todos os tickets assumidos pelo usuário logado.
     * @return Application|Factory|View
     */
    public function getAssumedTickets()
    {

        // Recupera todos os tickets assumidos pelo usuário logado.
        $assumedTickets = Ticket::all()->where('users_id', auth()->user()->id)->where('finished', false);

        // Redireciona para a página de tickets assumidos.
        return view('dashboard.tickets.assumed_tickets', compact('assumedTickets'));
    }

    /**
     * Método responsável por assumir um ticket.
     * @return RedirectResponse
     */
    public function assumeTicket()
    {

        // Recupera o ticket pelo id.
        $ticket = Ticket::find(request()->id);

        $ticket->users_id = auth()->user()->id; // Insere o id do usuário logado no ticket.
        $ticket->save(); // Salva o ticket no banco de dados.

        // Redireciona para a página de tickets.
        return redirect()->route('dashboard.tickets.open')->with('success', 'Ticket assumido com sucesso!');
    }

    /**
     * Método responsável por finalizar um ticket.
     * @return RedirectResponse
     */
    public function finishTicket()
    {

        // Recupera o ticket pelo id.
        $ticket = Ticket::find(request('id'));

        $ticket->finished = true; // Altera o status do ticket para finalizado.
        $ticket->save(); // Salva o ticket no banco de dados.

        // Envia um E-mail informando o cliente que o ticket foi finalizado.
        Mail::send(new sendFinishedTicket($ticket));

        // Redireciona para a página de tickets assumidos.
        return redirect()->route('dashboard.tickets.assumed')->with('success', 'Ticket finalizado com sucesso!');
    }

    /**
     * Método responsável por reabrir um ticket.
     * @return RedirectResponse
     */
    public function reopenTicket()
    {

        // Recupera o ticket finalizado pelo id.
        $oldTicket = Ticket::find(request('id'));

        // Cria um novo ticket.
        $ticket = new Ticket();

        // Insere os dados do ticket finalizado no novo ticket.
        $ticket->users_id = auth()->user()->id;
        $ticket->categories_id = $oldTicket->categories_id;
        $ticket->customers_id = $oldTicket->customers_id;
        $ticket->title = $oldTicket->title;
        $ticket->description = $oldTicket->description;
        $ticket->finished = false;
        $ticket->reopened = true;
        $ticket->token = Str::random(32); // Gera um token aleatório.

        // Salva o novo ticket no banco de dados.
        $ticket->save();

        // Envia um E-mail informando o cliente que o ticket foi reaberto.
        Mail::send(new sendReopenedTicket($ticket));

        // Redireciona para a página anterior com mensagem de sucesso.s
        return redirect()->route('dashboard.tickets.assumed')->with('success', 'Ticket reaberto com sucesso!');
    }

    /**
     * Método para transferir um ticket para outro usuário.
     * @return RedirectResponse
     */
    public function transferTicket()
    {

        // recupera o ticket pelo id.
        $ticket = Ticket::find(request('ticket_id'));

        // Altera o usuário do ticket.
        $ticket->users_id = request('users_id');
        // Salva o ticket no banco de dados.
        $ticket->save();

        // Redireciona para a página de tickets assumidos.
        return redirect()->route('dashboard.tickets.assumed')->with('success', 'Ticket transferido com sucesso!');
    }
}
