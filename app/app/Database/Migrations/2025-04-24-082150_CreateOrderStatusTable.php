<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateOrderStatusTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT','constraint'     => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'  => ['type' => 'VARCHAR', 'constraint' => '100'],

            // 'order_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true ,'unique' => true], 
            // 'product_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true ,'unique' => true], 
            // 'type' => ['type' => 'ENUM','constraint' => ['parent', 'child'],'default' => 'parent'],
            // 'avatar'     => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            // 'status'     => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'active', 'null' => false],
            // 'password' => ['type' => 'VARCHAR','constraint' => '255'],
            'created_at'  => [ 'type'    => 'TIMESTAMP','default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'  => ['type'    => 'TIMESTAMP','default' => new RawSql('CURRENT_TIMESTAMP')],
        ]);
        $this->forge->addPrimaryKey('id');
        // $this->forge->addForeignKey('order_id', 'orders', 'id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('OrderStatus', true);
    }

    public function down()
    {
        $this->forge->dropTable('OrderStatus');
    }
}
