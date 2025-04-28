<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateCustomerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT','constraint'     => 11, 'unsigned' => true, 'auto_increment' => true],
            'person_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true ,'unique' => true], 
            'parent_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true ,'null' => true], 
            'type' => ['type' => 'ENUM','constraint' => ['parent', 'child'],'default' => 'parent'],
            'avatar'     => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'status'     => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'active', 'null' => false],
            'password' => ['type' => 'VARCHAR','constraint' => '255'],
            'created_at'  => [ 'type'    => 'TIMESTAMP','default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'  => ['type'    => 'TIMESTAMP','default' => new RawSql('CURRENT_TIMESTAMP')],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('person_id', 'persons', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('parent_id', 'customers', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('customers', true);

    }

    public function down()
    {
        $this->forge->dropTable('customers');
    }
}
