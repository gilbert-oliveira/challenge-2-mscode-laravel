<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendFinishedTicket extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        // Defini o ticket que será enviado.
        $this->ticket = $ticket;

        // Define o usuário.
        $this->user = $this->ticket->customer();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Define o assunto do email.
        $this->subject('Ticket Finalizado na Plataforma!');
        // Define o o destinatário do email.
        $this->to($this->user->email, $this->user->name);

        // Recupera o ticket.
        $ticket = $this->ticket;

        // Retorna o email.
        return $this->markdown('emails.sendFinishedTicket', compact('ticket'));
    }
}
