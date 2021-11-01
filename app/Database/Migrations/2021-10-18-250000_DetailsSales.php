<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailsSales extends Migration
{
    protected $name = 'details_Sales';

    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'folio'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => false,
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
            'iva'    => [
                'type'          => 'DOUBLE',
                'constraint'    => '10,2',
                'null'          => true,
            ],
            'subtotal'    => [
                'type'          => 'DOUBLE',
                'constraint'    => '10,2',
                'null'          => true,
            ],
            'total'    => [
                'type'          => 'DOUBLE',
                'constraint'    => '10,2',
                'null'          => true,
            ],
            'new_price'    => [
                'type'          => 'DOUBLE',
                'constraint'    => '10,2',
                'null'          => true,
            ],
            'new_stock'    => [
                'type'          => 'INT',
                'constraint'    => '10',
                'null'          => true,
            ],
            'sale_id'    => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'product_id'    => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addField("created_at DATETIME NULL DEFAULT NULL");
        $this->forge->addField("updated_at DATETIME NULL DEFAULT NULL");
        $this->forge->addField("deleted_at DATETIME NULL DEFAULT NULL");
        $this->forge->addForeignKey('product_id', 'products', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('sale_id', 'sales', 'id', 'cascade', 'cascade');
        $this->forge->createTable($this->name);
    }

    public function down()
    {
        $this->forge->dropTable($this->name);
    }
}
