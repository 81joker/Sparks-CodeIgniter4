<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $data = [];
        $categories = ['Phone', 'Laptop', 'Shoes', 'Backpack', 'Watch' ];
        // Generate 10 sample products
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'name'        => $faker->word . ' ' . $categories[array_rand($categories)],
                'description' => $faker->sentence(15),
                'price'       => $faker->randomFloat(2, 5, 500),
                'image'       => "images/products_images/product_$i.jpg" ,
                'stock'       => $faker->numberBetween(0, 10),
                'status'      => $faker->randomElement(['active', 'inactive']),
            ];
        }

        $this->db->table('products')->insertBatch($data);
    }
}