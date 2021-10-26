<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailsSales extends Migration
{
    protected $name = 'details_sales';

    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'details'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => false,
            ],
            'price'    => [
                'type'          => 'DOUBLE',
                'constraint'    => '10,2',
                'null'          => true,
            ],
            'quantity'    => [
                'type'          => 'INT',
                'constraint'    => '10',
                'null'          => true,
            ],
            'state'    => [
                'type'          => 'TINYINT',
                'constraint'    => '1',
                'default'        => '1',
                'null'          => true,
            ],
            'product_id'    => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'sale_id'    => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addField("created_at DATETIME NULL DEFAULT NULL");
        $this->forge->addField("updated_at DATETIME NULL DEFAULT NULL");
        $this->forge->addField("deleted_at DATETIME NULL DEFAULT NULL");
        $this->forge->addForeignKey('sale_id', 'sales', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'cascade', 'cascade');
        $this->forge->createTable($this->name);
    }

    public function down()
    {
        $this->forge->dropTable($this->name);
    }
}