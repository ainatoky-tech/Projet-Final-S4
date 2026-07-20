<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CommissionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id_operateur' => 2, 'pourcentage' => 5.00, 'actif' => 1],
            ['id_operateur' => 3, 'pourcentage' => 7.00, 'actif' => 1],
        ];

        $this->db->table('commission')->insertBatch($data);
    }
}
