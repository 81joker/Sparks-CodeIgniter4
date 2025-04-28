<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run()
    {
        // $this->call('UserSeeder');
        // $this->call('CountrySeeder');
            $this->call('PersonSeeder');
            $this->call('CustomerSeeder');
            $this->call('UserSeeder');
            $this->call('OrderSeeder');
            $this->call('ProductSeeder');
            $this->call('OrderLineSeeder');
    }
}