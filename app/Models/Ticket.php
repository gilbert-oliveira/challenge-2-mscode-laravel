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

    /**
     * Método responsável por retornar a categoria do ticket.
     * @return Model|HasOne|object|null
     */
    public function category()
    {
        // Ticket tem uma categoria.
        return $this->hasOne(Category::class, 'id', 'categories_id')->first();
    }

    /**
     * Método responsável por retornar os anexos do ticket.
     * @return Collection
     */
    public function attachments()
    {
        // Ticket tem vários anexos.
        return $this->hasMany(Attachment::class, 'tickets_id')->get();
    }

    /**
     * Método responsável por retornar a observação do ticket.
     * @return Collection
     */
    public function observations()
    {
        // Ticket tem várias observações.
        return $this->hasMany(Observation::class, 'tickets_id')->get();
    }

    /**
     * Método responsável por retornar o cliente do ticket.
     * @return Model|HasOne|object|null
     */
    public function customer()
    {
        // Ticket tem um cliente.
        return $this->hasOne(Customer::class, 'id', 'customers_id')->first();
    }

    /**
     * Método responsável por retornar o usuário do ticket.
     * @return Model|HasOne|object|null
     */
    public function user()
    {
        // Ticket tem um usuário.
        return $this->hasOne(User::class, 'id', 'users_id')->first();
    }
}
