<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PrefixeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id_operateur' => 1, 'valeur' => '033', 'actif' => 1],
            ['id_operateur' => 1, 'valeur' => '037', 'actif' => 1],
            ['id_operateur' => 2, 'valeur' => '032', 'actif' => 1],
            ['id_operateur' => 3, 'valeur' => '034', 'actif' => 1],
        ];

        $this->db->table('prefixe')->insertBatch($data);
    }
}
