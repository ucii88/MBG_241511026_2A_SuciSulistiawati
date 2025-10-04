<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<script>
function openApproveModal(id) {
    const modal = new bootstrap.Modal(document.getElementById('approveModal' + id));
    modal.show();
}
</script>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Status Permintaan Bahan</h5>
        <?php if (session()->get('role') === 'dapur'): ?>
            <a href="<?= base_url('permintaan/create') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Buat Permintaan
            </a>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Pemohon</th>
                        <th>Tanggal Masak</th>
                        <th>Menu</th>
                        <th>Jumlah Porsi</th>
                        <th>Status</th>
                        <?php if (session()->get('role') === 'gudang'): ?>
                            <th>Bahan Diminta</th>
                        <?php endif; ?>
                        <th>Alasan Penolakan</th>
                        <?php if (session()->get('role') === 'gudang'): ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
    <tbody>
        <?php
        $groupedPermintaan = [];
        foreach ($permintaan as $item) {
            $id = $item['id'];
            if (!isset($groupedPermintaan[$id])) {
                $groupedPermintaan[$id] = [
                    'id' => $item['id'],
                    'pemohon_name' => $item['pemohon_name'],
                    'tgl_masak' => $item['tgl_masak'],
                    'menu_makan' => $item['menu_makan'],
                    'jumlah_porsi' => $item['jumlah_porsi'],
                    'status' => $item['status'],
                    'alasan_ditolak' => $item['alasan_ditolak'] ?? null,
                    'bahan' => []
                ];
            }
            if (session()->get('role') === 'gudang' && isset($item['bahan_nama'])) {
                $groupedPermintaan[$id]['bahan'][] = $item['bahan_nama'] . ' (' . ($item['jumlah_diminta'] ?? 0) . ')';
            }
        }
        foreach ($groupedPermintaan as $item): ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['pemohon_name'] ?></td>
                <td><?= date('d/m/Y', strtotime($item['tgl_masak'])) ?></td>
                <td><?= $item['menu_makan'] ?></td>
                <td class="text-center"><?= $item['jumlah_porsi'] ?></td>
                <td>
                    <span class="badge bg-<?php 
                        echo match($item['status']) {
                            'menunggu' => 'warning',
                            'disetujui' => 'success',
                            'ditolak' => 'danger',
                            default => 'secondary'
                        };
                    ?>">
                        <?= ucfirst($item['status']) ?>
                    </span>
                </td>
                <?php if (session()->get('role') === 'gudang'): ?>
                    <td><?= implode(', ', $item['bahan']) ?: '<span class="text-muted">Tidak ada detail</span>' ?></td>
                <?php endif; ?>
                <td>
                    <?php if ($item['status'] === 'ditolak' && !empty($item['alasan_ditolak'])): ?>
                        <span class="text-danger"><?= $item['alasan_ditolak'] ?></span>
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </td>
                <?php if (session()->get('role') === 'gudang'): ?>
                    <td class="text-center">
                        <?php if ($item['status'] === 'menunggu'): ?>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-success" onclick="openApproveModal(<?= $item['id'] ?>)" title="Setujui Permintaan">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal<?= $item['id'] ?>" title="Tolak Permintaan">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                           <!--<?= $item['id'] ?> -->
                            <div class="modal fade" id="approveModal<?= $item['id'] ?>" tabindex="-1" aria-labelledby="approveModalLabel<?= $item['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="approveModalLabel<?= $item['id'] ?>">
                                                <i class="fas fa-check-circle text-success me-2"></i>
                                                Konfirmasi Persetujuan
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menyetujui permintaan ini?</p>
                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle me-2"></i>
                                                Menyetujui permintaan akan mengurangi stok bahan baku sesuai dengan jumlah yang diminta.
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                <i class="fas fa-times me-1"></i>
                                                Batal
                                            </button>
                                            <a href="<?= base_url('permintaan/approve/' . $item['id']) ?>" class="btn btn-success">
                                                <i class="fas fa-check me-1"></i>
                                                Setujui Permintaan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--  <?= $item['id'] ?> -->
                            <div class="modal fade" id="rejectModal<?= $item['id'] ?>" tabindex="-1" aria-labelledby="rejectModalLabel<?= $item['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="rejectModalLabel<?= $item['id'] ?>">
                                                <i class="fas fa-times-circle text-danger me-2"></i>
                                                Alasan Penolakan
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('permintaan/reject/' . $item['id']) ?>" method="POST">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="alasan_ditolak<?= $item['id'] ?>" class="form-label">Alasan Penolakan:</label>
                                                    <textarea class="form-control" id="alasan_ditolak<?= $item['id'] ?>" name="alasan_ditolak" rows="3" required placeholder="Masukkan alasan penolakan..."></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-1"></i>
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-check me-1"></i>
                                                    Tolak Permintaan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>