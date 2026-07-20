<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTypeOperationTable extends Migration
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
            'libelle' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('libelle', 'uk_type_operation_libelle');
        $this->forge->createTable('type_operation');
    }

    public function down()
    {
        $this->forge->dropTable('type_operation');
    }
}
