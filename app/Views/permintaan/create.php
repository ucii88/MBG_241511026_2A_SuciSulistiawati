<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<h2>Buat Permintaan Bahan</h2>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<form action="<?= base_url('permintaan/store') ?>" method="post" id="form-create-permintaan" onsubmit="return validateForm('form-create-permintaan');">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="tgl_masak" class="form-label required">Tanggal Masak</label>
        <input type="date" class="form-control" id="tgl_masak" name="tgl_masak" value="<?= old('tgl_masak') ?>" required>
        <div class="invalid-feedback">
            <i class="fas fa-exclamation-circle"></i>
            Tanggal masak wajib dipilih
        </div>
    </div>
    <div class="mb-3">
        <label for="menu_makan" class="form-label required">Menu Makanan</label>
        <input type="text" class="form-control" id="menu_makan" name="menu_makan" value="<?= old('menu_makan') ?>" required placeholder="Masukkan menu makanan">
        <div class="invalid-feedback">
            <i class="fas fa-exclamation-circle"></i>
            Menu makanan wajib diisi
        </div>
    </div>
    <div class="mb-3">
        <label for="jumlah_porsi" class="form-label required">Jumlah Porsi</label>
        <input type="number" class="form-control" id="jumlah_porsi" name="jumlah_porsi" value="<?= old('jumlah_porsi') ?>" min="1" required placeholder="Masukkan jumlah porsi">
        <div class="invalid-feedback">
            <i class="fas fa-exclamation-circle"></i>
            Jumlah porsi wajib diisi dan minimal 1
        </div>
    </div>
    <div id="bahan-fields">
        <div class="row mb-3">
            <div class="col-5">
                <label for="bahan_id[0]" class="form-label required">Bahan</label>
                <select class="form-select" id="bahan_id[0]" name="bahan_id[0]" required>
                    <option value="">Pilih Bahan</option>
                    <?php foreach ($bahan as $item): ?>
                        <option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <i class="fas fa-exclamation-circle"></i>
                    Bahan wajib dipilih
                </div>
            </div>
            <div class="col-5">
                <label for="jumlah_diminta[0]" class="form-label required">Jumlah Diminta</label>
                <input type="number" class="form-control" id="jumlah_diminta[0]" name="jumlah_diminta[0]" min="1" required placeholder="Masukkan jumlah yang diminta">
                <div class="invalid-feedback">
                    <i class="fas fa-exclamation-circle"></i>
                    Jumlah diminta wajib diisi
                </div>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-secondary mt-4" onclick="addBahanField(document.querySelector('#bahan_id[0]').innerHTML)">Tambah Bahan</button>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary" onclick="return validateAndConfirm(event, 'form-create-permintaan', 'kirim')">
        <i class="fas fa-paper-plane"></i> Kirim Permintaan
    </button>
    <a href="<?= base_url('permintaan') ?>" class="btn btn-secondary ms-2">
        <i class="fas fa-times"></i> Batal
    </a>
</form>

<!-- Modal Konfirmasi Kirim -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Kirim Permintaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-question-circle text-primary fa-3x mb-3"></i>
                <p class="mb-0">Apakah Anda yakin ingin mengirim permintaan ini?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="button" class="btn btn-primary" onclick="submitForm('form-create-permintaan')">
                    <i class="fas fa-paper-plane"></i> Ya, Kirim
                </button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>