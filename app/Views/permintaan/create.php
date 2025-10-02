<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<h2>Buat Permintaan Bahan</h2>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<form action="<?= base_url('permintaan/store') ?>" method="post">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="tgl_masak" class="form-label">Tanggal Masak</label>
        <input type="date" class="form-control" id="tgl_masak" name="tgl_masak" value="<?= old('tgl_masak') ?>" required>
    </div>
    <div class="mb-3">
        <label for="menu_makan" class="form-label">Menu Makanan</label>
        <input type="text" class="form-control" id="menu_makan" name="menu_makan" value="<?= old('menu_makan') ?>" required>
    </div>
    <div class="mb-3">
        <label for="jumlah_porsi" class="form-label">Jumlah Porsi</label>
        <input type="number" class="form-control" id="jumlah_porsi" name="jumlah_porsi" value="<?= old('jumlah_porsi') ?>" min="1" required>
    </div>
    <div id="bahan-fields">
        <div class="row mb-3">
            <div class="col-5">
                <label for="bahan_id[0]" class="form-label">Bahan</label>
                <select class="form-select" id="bahan_id[0]" name="bahan_id[0]" required>
                    <option value="">Pilih Bahan</option>
                    <?php foreach ($bahan as $item): ?>
                        <option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-5">
                <label for="jumlah_diminta[0]" class="form-label">Jumlah Diminta</label>
                <input type="number" class="form-control" id="jumlah_diminta[0]" name="jumlah_diminta[0]" min="1" required>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-secondary mt-4" onclick="addBahanField()">Tambah Bahan</button>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
    <a href="<?= base_url('permintaan') ?>" class="btn btn-secondary ms-2">Batal</a>
</form>

<script>
function addBahanField() {
    const container = document.getElementById('bahan-fields');
    const index = container.getElementsByClassName('row').length;
    const row = document.createElement('div');
    row.className = 'row mb-3';
    row.innerHTML = `
        <div class="col-5">
            <label for="bahan_id[${index}]" class="form-label">Bahan</label>
            <select class="form-select" id="bahan_id[${index}]" name="bahan_id[${index}]" required>
                <option value="">Pilih Bahan</option>
                <?php foreach ($bahan as $item): ?>
                    <option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-5">
            <label for="jumlah_diminta[${index}]" class="form-label">Jumlah Diminta</label>
            <input type="number" class="form-control" id="jumlah_diminta[${index}]" name="jumlah_diminta[${index}]" min="1" required>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-danger mt-4" onclick="this.parentElement.parentElement.remove()">Hapus</button>
        </div>
    `;
    container.appendChild(row);
}
</script>
<?= $this->endSection() ?>