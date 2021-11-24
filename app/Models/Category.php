<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // Relationships hasMany
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'categories_id')->get();
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
