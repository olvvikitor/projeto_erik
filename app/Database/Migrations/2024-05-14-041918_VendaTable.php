<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VendaTable extends Migration
{
    public function up()
    {
       $this->forge->addField([
        'id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'auto_increment' => true,
        ],
        'cart_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
        ],
        'user_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
        ],
        'product_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
        ],
        'quantidade' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
        ],
        'valor' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
        ],
        'created_at' => [
            'type' => 'DATETIME',
        ],
       ]);
    
       $this->forge->addPrimaryKey('id');
       $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
       $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
       $this->forge->addForeignKey('cart_id', 'cart', 'id', 'CASCADE', 'CASCADE');
       $this->forge->createTable('vendas');
    }

    public function down()
    {
        $this->forge->dropTable('vendas');
    }
}
