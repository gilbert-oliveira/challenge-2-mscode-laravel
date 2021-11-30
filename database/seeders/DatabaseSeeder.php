<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Database\Factories\TicketFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Mapeamento das factories
        $this->call(FirstUserTableSeeder::class);
        $this->call(TicketTableSeeder::class);
    }
}
