<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    protected $name = 'products';

    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'code'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '75',
            ],
            'description'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '75',
            ],
            'cost'    => [
                'type'          => 'DOUBLE',
                'constraint'    => '10,2',
                'null'          => true,
            ],
            'price'    => [
                'type'          => 'DOUBLE',
                'constraint'    => '10,2',
                'null'          => true,
            ],
            'stock'    => [
                'type'          => 'INT',
                'constraint'    => '10',
                'null'          => true,
                'default'        => '0'
            ],
            'non_inventoriable'    => [
                'type'          => 'TINYINT',
                'constraint'    => '1',
                'null'          => true,
                'default'        => null
            ],
            'minimum'    => [
                'type'          => 'INT',
                'constraint'    => '10',
                'null'          => false,
                'default'        => '1'
            ],
            'photo'    => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'state'    => [
                'type'          => 'TINYINT',
                'constraint'    => '1',
                'default'        => '1',
                'null'          => true,
            ],
            'user_id'    => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'supplier_id'    => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addField("created_at DATETIME NULL DEFAULT NULL");
        $this->forge->addField("updated_at DATETIME NULL DEFAULT NULL");
        $this->forge->addField("deleted_at DATETIME NULL DEFAULT NULL");
        $this->forge->addForeignKey('user_id', 'users', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('supplier_id', 'suppliers', 'id', 'cascade', 'cascade');
        $this->forge->createTable($this->name);
    }

    public function down()
    {
        $this->forge->dropTable($this->name);
    }
}
