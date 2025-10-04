<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDeletedAtToBahanBaku extends Migration
{
    public function up()
    {
        // Check if the column doesn't exist first
        $fields = $this->db->getFieldNames('bahan_baku');
        if (!in_array('deleted_at', $fields)) {
            $this->forge->addColumn('bahan_baku', [
                'deleted_at' => [
                    'type'    => 'DATETIME',
                    'null'    => true,
                    'default' => null,
                    'after'   => 'updated_at'
                ]
            ]);
        }
    }

    public function down()
    {
        // Check if the column exists before dropping
        $fields = $this->db->getFieldNames('bahan_baku');
        if (in_array('deleted_at', $fields)) {
            $this->forge->dropColumn('bahan_baku', 'deleted_at');
        }
    }
}