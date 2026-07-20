<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PrefixeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['valeur' => '033', 'actif' => 1],
            ['valeur' => '037', 'actif' => 1],
        ];

        $this->db->table('prefixe')->insertBatch($data);
    }
}
