<?php

namespace Database\Factories;

use App\Models\products;
use App\Models\sections;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Retrieve existing products and sections from the database
        $existingProducts = products::pluck('Product_name')->all();
        $existingSections = sections::pluck('section_name')->all();

        return [

            'invoice_number' => fake()->numberBetween(1, 20),
            'invoice_Date' => fake()->date('Y-m-d', 'now'),
            'Due_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'section_id' => fake()->numberBetween(1,3),
            'product' => fake()->numberBetween(1,3),
            'Amount_collection' => fake()->numberBetween(200,10000),
            'Amount_Commission' => fake()->numberBetween(200,10000),
            'Discount' => '10%',
            'Value_VAT' => fake()->numberBetween(200,10000),
            'Rate_VAT' => fake()->numberBetween(200,10000),
            'Total' => fake()->numberBetween(200,10000),
            'Value_Status' => 2,
            'note' => fake()->text(),
            'Status' => 'unpaid',
        ];
    }
}
