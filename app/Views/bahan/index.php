<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<a href="<?= base_url('bahan/create') ?>" class="btn btn-primary mb-3">Tambah Bahan</a>
<a href="<?= base_url('permintaan') ?>" class="btn btn-info mb-3 ms-2">Lihat Status Permintaan</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Tgl Masuk</th>
            <th>Tgl Kadaluarsa</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bahan as $item): ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['nama'] ?></td>
                <td><?= $item['kategori'] ?></td>
                <td><?= $item['jumlah'] ?></td>
                <td><?= $item['satuan'] ?></td>
                <td><?= $item['tanggal_masuk'] ?></td>
                <td><?= $item['tanggal_kadaluarsa'] ?></td>
                <td>
                    <span class="badge bg-<?php 
                        echo match($item['status']) {
                            'tersedia' => 'success',
                            'habis' => 'danger',
                            'kadaluarsa' => 'dark',
                            'segera_kadaluarsa' => 'warning',
                            'tidak_aktif' => 'secondary',
                            'dihapus' => 'secondary',
                            default => 'info'
                        };
                    ?>">
                        <?= str_replace('_', ' ', ucfirst($item['status'])) ?>
                    </span>
                </td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="openConfirmationModal('<?= $item['id'] ?>', 'edit', '<?= base_url('bahan/edit/' . $item['id']) ?>')">Edit</button>
                    <?php if ($item['status'] === 'kadaluarsa'): ?>
                        <button class="btn btn-danger btn-sm" onclick="openConfirmationModal('<?= $item['id'] ?>', 'hapus', '<?= base_url('bahan/delete/' . $item['id']) ?>')">Hapus</button>
                    <?php endif; ?>
                </td>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>