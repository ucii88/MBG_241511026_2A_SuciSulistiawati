<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Pemohon</th>
            <th>Tanggal Masak</th>
            <th>Menu</th>
            <th>Jumlah Porsi</th>
            <th>Status</th>
            <th>Bahan Diminta (Jumlah)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $groupedPermintaan = [];
        foreach ($permintaan as $item) {
            $id = $item['id'];
            if (!isset($groupedPermintaan[$id])) {
                $groupedPermintaan[$id] = [
                    'id' => $item['id'],
                    'pemohon_name' => $item['pemohon_name'],
                    'tgl_masak' => $item['tgl_masak'],
                    'menu_makan' => $item['menu_makan'],
                    'jumlah_porsi' => $item['jumlah_porsi'],
                    'status' => $item['status'],
                    'bahan' => []
                ];
            }
            $groupedPermintaan[$id]['bahan'][] = $item['bahan_nama'] . ' (' . $item['jumlah_diminta'] . ')';
        }
        foreach ($groupedPermintaan as $item): ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['pemohon_name'] ?></td>
                <td><?= $item['tgl_masak'] ?></td>
                <td><?= $item['menu_makan'] ?></td>
                <td><?= $item['jumlah_porsi'] ?></td>
                <td><?= $item['status'] ?></td>
                <td><?= implode(', ', $item['bahan']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>