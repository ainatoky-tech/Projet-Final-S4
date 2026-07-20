<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(PrefixeSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(TypeOperationSeeder::class);
        $this->call(BaremeFraisSeeder::class);
    }
}
