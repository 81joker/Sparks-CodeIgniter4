<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateOrderLineTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT','constraint'     => '11', 'unsigned' => true, 'auto_increment' => true],
            'product_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true], 
            'order_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true], 
            'quantity'    => ['type' => 'INT', 'constraint' => 11],
            'created_at'  => [ 'type'    => 'TIMESTAMP','default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'  => ['type'    => 'TIMESTAMP','default' => new RawSql('CURRENT_TIMESTAMP')],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('order_id', 'orders', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('order_line' , true);

    }

    public function down()
    {
        $this->forge->dropTable('order_line');
    }
}
