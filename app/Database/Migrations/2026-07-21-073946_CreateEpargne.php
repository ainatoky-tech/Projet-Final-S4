<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEpargne extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            
            'pourcentage' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => false,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('epargne');
    }

    public function down()
    {
        $this->forge->dropTable('epargne');
    }
}
