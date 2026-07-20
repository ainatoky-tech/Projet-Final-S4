<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBaremeFraisTable extends Migration
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
            'id_type_operation' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'montant_min' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => false,
            ],
            'montant_max' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => false,
            ],
            'frais' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => false,
            ],
            'actif' => [
                'type'    => 'BOOLEAN',
                'default' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_type_operation', 'type_operation', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bareme_frais');
    }

    public function down()
    {
        $this->forge->dropTable('bareme_frais');
    }
}
