<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailsPurchase extends Migration
{
    protected $name = 'details_purchase';

    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'total'    => [
                'type'          => 'DOUBLE',
                'constraint'    => '10,2',
                'null'          => true,
            ],
            'payment_method'    => [
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
            'detail_sale_id'    => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'client_id'    => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'product_id'    => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true
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
        $this->forge->addForeignKey('detail_sale_id', 'details_sales', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('client_id', 'clients', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'cascade', 'cascade');
        $this->forge->createTable($this->name);
    }

    public function down()
    {
        $this->forge->dropTable($this->name);
    }
}
