<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistem Pemantauan Bahan Baku MBG' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3>Sistem MBG</h3>
        </div>
        <nav class="sidebar-menu">
            <?php if (session()->get('logged_in')): ?>
                <a href="<?= base_url('dashboard') ?>" class="menu-item <?= ($title === 'Dashboard' || $title === 'Dashboard Gudang' || $title === 'Dashboard Dapur') ? 'active' : '' ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <?php if (session()->get('role') === 'gudang'): ?>
                    <a href="<?= base_url('bahan') ?>" class="menu-item <?= ($title === 'Data Bahan Baku') ? 'active' : '' ?>">
                        <i class="fas fa-boxes"></i> Data Bahan Baku
                    </a>
                <?php endif; ?>
                <?php if (session()->get('role') === 'dapur'): ?>
                    <a href="<?= base_url('permintaan') ?>" class="menu-item <?= ($title === 'Lihat Status Permintaan') ? 'active' : '' ?>">
                        <i class="fas fa-clipboard-list"></i> Permintaan
                    </a>
                    <a href="<?= base_url('permintaan/create') ?>" class="menu-item <?= ($title === 'Buat Permintaan Bahan') ? 'active' : '' ?>">
                        <i class="fas fa-plus"></i> Tambah Permintaan
                    </a>
                <?php endif; ?>
                <?php if (session()->get('role') === 'admin'): ?>
                    <div class="menu-divider"></div>
                    <a href="<?= base_url('users') ?>" class="menu-item">
                        <i class="fas fa-users"></i> Kelola Pengguna
                    </a>
                <?php endif; ?>
                <div class="menu-divider"></div>
                <a href="#" class="menu-item" onclick="openConfirmationModal('', 'logout', '<?= base_url('auth/logout') ?>')">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            <?php endif; ?>
        </nav>
        <?php if (session()->get('logged_in')): ?>
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <?= strtoupper(substr(session()->get('username') ?? 'U', 0, 1)) ?>
                    </div>
                    <div class="user-details">
                        <span class="user-name"><?= session()->get('username') ?? 'User' ?></span>
                        <span class="user-role"><?= ucfirst(session()->get('role') ?? 'User') ?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <div class="main-wrapper">
        <div class="topbar">
            <div class="topbar-content">
                <h1 class="page-title"><?= $title ?? 'Dashboard' ?></h1>
                <div class="topbar-right">
                    <span><?= date('d F Y') ?></span>
                </div>
            </div>
        </div>

        <main class="content">
            <?php if ($title === 'Login'): ?>
                <div class="login-header">
                    <h1>SISTEM PEMANTAUAN BAHAN BAKU MBG</h1>
                    <p>Silakan login untuk melanjutkan</p>
                </div>
            <?php endif; ?>
            
            <div class="content-container">
                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>

    <button class="mobile-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Aksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <div class="text-center mb-4">
                        <i id="modalIcon" class="fas fa-question-circle text-primary fa-3x"></i>
                    </div>
                    <p id="confirmationMessage" class="text-center fs-5 mb-0">Apakah Anda yakin ingin melanjutkan aksi ini?</p>
                </div>
                <div class="modal-footer border-0 justify-content-center gap-2">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="button" class="btn btn-primary px-4" id="confirmActionBtn">
                        <i class="fas fa-check me-2"></i>Ya
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('js/script.js') ?>"></script>
</body>
</html>