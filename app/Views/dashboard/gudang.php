<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<h2>Dashboard Gudang</h2>
<p>Selamat datang, <?= session()->get('name') ?>! Kelola stok bahan baku di sini.</p>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<a href="<?= base_url('bahan') ?>" class="btn btn-primary mb-3">Lihat Data Bahan Baku</a>

<?= $this->endSection() ?>