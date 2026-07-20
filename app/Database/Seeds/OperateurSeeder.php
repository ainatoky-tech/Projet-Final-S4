<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OperateurSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nom' => 'Notre Operateur', 'actif' => 1],
            ['nom' => 'Orange Money',    'actif' => 1],
            ['nom' => 'Airtel Money',    'actif' => 1],
        ];

        $this->db->table('operateur')->insertBatch($data);
    }
}
