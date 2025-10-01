<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<h2>Tambah Bahan Baku</h2>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<form action="<?= base_url('bahan/store') ?>" method="post">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Bahan</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama') ?>" required>
    </div>
    <div class="mb-3">
        <label for="kategori" class="form-label">Kategori</label>
        <input type="text" class="form-control" id="kategori" name="kategori" value="<?= old('kategori') ?>" required>
    </div>
    <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah</label>
        <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= old('jumlah') ?>" min="0" required>
    </div>
    <div class="mb-3">
        <label for="satuan" class="form-label">Satuan</label>
        <input type="text" class="form-control" id="satuan" name="satuan" value="<?= old('satuan') ?>" required>
    </div>
    <div class="mb-3">
        <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?= old('tanggal_masuk', date('Y-m-d')) ?>" required>
    </div>
    <div class="mb-3">
        <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
        <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" value="<?= old('tanggal_kadaluarsa') ?>" required>
    </div>
    <button type="submit" class="btn btn-primary" onclick="return confirm('Yakin tambah bahan?')">Simpan</button>
    <a href="<?= base_url('bahan') ?>" class="btn btn-secondary">Batal</a>
</form>
<?= $this->endSection() ?>