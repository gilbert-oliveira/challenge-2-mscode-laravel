<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Mail\sendFinishedTicket;
use App\Mail\sendNewObservation;
use App\Mail\sendNewTicket;
use App\Mail\sendReopenedTicket;
use App\Models\Attachment;
use App\Models\Ticket;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function newTickets()
    {

        return view('dashboard.tickets.new_tickets');
    }

    public function postTickets(TicketRequest $request)
    {
        $ticket = new Ticket();
        $ticket->categories_id = $request->category;
        $ticket->customers_id = $request->customer;
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->finished = false;
        $ticket->reopened = false;
        $ticket->token = Str::random(32);
        $ticket->save();

        if ($request->file()) {
            foreach ($request->file('attachments') as $file) {
                $attachment = new Attachment();
                $attachment->tickets_id = $ticket->id;
                $attachment->path = $file->storeAs('attachments', $file->getClientOriginalName());
                $attachment->save();
            };
        }
        Mail::send(new sendNewTicket($ticket));
        return redirect()->route('dashboard.tickets.new')->with('success', 'Ticket criado com sucesso');
    }

    function getOpenTickets()
    {
        $openTickets = Ticket::all()->where('finished', 0)->where('users_id', null);

        return view('dashboard.tickets.open_tickets', compact('openTickets'));
    }

    public function getDetailsPublic(string $token)
    {
        $ticket = Ticket::where('token', $token)->first();

        if (!$ticket)
            abort('401');

        return view('public.tickets.details', compact('ticket'));
    }

    function detailTicket(int $id)
    {
        $ticket = Ticket::find($id);

        if ($ticket)
            return view('dashboard.tickets.detail_tickets', compact('ticket'));

        return redirect()->route('dashboard.tickets.open')->with('error', 'Ticket não encontrado');
    }

    public
    function getFinishedTickets()
    {
        $assumedTickets = Ticket::all()->where('users_id', auth()->user()->id)->where('finished', true);
        return view('dashboard.tickets.finished_tickets', compact('assumedTickets'));
    }

    public
    function getAssumedTickets()
    {
        $assumedTickets = Ticket::all()->where('users_id', auth()->user()->id)->where('finished', false);
        return view('dashboard.tickets.assumed_tickets', compact('assumedTickets'));
    }

    public
    function assumeTicket()
    {
        $ticket = Ticket::find(request()->id);
        $ticket->users_id = auth()->user()->id;
        $ticket->save();
        return redirect()->route('dashboard.tickets.open')->with('success', 'Ticket assumido com sucesso!');
    }

    public
    function finishTicket()
    {
        $ticket = Ticket::find(request('id'));
        $ticket->finished = true;
        $ticket->save();

        Mail::send(new sendFinishedTicket($ticket));
        return redirect()->route('dashboard.tickets.assumed')->with('success', 'Ticket finalizado com sucesso!');
    }

    public
    function reopenTicket()
    {
        $oldTicket = Ticket::find(request('id'));

        $ticket = new Ticket();
        $ticket->users_id = auth()->user()->id;
        $ticket->categories_id = $oldTicket->categories_id;
        $ticket->customers_id = $oldTicket->customers_id;
        $ticket->title = $oldTicket->title;
        $ticket->description = $oldTicket->description;
        $ticket->finished = false;
        $ticket->reopened = true;
        $ticket->token = Str::random(32);
        $ticket->save();

        Mail::send(new sendReopenedTicket($ticket));
        return redirect()->route('dashboard.tickets.assumed')->with('success', 'Ticket reaberto com sucesso!');
    }

    public
    function transferTicket()
    {
        $ticket = Ticket::find(request('ticket_id'));
        $ticket->users_id = \request('users_id');
        $ticket->save();

        return redirect()->route('dashboard.tickets.assumed')->with('success', 'Ticket transferido com sucesso!');
    }
}
