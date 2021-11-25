<?php

namespace App\Http\Controllers;

use App\Models\Observation;
use Illuminate\Http\Request;

class ObservationController extends Controller
{
    public function postObservation()
    {
        $observation = new Observation();

        $observation->users_id = 1;
        $observation->text = request('observation');
        $observation->tickets_id = request('ticket_id');
        $observation->save();

        return redirect()->back()->with('success', 'Observação adicionada com sucesso!');
    }
}
