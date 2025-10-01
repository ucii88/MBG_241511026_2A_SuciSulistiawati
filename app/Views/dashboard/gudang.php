<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<h2>Dashboard Gudang</h2>
<p>Selamat datang, <?= session()->get('name') ?>!</p>


<h3>Ringkasan Stok Bahan Baku</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Status</th>
            <th>Tgl Kadaluarsa</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bahan as $item): ?>
            <tr>
                <td><?= $item['nama'] ?></td>
                <td><?= $item['jumlah'] ?></td>
                <td><?= $item['satuan'] ?></td>
                <td><?= $item['status'] ?></td>
                <td><?= $item['tanggal_kadaluarsa'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<h3>Permintaan Menunggu</h3>
<p>Jumlah permintaan yang menunggu: <?= $permintaan_menunggu ?></p>
<a href="<?= base_url('permintaan') ?>" class="btn btn-primary">Lihat Semua Permintaan</a>

<a href="<?= base_url('bahan/create') ?>" class="btn btn-success mt-3">Tambah Bahan Baru</a>
<?= $this->endSection() ?>