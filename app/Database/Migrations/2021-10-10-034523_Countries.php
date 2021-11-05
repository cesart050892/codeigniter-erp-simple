<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Countries extends Migration
{
    protected $name = 'countries';

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
                'constraint'    => '50',
                'null'          => false,
            ],
            'name'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => false,
            ],
            'phonecode'    => [
                'type'          => 'INT',
                'constraint'    => 10,
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
