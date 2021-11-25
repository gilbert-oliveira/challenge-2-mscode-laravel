<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'categories_id',
        'customers_id',
        'title',
        'description',
        'finished',
    ];

    // Relationships hasOne
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'categories_id')->first();
    }

    // Relationships hasMany
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'tickets_id')->get();
    }

    public function observations()
    {
        return $this->hasMany(Observation::class, 'tickets_id')->get();
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customers_id')->first();
    }
}
