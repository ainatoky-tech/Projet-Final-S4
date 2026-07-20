<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        $this->db->query('PRAGMA foreign_keys = OFF;');
        $this->call('BaremeFraisSeeder');
        $this->call('ClientSeeder');
        $this->call('CompteSeeder');
        $this->call('DatabaseSeeder');
        $this->call('PrefixeSeeder');
        $this->call('TypeOperationSeeder');
        $this->call('UtilisateurSeeder');
        $this->db->query('PRAGMA foreign_keys = ON;');
    }
}
