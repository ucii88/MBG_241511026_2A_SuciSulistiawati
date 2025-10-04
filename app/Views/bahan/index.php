<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="row mb-3">
    <div class="col-md-8">
        <a href="<?= base_url('bahan/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Bahan
        </a>
    </div>
    <div class="col-md-4">
        <div class="input-group">
            <input type="text" class="form-control" id="searchInput" placeholder="Cari bahan...">
            <select class="form-select" id="statusFilter" style="max-width: 150px;">
                <option value="">Semua Status</option>
                <option value="tersedia">Tersedia</option>
                <option value="segera_kadaluarsa">Segera Kadaluarsa</option>
                <option value="kadaluarsa">Kadaluarsa</option>
                <option value="habis">Habis</option>
            </select>
        </div>
    </div>
</div>


<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Tersedia</h5>
                <h3 class="card-text" id="countTersedia">0</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title">Segera Kadaluarsa</h5>
                <h3 class="card-text" id="countSegera">0</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <h5 class="card-title">Kadaluarsa</h5>
                <h3 class="card-text" id="countKadaluarsa">0</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5 class="card-title">Habis</h5>
                <h3 class="card-text" id="countHabis">0</h3>
            </div>
        </div>
    </div>
</div>
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
            <th>Aksi</th>
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
                <td>
                    <span class="badge bg-<?php 
                        echo match($item['status']) {
                            'tersedia' => 'success',
                            'habis' => 'danger',
                            'kadaluarsa' => 'dark',
                            'segera_kadaluarsa' => 'warning',
                            'tidak_aktif' => 'secondary',
                            'dihapus' => 'secondary',
                            default => 'info'
                        };
                    ?>">
                        <?= str_replace('_', ' ', ucfirst($item['status'])) ?>
                    </span>
                </td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="openConfirmationModal('<?= $item['id'] ?>', 'edit', '<?= base_url('bahan/edit/' . $item['id']) ?>')">Edit</button>
                    <?php if ($item['status'] === 'kadaluarsa'): ?>
                        <button class="btn btn-danger btn-sm" onclick="openConfirmationModal('<?= $item['id'] ?>', 'hapus', '<?= base_url('bahan/delete/' . $item['id']) ?>')">Hapus</button>
                    <?php endif; ?>
                </td>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const tableRows = document.querySelectorAll('tbody tr');
    
    function updateStatusCounts() {
        const counts = {
            tersedia: 0,
            segera_kadaluarsa: 0,
            kadaluarsa: 0,
            habis: 0
        };
        
        tableRows.forEach(row => {
            if (row.style.display !== 'none') {
                const statusBadge = row.querySelector('td:nth-child(8) .badge');
                if (statusBadge) {
                    const status = statusBadge.textContent.trim().toLowerCase().replace(' ', '_');
                    if (counts.hasOwnProperty(status)) {
                        counts[status]++;
                    }
                }
            }
        });
        
        document.getElementById('countTersedia').textContent = counts.tersedia;
        document.getElementById('countSegera').textContent = counts.segera_kadaluarsa;
        document.getElementById('countKadaluarsa').textContent = counts.kadaluarsa;
        document.getElementById('countHabis').textContent = counts.habis;
    }
    
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedStatus = statusFilter.value.toLowerCase();
        
        tableRows.forEach(row => {
            const nama = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const statusBadge = row.querySelector('td:nth-child(8) .badge');
            const status = statusBadge ? statusBadge.textContent.trim().toLowerCase().replace(' ', '_') : '';
            
            const matchesSearch = nama.includes(searchTerm);
            const matchesStatus = selectedStatus === '' || status === selectedStatus;
            
            row.style.display = matchesSearch && matchesStatus ? '' : 'none';
        });
        
        updateStatusCounts();
    }
    
    searchInput.addEventListener('input', filterTable);
    statusFilter.addEventListener('change', filterTable);
    
    
    updateStatusCounts();
});
</script>
<?= $this->endSection() ?>