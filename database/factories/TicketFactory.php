<?php

namespace Database\Factories;

use App\Http\Controllers\HomeController;
use App\Models\Category;
use App\Models\Customer;
//use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $days = HomeController::getDaysTheMonth();

        return [
            'users_id' => rand(0,1) ? User::factory()->create()->id : null,
            'categories_id' => Category::factory()->create()->id,
            'customers_id' => Customer::factory()->create()->id,
            'title' => $this->faker->unique()->sentence(),
            'description' => $this->faker->unique()->paragraph(),
            'finished' => $this->faker->boolean(),
            'reopened' => $this->faker->boolean(),
            'created_at' => $days[rand(0, count($days) -1)],
        ];
    }
}
