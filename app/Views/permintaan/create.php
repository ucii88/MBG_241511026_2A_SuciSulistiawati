<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<h2>Tambah Permintaan</h2>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<form action="<?= base_url('permintaan/store') ?>" method="post">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="pemohon_id" class="form-label">ID Pemohon</label>
        <input type="number" class="form-control" id="pemohon_id" name="pemohon_id" required>
    </div>
    <div class="mb-3">
        <label for="tgl_masak" class="form-label">Tanggal Masak</label>
        <input type="date" class="form-control" id="tgl_masak" name="tgl_masak" required>
    </div>
    <div class="mb-3">
        <label for="menu_makan" class="form-label">Menu Makan</label>
        <input type="text" class="form-control" id="menu_makan" name="menu_makan" required>
    </div>
    <div class="mb-3">
        <label for="jumlah_porsi" class="form-label">Jumlah Porsi</label>
        <input type="number" class="form-control" id="jumlah_porsi" name="jumlah_porsi" min="1" required>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="menunggu">Menunggu</option>
            <option value="disetujui">Disetujui</option>
            <option value="ditolak">Ditolak</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary" onclick="return confirm('Yakin tambah permintaan?')">Simpan</button>
    <a href="<?= base_url('permintaan') ?>" class="btn btn-secondary">Batal</a>
</form>
<?= $this->endSection() ?>