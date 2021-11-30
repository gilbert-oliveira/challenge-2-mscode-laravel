<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Método responsável por retornar todos os tickets de uma categoria.
     * @return Collection
     */
    public function tickets()
    {
        // Categoria tem muitos tickets.
        return $this->hasOne(Ticket::class, 'categories_id' )->get();
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'master' => 'boolean',
        'active' => 'boolean',
    ];
}
