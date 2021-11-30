<?php

namespace App\Mail;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendNewTicket extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {

        // Define the ticket.
        $this->ticket = $ticket;

        // Define o cliente.
        $this->user = $this->ticket->customer();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        // Define o assunto.
        $this->subject('Ticket Aberto na Plataforma!');

        // Define o destinatário.
        $this->to($this->user->email, $this->user->name);

        // Recupera o ticket.
        $ticket = $this->ticket;

        // Retorna o mensagem.
        return $this->markdown('emails.sendNewTicket', compact('ticket'));
    }
}
