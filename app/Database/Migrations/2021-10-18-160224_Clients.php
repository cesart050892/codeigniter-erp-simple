<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clients extends Migration
{
    protected $name = 'clients';

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
            'email'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '75',
                'null'          => true,
            ],
            'phone'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '15',
                'null'          => true,
            ],
            'address'    => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'contact'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '75',
                'null'          => true,
            ],
            'ruc'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '75',
                'null'          => true,
            ],
            'photo'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'default'       => 'default.png'
            ],
            'state'    => [
                'type'          => 'TINYINT',
                'constraint'    => '2',
                'default'        => '1'
            ],
            'user_id'    => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addField("created_at DATETIME NULL DEFAULT NULL");
        $this->forge->addField("updated_at DATETIME NULL DEFAULT NULL");
        $this->forge->addField("deleted_at DATETIME NULL DEFAULT NULL");
        $this->forge->addForeignKey('user_id', 'users', 'id', 'cascade', 'cascade');
        $this->forge->createTable($this->name);
    }

    public function down()
    {
        $this->forge->dropTable($this->name);
    }
}
