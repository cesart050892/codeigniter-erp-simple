<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CompanySettings extends Migration
{
    protected $name = 'companies_settings';

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
                'null'          => true,
            ],
            'state'    => [
                'type'          => 'TINYINT',
                'constraint'    => '1',
                'null'          => true,
            ],
            'company_id'    => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addField("created_at DATETIME NULL DEFAULT NULL");
        $this->forge->addField("updated_at DATETIME NULL DEFAULT NULL");
        $this->forge->addField("deleted_at DATETIME NULL DEFAULT NULL");
        $this->forge->addForeignKey('company_id', 'companies', 'id', 'cascade', 'cascade');
        $this->forge->createTable($this->name);
    }

    public function down()
    {
        $this->forge->dropTable($this->name);
    }
}
