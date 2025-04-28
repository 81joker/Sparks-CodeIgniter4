<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class XOrderSeeder extends Seeder
{
    public function run()
    {
        $userModel = new \App\Models\UserModel();
        $OrderModel = new \App\Models\OrderModel();
        $faker = \Faker\Factory::create();

        $users = $userModel->findAll();

        if (empty($users)) {
            echo "Keine Benutzer gefunden. Fügen Sie vor dem Versenden von Beiträgen einige Benutzer hinzu.\n";
            return;
        }

        foreach ($users as $user) {
            for ($i = 0; $i < 5; $i++) {
                $OrderModel->insert([
                    // 'title' => $faker->sentence,
                    // 'content' => $faker->paragraph,
                    'cost' => $faker->randomFloat(2, 0, 100),
                    'total' => $faker->randomFloat(2, 0, 100),
                    'person_id' => $user['id'],
                    // 'status' => $faker->randomElement(['active', 'inactive']),
                    // 'image' => 'uploads/image/default.jpg', 
                    'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                    'updated_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
