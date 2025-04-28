<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class OrderLineSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        // Number of order line items to create
        $numEntries = 50;

        $data = [];
        for ($i = 0; $i < $numEntries; $i++) {
            $data[] = [
                'product_id' => $faker->numberBetween(1, 10), 
                'order_id'   => $faker->numberBetween(1, 20), 
                'quantity'   => $faker->numberBetween(1, 10),
            ];
        }

        $this->db->table('order_line')->insertBatch($data);
    }
}