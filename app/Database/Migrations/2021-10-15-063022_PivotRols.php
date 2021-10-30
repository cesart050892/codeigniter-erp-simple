<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PivotRols extends Migration
{
    protected $name = 'pivot_rols';

    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'rol_id'    => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'section_id'    => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'permission_id'    => [
                'type'           => 'BIGINT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addField("created_at DATETIME NULL DEFAULT NULL");
        $this->forge->addField("updated_at DATETIME NULL DEFAULT NULL");
        $this->forge->addField("deleted_at DATETIME NULL DEFAULT NULL");
        $this->forge->addForeignKey('rol_id', 'rols', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('section_id', 'sections', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('permission_id', 'permissions', 'id', 'cascade', 'cascade');
        $this->forge->addUniqueKey(['section_id', 'permission_id']);
        $this->forge->createTable($this->name);
    }

    public function down()
    {
        $this->forge->dropTable($this->name);
    }
}
