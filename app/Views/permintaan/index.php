<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<h2>Lihat Status Permintaan</h2>
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
            <?php if (session()->get('role') === 'gudang'): ?>
                <th>Bahan Diminta (Jumlah)</th>
                <th>Aksi</th>
            <?php endif; ?>
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
            if (session()->get('role') === 'gudang' && isset($item['bahan_nama'])) {
                $groupedPermintaan[$id]['bahan'][] = $item['bahan_nama'] . ' (' . ($item['jumlah_diminta'] ?? 0) . ')';
            }
        }
        foreach ($groupedPermintaan as $item): ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['pemohon_name'] ?></td>
                <td><?= $item['tgl_masak'] ?></td>
                <td><?= $item['menu_makan'] ?></td>
                <td><?= $item['jumlah_porsi'] ?></td>
                <td><?= $item['status'] ?></td>
                <?php if (session()->get('role') === 'gudang'): ?>
                    <td><?= implode(', ', $item['bahan']) ?: 'Tidak ada detail' ?></td>
                    <td>
                        <?php if ($item['status'] === 'menunggu'): ?>
                            <div class="btn-group" role="group">
                                <a href="<?= base_url('permintaan/approve/' . $item['id']) ?>" class="btn btn-success btn-sm" onclick="return confirm('Yakin approve? Stok akan dikurangi.')">Approve</a>
                                <a href="<?= base_url('permintaan/reject/' . $item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin reject?')">Reject</a>
                            </div>
                        <?php endif; ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>