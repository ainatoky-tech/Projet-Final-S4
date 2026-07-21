<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EpargneSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['pourcentage' => 20],
            ['pourcentage' => 50],
            ['pourcentage' => 60]
        ];

        $this->db->table('epargne')->insertBatch($data);
    }
}
