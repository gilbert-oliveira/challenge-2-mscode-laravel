<?php

namespace App\Mail;

use App\Models\Observation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendNewObservation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Observation $observation)
    {

        // Define a observação.
        $this->observation = $observation;

        // Define o cliente.
        $this->customer = $observation->ticket()->customer();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        // Define o assunto.
        $this->subject('Nova observação no seu ticket!');

        // Define o destinatário.
        $this->to($this->customer->email, $this->customer->name);

        // Recupera a observação.
        $observation = $this->observation;

        // Retorna a mensagem.
        return $this->markdown('emails.sendNewObservation', compact('observation'));
    }
}
