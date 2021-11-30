<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Observation extends Model
{
    use HasFactory;

    /**
     * Método responsável por retornar o usuário da observação.
     * @return Model|BelongsTo|object|null
     */
    public function user()
    {
        // Observation pertence a um usuário.
        return $this->belongsTo(User::class, 'users_id')->first();
    }

    /**
     * Método responsável por retornar o cliente da observação.
     * @return Model|BelongsTo|object|null
     */
    public function customer()
    {
        // Observation pertence a um cliente.
        return $this->belongsTo(User::class, 'customers_id')->first();
    }

    /**
     * Método responsável por retornar o ticket da observação.
     * @return Model|BelongsTo|object|null
     */
    public function ticket()
    {
        // Observation pertence a um ticket.
        return $this->belongsTo(Ticket::class, 'tickets_id')->first();
    }
}
