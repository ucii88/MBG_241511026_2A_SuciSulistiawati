<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<h2>Daftar Permintaan</h2>
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
            <th>Tgl Masak</th>
            <th>Menu</th>
            <th>Jumlah Porsi</th>
            <th>Status</th>
            <?php if (session()->get('role') === 'gudang'): ?>
                <th>Aksi</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($permintaan as $item): ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $this->model->select('name')->where('id', $item['pemohon_id'])->first()['name'] ?></td>
                <td><?= $item['tgl_masak'] ?></td>
                <td><?= $item['menu_makan'] ?></td>
                <td><?= $item['jumlah_porsi'] ?></td>
                <td><?= $item['status'] ?></td>
                <?php if (session()->get('role') === 'gudang' && $item['status'] === 'menunggu'): ?>
                    <td>
                        <a href="<?= base_url('permintaan/approve/' . $item['id']) ?>" class="btn btn-success btn-sm" onclick="return confirm('Yakin approve?')">Approve</a>
                        <a href="<?= base_url('permintaan/reject/' . $item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin reject?')">Reject</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>