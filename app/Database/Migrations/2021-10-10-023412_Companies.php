<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Companies extends Migration
{
    protected $name = 'companies';

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
                'constraint'    => '200',
                'null'          => false,
            ],
            'unique_hash'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '200',
                'null'          => true,
            ],
            'logo'    => [
                'type'          => 'VARCHAR',
                'constraint'    => '200',
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
