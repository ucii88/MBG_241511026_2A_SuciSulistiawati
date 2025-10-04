<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h2 class="mb-4">Dashboard Gudang</h2>
    <p>Selamat datang, <?= session()->get('name') ?>!</p>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Permintaan Menunggu</h6>
                            <h2 class="mt-2 mb-0"><?= $total_menunggu ?></h2>
                        </div>
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Permintaan Disetujui</h6>
                            <h2 class="mt-2 mb-0"><?= $total_disetujui ?></h2>
                        </div>
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Permintaan Ditolak</h6>
                            <h2 class="mt-2 mb-0"><?= $total_ditolak ?></h2>
                        </div>
                        <i class="fas fa-times-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <a href="<?= base_url('bahan') ?>" class="btn btn-primary">
                <i class="fas fa-boxes"></i> Kelola Data Bahan Baku
            </a>
            <a href="<?= base_url('permintaan') ?>" class="btn btn-info ms-2">
                <i class="fas fa-clipboard-list"></i> Lihat Semua Permintaan
            </a>
        </div>
    </div>

<?= $this->endSection() ?>