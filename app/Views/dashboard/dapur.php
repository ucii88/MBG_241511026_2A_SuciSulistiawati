<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<h2>Dashboard Dapur</h2>
<p>Selamat datang, <?= session()->get('name') ?>! Ajukan permintaan bahan.</p>
<?= $this->endSection() ?>