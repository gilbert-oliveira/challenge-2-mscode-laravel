<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Ticket;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function newTickets()
    {

        return view('dashboard.tickets.new_tickets');
    }

    public function postTickets()
    {
        $ticket = new Ticket();
        $ticket->categories_id = request()->category;
        $ticket->customers_id = request()->customer;
        $ticket->title = request()->title;
        $ticket->description = request()->description;
        $ticket->finished = false;
        $ticket->reopened = false;
        $ticket->save();


        foreach (request()->file('attachments') as $file) {
            $attachment = new Attachment();
            $attachment->tickets_id = $ticket->id;
            $attachment->path = $file->store('attachments');
            $attachment->save();
        };

        return redirect()->route('dashboard.tickets.new')->with('success', 'Ticket criado com sucesso');

    }

    public function getOpenTickets()
    {
        $openTickets = Ticket::all()->where('finished', 0);

        return view('dashboard.tickets.open_tickets', compact('openTickets'));
    }

    public function detailTicket(int $id)
    {
        $ticket = Ticket::find($id);

        return view('dashboard.tickets.detail_tickets', compact('ticket'));
    }
}
