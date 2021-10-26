<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CashRegister extends Migration
{
    protected $name = 'cash_registers';

    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'cash_register'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => false,
            ],
            'number'    => [
                'type'          => 'INT',
                'constraint'    => '10',
                'null'          => false,
            ],
            'hash'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '200',
                'null'          => false,
            ],
            'state'    => [
                'type'          => 'TINYINT',
                'constraint'    => '1',
                'default'        => '1',
                'null'          => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addField("created_at DATETIME NULL DEFAULT NULL");
        $this->forge->addField("updated_at DATETIME NULL DEFAULT NULL");
        $this->forge->addField("deleted_at DATETIME NULL DEFAULT NULL");
        $this->forge->createTable($this->name);
    }

    public function down()
    {
        $this->forge->dropTable($this->name);
    }
}
