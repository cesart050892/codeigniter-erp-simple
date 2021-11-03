<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    protected $name = 'users';

    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '75',
            ],
            'surname'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '75',
                'null'          => true,
            ],
            'fullname'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '200',
                'null'          => true,
            ],
            'photo'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'default'       => 'profile_default.png'
            ],
            'address'    => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'phone'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '75',
                'null'          => true,
            ],
            'state'    => [
                'type'          => 'TINYINT',
                'constraint'    => '1',
                'default'        => '1',
                'null'          => true,
            ],
            'last_login'    => [
                'type'          => 'DATETIME',
                'null'          => true,
            ],
            'auth_id'    => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'rol_id'    => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true,
                'default'        => '1'
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addField("created_at DATETIME NULL DEFAULT NULL");
        $this->forge->addField("updated_at DATETIME NULL DEFAULT NULL");
        $this->forge->addField("deleted_at DATETIME NULL DEFAULT NULL");
        $this->forge->addForeignKey('rol_id', 'rols', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('auth_id', 'auth', 'id', 'cascade', 'cascade');
        $this->forge->addUniqueKey('auth_id');
        $this->forge->createTable($this->name);
    }

    public function down()
    {
        $this->forge->dropTable($this->name);
    }
}
