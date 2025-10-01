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
                <td><?= $item['status'] ?></td>
                <td>
                    <a href="<?= base_url('bahan/edit/' . $item['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <?php if ($item['status'] === 'kadaluarsa'): ?>
                        <a href="<?= base_url('bahan/delete/' . $item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus bahan kadaluarsa?')">Hapus</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>