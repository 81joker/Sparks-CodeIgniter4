<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreatePersonTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            // 'type'       => ['type' => "ENUM('parent','child')", 'null' => false],
            'firstname'  => ['type' => 'VARCHAR', 'constraint' => '100'],
            'lastname'   => ['type' => 'VARCHAR', 'constraint' => '100'],
            'email'      => ['type' => 'VARCHAR', 'constraint' => '150', 'unique' => true],
            'phone'      => ['type' => 'VARCHAR', 'constraint' => '20', 'null' => true],
            'created_at'  => ['type'    => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'  => ['type'    => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP')],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('persons', true);
    }

    public function down()
    {
        $this->forge->dropTable('persons');
    }
}
