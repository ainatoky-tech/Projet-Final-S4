<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUtilisateurTable extends Migration
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
            'login' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'role' => [
                'type'       => 'ENUM',
                'allowed'    => ['ADMIN'],
                'default'    => 'ADMIN',
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('login', 'uk_utilisateur_login');
        $this->forge->createTable('utilisateur');
    }

    public function down()
    {
        $this->forge->dropTable('utilisateur');
    }
}
