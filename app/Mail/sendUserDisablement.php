<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendUserDisablement extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {

        // Define o usuário.
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        // Define o assunto.
        $this->subject('Conta desativada!');

        // Define o destinatário.
        $this->to($this->user->email, $this->user->name);

        // Recupera o usuário.
        $user = $this->user;

        // Retorna a mensagem.
        return $this->markdown('emails.sendUserDisablement', compact('user'));
    }
}
