<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendNewLogin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $password)
    {
        // Define o usuário.
        $this->user = $user;

        // Define a senha.
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Define o assunto.
        $this->subject('Credenciais de Acesso!');

        // Define o destinatário.
        $this->to($this->user->email, $this->user->name);

        // Recupera o usuário.
        $user = $this->user;

        // Recupera a senha.
        $password = $this->password;

        // Retorna a mensagem.
        return $this->markdown('emails.sendNewLogin', compact('user', 'password'));
    }
}
