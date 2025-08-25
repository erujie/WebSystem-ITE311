<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        // Create only if not exists (guards against partial states)
        if (! $this->db->tableExists('users')) {
            $this->forge->addField([
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'username' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'unique'     => true,
                ],
                'email' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 150,
                    'unique'     => true,
                ],
                'password' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);

            $this->forge->addKey('id', true);
            $this->forge->createTable('users');
        }
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}
