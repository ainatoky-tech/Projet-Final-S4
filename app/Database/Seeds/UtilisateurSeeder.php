<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UtilisateurSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['login' => 'admin', 'password' => 'admin123', 'role' => 'ADMIN'],
        ];

        $this->db->table('utilisateur')->insertBatch($data);
    }
}
