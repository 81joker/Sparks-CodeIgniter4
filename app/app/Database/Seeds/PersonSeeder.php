<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\PersonModel;

class PersonSeeder extends Seeder
{
    public function run()
    {


        $PersonModel = new PersonModel();
        $faker = \Faker\Factory::create();

            for ($i = 0; $i < 20; $i++) {
                $PersonModel->insert([
                    'firstname' => $faker->firstName,
                    'lastname' => $faker->lastName,
                    'email' => $faker->email,
                    'phone' => $faker->phoneNumber,
                    'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                    'updated_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                ]);
        }
    }
}
