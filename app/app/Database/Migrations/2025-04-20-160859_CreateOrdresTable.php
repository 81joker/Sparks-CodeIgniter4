<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateOrdresTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT','constraint'     => '11', 'unsigned' => true, 'auto_increment' => true],
            'customer_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true], 
            'image'      => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'order_number'    => ['type' => 'VARCHAR', 'constraint' => '50', 'unique' => true], 
            'cost'       => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'total_amount'      => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'order_status' => ['type' => 'ENUM','constraint' => ['pending', 'processing', 'completed', 'cancelled' , 'paid' ,'unpaid'],'default' => 'cancelled'],
            'created_at'  => [ 'type'    => 'TIMESTAMP','default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'  => ['type'    => 'TIMESTAMP','default' => new RawSql('CURRENT_TIMESTAMP')],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('customer_id', 'customers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('orders' , true);

    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
