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
        $this->observation = $observation;
        $this->customer = $observation->ticket()->customer();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Nova observação no seu ticket!');
        $this->to($this->customer->email, $this->customer->name);

        $observation = $this->observation;
        return $this->markdown('emails.sendNewObservation', compact('observation'));
    }
}
