<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\PersonModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $personModel = new PersonModel();

        $persons = $personModel->findAll();
        $personIds = array_column($persons, 'id');

        // Shuffle to randomize and avoid overlap with customers
        shuffle($personIds);

        // Take the first 20 unique person_ids for users
        $userPersonIds = array_slice($personIds, 0, 20);
        $roles = ['admin', 'instructor'];

        $data = [];
        foreach ($userPersonIds as $i => $personId) {
            $data[] = [
                'person_id' => $personId,
                'password' => password_hash('password', PASSWORD_BCRYPT),
                'role' => $roles[array_rand($roles)],
                'avatar'      => null,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('users')->insertBatch($data);
    }
}
