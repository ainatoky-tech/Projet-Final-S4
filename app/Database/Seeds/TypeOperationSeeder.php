<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TypeOperationSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['libelle' => 'Depot'],
            ['libelle' => 'Retrait'],
            ['libelle' => 'Transfert'],
        ];

        $this->db->table('type_operation')->insertBatch($data);
    }
}
