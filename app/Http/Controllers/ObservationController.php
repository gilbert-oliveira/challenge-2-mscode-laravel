<?php

namespace App\Http\Controllers;

use App\Mail\sendNewObservation;
use App\Models\Observation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ObservationController extends Controller
{
    public function postObservation()
    {
        $observation = new Observation();

        $observation->users_id = request('user_id');
        $observation->text = request('observation');
        $observation->tickets_id = request('ticket_id');
        $observation->public = request('public');
        $observation->save();

        if (request('public'))
            Mail::send(new sendNewObservation($observation));

        return redirect()->back()->with('success', 'Observação adicionada com sucesso!');
    }

    public function postPublicObservation()
    {
        $observation = new Observation();

        $observation->text = request('observation');
        $observation->tickets_id = request('ticket_id');
        $observation->by_customer = true;
        $observation->public = true;
        $observation->save();

        return redirect()->back()->with('success', 'Observação adicionada com sucesso!');
    }
}
