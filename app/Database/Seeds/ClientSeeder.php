<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nom' => 'Jean',      'numero' => '0331234567', 'date_creation' => date('Y-m-d H:i:s'), 'actif' => 1],
            ['nom' => 'Paul',      'numero' => '0379876543', 'date_creation' => date('Y-m-d H:i:s'), 'actif' => 1],
            ['nom' => 'Marie',     'numero' => '0331111111', 'date_creation' => date('Y-m-d H:i:s'), 'actif' => 1],
            ['nom' => 'OPERATEUR', 'numero' => '0000000000', 'date_creation' => date('Y-m-d H:i:s'), 'actif' => 1],
        ];

        $this->db->table('client')->insertBatch($data);
    }
}
