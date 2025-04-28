


1- Users 
# Firstname
# Lastname
# parent_id
# email


2- Orders
<!-- # person_id  --> ??!!
# cost
# total
# 


C// app/Database/Migrations/2024-04-20-CreatePeople.php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePeople extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'auto_increment' => true],
            'parent_id'  => ['type' => 'INT', 'null' => true],
            'first_name' => ['type' => 'VARCHAR', 'constraint' => 50],
            'last_name'  => ['type' => 'VARCHAR', 'constraint' => 50],
            'type'       => ['type' => 'ENUM', 'constraint' => ['parent', 'child']],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('parent_id', 'people', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('people');
    }

    public function down()
    {
        $this->forge->dropTable('people');
    }
}
