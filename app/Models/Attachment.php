<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Attachment extends Model
{
    use HasFactory;

    /**
     * Método responsável por recuperar o ticket relacionado ao anexo.
     * @return Model|HasOne|object|null
     */
    public function ticket()
    {
        // Attachement pertece a um ticket.
        return $this->hasOne(Ticket::class, 'id')->first();
    }
}
