<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<h2>Edit Bahan Baku</h2>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<form action="<?= base_url('bahan/update/' . $bahan['id']) ?>" method="post">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Bahan</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama', $bahan['nama']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="kategori" class="form-label">Kategori</label>
        <input type="text" class="form-control" id="kategori" name="kategori" value="<?= old('kategori', $bahan['kategori']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah</label>
        <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= old('jumlah', $bahan['jumlah']) ?>" min="0" required>
    </div>
    <div class="mb-3">
        <label for="satuan" class="form-label">Satuan</label>
        <input type="text" class="form-control" id="satuan" name="satuan" value="<?= old('satuan', $bahan['satuan']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?= old('tanggal_masuk', $bahan['tanggal_masuk']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
        <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" value="<?= old('tanggal_kadaluarsa', $bahan['tanggal_kadaluarsa']) ?>" required>
    </div>
    <button type="button" class="btn btn-warning" onclick="showUpdateConfirmation(this.form)">
        <i class="fas fa-save me-2"></i>Update
    </button>
    <a href="<?= base_url('bahan') ?>" class="btn btn-light">
        <i class="fas fa-times me-2"></i>Batal
    </a>
</form>

<!-- Modal Konfirmasi Update -->
<div class="modal fade" id="updateConfirmationModal" tabindex="-1" aria-labelledby="updateConfirmationModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="updateConfirmationModalLabel">Konfirmasi Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <div class="text-center mb-4">
                    <i class="fas fa-edit text-warning fa-3x"></i>
                </div>
                <p class="text-center fs-5 mb-0">Apakah Anda yakin ingin mengupdate data bahan ini?</p>
                <div class="mt-4 p-3 bg-light rounded">
                    <div class="row">
                        <div class="col-4"><strong>Nama Bahan:</strong></div>
                        <div class="col-8" id="confirmNama"></div>
                    </div>
                    <div class="row">
                        <div class="col-4"><strong>Jumlah:</strong></div>
                        <div class="col-8"><span id="confirmJumlah"></span> <span id="confirmSatuan"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-4"><strong>Kategori:</strong></div>
                        <div class="col-8" id="confirmKategori"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center gap-2">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-warning px-4" id="confirmUpdateBtn">
                    <i class="fas fa-save me-2"></i>Update
                </button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>