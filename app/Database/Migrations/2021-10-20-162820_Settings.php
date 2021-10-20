<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Settings extends Migration
{
    protected $name = 'settings';

    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'option'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '200',
                'null'          => false,
            ],
            'value'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '200',
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
