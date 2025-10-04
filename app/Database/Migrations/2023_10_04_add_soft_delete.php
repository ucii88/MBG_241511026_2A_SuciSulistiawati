<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSoftDelete extends Migration
{
    public function up()
    {
        $this->forge->addColumn('bahan_baku', [
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('bahan_baku', 'deleted_at');
    }
}