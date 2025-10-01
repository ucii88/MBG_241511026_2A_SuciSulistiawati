<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<h2>Data Bahan Baku</h2>
<a href="<?= base_url('bahan/create') ?>" class="btn btn-primary mb-3">Tambah Bahan</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Tgl Masuk</th>
            <th>Tgl Kadaluarsa</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bahan as $item): ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['nama'] ?></td>
                <td><?= $item['kategori'] ?></td>
                <td><?= $item['jumlah'] ?></td>
                <td><?= $item['satuan'] ?></td>
                <td><?= $item['tanggal_masuk'] ?></td>
                <td><?= $item['tanggal_kadaluarsa'] ?></td>
                <td><?= $item['status'] ?></td>
                <td>
                    <a href="<?= base_url('bahan/edit/' . $item['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <form action="<?= base_url('bahan/delete/' . $item['id']) ?>" method="post" style="display:inline;">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus? Hanya kadaluarsa yang boleh.')">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>