<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePromotion extends Migration
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
            
            'valeur' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => false,
            ],
            
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('promotion');
    }

    public function down()
    {
        $this->forge->dropTable('promotion');
    }
}
