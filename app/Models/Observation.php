<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id')->first();
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customers_id')->first();
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'tickets_id')->first();
    }
}
