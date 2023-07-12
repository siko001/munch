<?php

namespace Database\Factories;


use App\Models\Deal;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealFactory extends Factory {
    protected $model = Deal::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        $startDateTime = Carbon::now()->startOfWeek()->addDays(1)->startOfDay(); // Monday midnight

        $deals = [
            ['Buy 2 pizzas, get 1 cheesy for free'],
            ['50% off on all burgers'],
            ['Free side with any main course'],
            ['Family combo: Buy 4 large pizza, get 2 cheesy pizzas free'],
            ['Buy 1 get 1 free on all pastas'],
            [' 20% off on all pizzas'],
            ['Combo offer: single Patty Burger, fries for $10'],
            ['Free side with every order'],
            [''],
            ['Dinner for two: 2 pizza 2 side meal for 50%'],
            ['Weekend brunch: Bottomless mimosas for $15'],
            ['Late-night special: 25% off on all orders after 10 PM'],
            ['Student discount: 15% off on all orders with a valid student ID'],
            ['50% off Pasta'],
        ];

        $dealIndex = $this->faker->numberBetween(0, count($deals) - 1);
        $deal = $deals[$dealIndex];

        $title = $deal[0];
        $description = '';

        return [
            'title' => $title,
            'description' => $description,
            'start_date' => $startDateTime->format('Y-m-d'),
            'end_date' => $startDateTime->copy()->addDay()->format('Y-m-d'),
        ];
    }
}
