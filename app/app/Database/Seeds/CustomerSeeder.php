<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\CustomerModel;
use App\Models\PersonModel;
use App\Models\UserModel;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $customerModel = new CustomerModel();
        $personModel = new PersonModel();
        $userModel = new \App\Models\UserModel();

        $persons = $personModel->findAll();
        $personIds = array_column($persons, 'id');

        // Get all person_ids already used in users
        $userPersonIds = array_column($userModel->findAll(), 'person_id');

        // Ensure no duplicates with users
        $availablePersonIds = array_diff($personIds, $userPersonIds);
        shuffle($availablePersonIds); // randomize the order

        $customerIds = [];
        $usedPersonIds = [];

        // Create parent customers first (unique person_id)
        for ($i = 0; $i < 10 && !empty($availablePersonIds); $i++) {
            $personId = array_pop($availablePersonIds);

            $data = [
                'person_id'  => $personId,
                'parent_id'  => null,
                'type'       => 'parent',
                'password' => password_hash('password', PASSWORD_BCRYPT),
                'image'      => $faker->imageUrl(200, 200, 'people'),
                'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
            ];

            $id = $customerModel->insert($data);
            $customerIds[] = $id;
            $usedPersonIds[] = $personId;
        }

        // Refresh available person IDs to avoid reusing same ones
        $availablePersonIds = array_values(array_diff($availablePersonIds, $usedPersonIds));

        // Create child customers (person_id must not be reused)
        for ($i = 0; $i < 10 && !empty($availablePersonIds); $i++) {
            $personId = array_pop($availablePersonIds);

            $data = [
                'person_id'  => $personId,
                'parent_id'  => $faker->randomElement($customerIds),
                'type'       => 'child',
                'image'      => $faker->imageUrl(200, 200, 'people'),
                'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
            ];

            $customerModel->insert($data);
        }
    }
}
