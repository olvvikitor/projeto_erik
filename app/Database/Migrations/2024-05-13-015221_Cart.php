<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cart extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' =>[
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cart');
    }


    public function down()
    {
        $this->forge->dropTable('cart');
    }
}
