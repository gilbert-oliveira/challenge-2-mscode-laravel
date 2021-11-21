<?php

namespace App\Models;

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

    // Relationships hasMany
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'customers_id')->get();
    }

    protected $casts = [

    ];
}
