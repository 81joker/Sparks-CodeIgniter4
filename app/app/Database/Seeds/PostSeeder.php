<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('posts')->insert([
            'title' => 'Welcome to CodeIgniter 4',
            'body'  => 'This is a sample post.',
        ]);
        $this->db->table('posts')->insert([
            'title' => 'Welcome to CodeIgniter 4 Post 2',
            'body'  => 'This is a sample post 2.',
        ]);
        
    }
}
