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
            'user_id' =>[
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'product_id' =>[
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'quantidade' =>[
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'valor' =>[
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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
