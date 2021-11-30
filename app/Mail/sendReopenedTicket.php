<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendReopenedTicket extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
        $this->user = $this->ticket->customer();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Ticket Reaberto na Plataforma!');
        $this->to($this->user->email, $this->user->name);

        $ticket = $this->ticket;
        return $this->markdown('emails.sendReopendeTicket', compact('ticket'));
    }
}
