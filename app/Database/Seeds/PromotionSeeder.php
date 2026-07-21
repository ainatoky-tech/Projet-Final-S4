<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PromotionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['valeur' => 10.00],
        ];

        $this->db->table('promotion')->insertBatch($data);
    }
}
