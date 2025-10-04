<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAlasanDitolakToPermintaan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('permintaan', [
            'alasan_ditolak' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'status'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('permintaan', 'alasan_ditolak');
    }
}