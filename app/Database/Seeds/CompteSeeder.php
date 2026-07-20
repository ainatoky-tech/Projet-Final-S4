<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CompteSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['type_compte' => 'CLIENT',    'id_client' => 1],
            ['type_compte' => 'CLIENT',    'id_client' => 2],
            ['type_compte' => 'CLIENT',    'id_client' => 3],
            ['type_compte' => 'OPERATEUR', 'id_client' => null],
        ];

        $this->db->table('compte')->insertBatch($data);
    }
}
