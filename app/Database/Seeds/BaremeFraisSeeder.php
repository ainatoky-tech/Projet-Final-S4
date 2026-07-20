<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BaremeFraisSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Depot (id_type_operation = 1) : frais = 0
            ['id_type_operation' => 1, 'montant_min' => 0, 'montant_max' => 999999999, 'frais' => 0, 'actif' => 1],

            // Retrait (id_type_operation = 2)
            ['id_type_operation' => 2, 'montant_min' => 0,        'montant_max' => 10000,    'frais' => 200, 'actif' => 1],
            ['id_type_operation' => 2, 'montant_min' => 10001,    'montant_max' => 50000,    'frais' => 500, 'actif' => 1],
            ['id_type_operation' => 2, 'montant_min' => 50001,    'montant_max' => 100000,   'frais' => 1000, 'actif' => 1],
            ['id_type_operation' => 2, 'montant_min' => 100001,   'montant_max' => 999999999, 'frais' => 1500, 'actif' => 1],

            // Transfert (id_type_operation = 3)
            ['id_type_operation' => 3, 'montant_min' => 0,        'montant_max' => 10000,    'frais' => 100, 'actif' => 1],
            ['id_type_operation' => 3, 'montant_min' => 10001,    'montant_max' => 50000,    'frais' => 300, 'actif' => 1],
            ['id_type_operation' => 3, 'montant_min' => 50001,    'montant_max' => 100000,   'frais' => 700, 'actif' => 1],
            ['id_type_operation' => 3, 'montant_min' => 100001,   'montant_max' => 999999999, 'frais' => 1200, 'actif' => 1],
        ];

        $this->db->table('bareme_frais')->insertBatch($data);
    }
}
