<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Currencies extends Migration
{
    protected $name = 'currencies';

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
                'constraint'    => '255',
                'null'          => false,
            ],
            'code'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => false,
            ],
            'symbol'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => false,
            ],
            'precision'    => [
                'type'          => 'INT',
                'constraint'    => '10',
                'null'          => false,
            ],
            'thousand_separator'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => false,
            ],
            'decimal_separator'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => false,
            ],
            'swap_currency_symbol'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => false,
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
