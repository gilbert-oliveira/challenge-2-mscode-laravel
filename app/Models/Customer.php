<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'document',
        'email',
    ];

    /**
     * Método responsável por retornar os tickets do customer.
     * @return Collection
     */
    public function tickets()
    {

        // Customer tem muitos tickets
        return $this->hasMany(Ticket::class, 'customers_id')->get();
    }

    protected $casts = [

    ];
}
