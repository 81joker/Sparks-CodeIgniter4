<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\OrderModel;
use App\Models\CustomerModel;
use App\Models\UserModel;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $orderModel = new OrderModel();
        $customerModel = new CustomerModel();
        $customerIds = array_column($customerModel->findAll(), 'id');

        
        for ($i = 0; $i < 30; $i++) {
            $orderModel->insert([
                'customer_id'   => $faker->randomElement($customerIds),
                'image'         => $faker->imageUrl(200, 200, 'business'),
                'order_number'  => 'ORD-' . $faker->unique()->numberBetween(100000, 999999),
                'total_amount'    => $faker->randomFloat(2, 50, 1000),
                'cost'          => $faker->randomFloat(2, 10, 500),
                'order_status'        => $faker->randomElement(['paid','unpaid' ,  'processing', 'completed', 'cancelled']),
                'created_at'    => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                'updated_at'    => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
