<?php

namespace Modules\UsersModule\Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\UsersModule\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{

    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'amount' => fake()->randomNumber(5, true),
            'currency' => fake()->currencyCode(),
            'email' => fake()->safeEmail,
            'status_code' => fake()->randomElement(['100', '200', '300']),
            'registeration_date' => fake()->dateTimeThisMonth,
            'source' => fake()->randomElement(['DataProviderX', 'DataProviderY'])
        ];
    }
}
