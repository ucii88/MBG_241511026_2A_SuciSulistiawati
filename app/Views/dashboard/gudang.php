<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<h2>Dashboard Gudang</h2>
<p>Selamat datang, <?= session()->get('name') ?>! Kelola bahan baku dan permintaan.</p>
<?= $this->endSection() ?>