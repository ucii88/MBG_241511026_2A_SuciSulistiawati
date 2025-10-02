<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<h2>Dapur MBG</h2>
<p>Selamat datang, <?= session()->get('name') ?>! Kelola permintaan bahan di sini.</p>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<a href="<?= base_url('permintaan/create') ?>" class="btn btn-primary mb-3">Tambah Permintaan Baru</a>
<a href="<?= base_url('permintaan') ?>" class="btn btn-info mb-3 ms-2">Lihat Status Permintaan</a>
<?= $this->endSection() ?>