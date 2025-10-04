<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<h2>Tambah Bahan Baku</h2>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<form action="<?= base_url('bahan/store') ?>" method="post" id="form-create-bahan" onsubmit="return validateForm('form-create-bahan');">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="nama" class="form-label required">Nama Bahan</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama') ?>" required placeholder="Masukkan nama bahan">
        <div class="invalid-feedback">
            <i class="fas fa-exclamation-circle"></i>
            Nama bahan wajib diisi
        </div>
    </div>
    <div class="mb-3">
        <label for="kategori" class="form-label required">Kategori</label>
        <input type="text" class="form-control" id="kategori" name="kategori" value="<?= old('kategori') ?>" required placeholder="Masukkan kategori bahan">
        <div class="invalid-feedback">
            <i class="fas fa-exclamation-circle"></i>
            Kategori wajib diisi
        </div>
    </div>
    <div class="mb-3">
        <label for="jumlah" class="form-label required">Jumlah</label>
        <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= old('jumlah') ?>" min="0" required placeholder="Masukkan jumlah">
        <div class="invalid-feedback">
            <i class="fas fa-exclamation-circle"></i>
            Jumlah harus diisi dan minimal 0
        </div>
    </div>
    <div class="mb-3">
        <label for="satuan" class="form-label required">Satuan</label>
        <input type="text" class="form-control" id="satuan" name="satuan" value="<?= old('satuan') ?>" required placeholder="Masukkan satuan (contoh: kg, gram)">
        <div class="invalid-feedback">
            <i class="fas fa-exclamation-circle"></i>
            Satuan wajib diisi
        </div>
    </div>
    <div class="mb-3">
        <label for="tanggal_masuk" class="form-label required">Tanggal Masuk</label>
        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?= old('tanggal_masuk', date('Y-m-d')) ?>" required>
        <div class="invalid-feedback">
            <i class="fas fa-exclamation-circle"></i>
            Tanggal masuk wajib dipilih
        </div>
    </div>
    <div class="mb-3">
        <label for="tanggal_kadaluarsa" class="form-label required">Tanggal Kadaluarsa</label>
        <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" value="<?= old('tanggal_kadaluarsa') ?>" required>
        <div class="invalid-feedback">
            <i class="fas fa-exclamation-circle"></i>
            Tanggal kadaluarsa wajib dipilih
        </div>
    </div>
    <button type="submit" class="btn btn-primary" onclick="return validateAndConfirm(event, 'form-create-bahan', 'tambah')">
        <i class="fas fa-save"></i> Simpan
    </button>
    <a href="<?= base_url('bahan') ?>" class="btn btn-secondary">
        <i class="fas fa-times"></i> Batal
    </a>
</form>

<!-- Modal Konfirmasi Tambah Bahan -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Tambah Bahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-question-circle text-primary fa-3x mb-3"></i>
                <p class="mb-0">Apakah Anda yakin ingin menambahkan bahan ini?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="button" class="btn btn-primary" onclick="submitForm('form-create-bahan')">
                    <i class="fas fa-check"></i> Ya, Tambahkan
                </button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>