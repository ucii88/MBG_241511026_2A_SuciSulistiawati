<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistem Akademik' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: #f5f5f5;
            color: #333;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            height: 100vh;
            background: #fff;
            border-right: 1px solid #e0e0e0;
            overflow-y: auto;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .sidebar-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }
        
        .sidebar-menu {
            padding: 1rem 0;
        }
        
        .menu-item {
            display: block;
            padding: 0.75rem 1.25rem;
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover {
            background: #f9fafb;
            color: #333;
        }
        
        .menu-item.active {
            background: #f9fafb;
            color: #333;
            border-left-color: #333;
            font-weight: 500;
        }
        
        .menu-item i {
            width: 20px;
            margin-right: 0.75rem;
            font-size: 0.95rem;
        }
        
        .menu-divider {
            height: 1px;
            background: #e0e0e0;
            margin: 0.5rem 0;
        }
        
        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid #e0e0e0;
            margin-top: auto;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #333;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .user-details {
            flex: 1;
        }
        
        .user-name {
            font-size: 0.875rem;
            font-weight: 500;
            color: #333;
            display: block;
        }
        
        .user-role {
            font-size: 0.75rem;
            color: #999;
        }
        
        /* Main Content */
        .main-wrapper {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Top Bar */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e0e0e0;
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .topbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }
        
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .topbar-right span {
            font-size: 0.875rem;
            color: #666;
        }
        
        /* Content Area */
        .content {
            flex: 1;
            padding: 2rem;
        }
        
        .content-container {
            max-width: 1200px;
        }
        
        /* Card */
        .card {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            box-shadow: none;
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background: #fff;
            border-bottom: 1px solid #e0e0e0;
            padding: 1.25rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            color: #333;
        }
        
        .card-body {
            padding: 2rem 2rem;
        }
        
        /* Forms */
        .form-group {
            margin-bottom: 1.25rem;
        }
        
        .form-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #333;
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .form-control, .form-select {
            border: 1px solid #d1d5db;
            border-radius: 4px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: border-color 0.2s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #333;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
            outline: none;
        }
        
        /* Buttons */
        .btn {
            padding: 0.75rem 1.5rem;
            font-size: 0.95rem;
            font-weight: 500;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .btn-primary {
            background: #333;
            color: #fff;
        }
        
        .btn-primary:hover {
            background: #000;
        }
        
        .btn-secondary {
            background: #6c757d;
            color: #fff;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
        }
        
        /* Alerts */
        .alert {
            border-radius: 4px;
            border: 1px solid;
            padding: 0.875rem 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }
        
        .alert-success {
            background: #f0fdf4;
            border-color: #bbf7d0;
            color: #166534;
        }
        
        .alert-danger {
            background: #fef2f2;
            border-color: #fecaca;
            color: #991b1b;
        }
        
        .alert-info {
            background: #eff6ff;
            border-color: #bfdbfe;
            color: #1e40af;
        }
        
        /* Mobile Toggle */
        .mobile-toggle {
            display: none;
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #333;
            color: #fff;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1001;
        }
        
        /* Login Page */
        .login-page .sidebar,
        .login-page .topbar,
        .login-page .mobile-toggle {
            display: none !important;
        }
        
        
        .login-page .main-wrapper {
            margin-left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #fafafa;
        }
        
        .login-page .content {
            padding: rem 4rem;
            width: 100%;
            max-width: 560px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .login-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }
        
        .login-header p {
            font-size: 0.875rem;
            color: #666;
        }
        
        .login-page .card {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            width: 100%;
        }
        
        /* Table */
        .table {
            font-size: 0.9rem;
        }
        
        .table thead th {
            background: #fafafa;
            border-bottom: 2px solid #e0e0e0;
            font-weight: 600;
            color: #333;
            padding: 0.875rem;
        }
        
        .table tbody td {
            padding: 0.875rem;
            border-bottom: 1px solid #e0e0e0;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                left: -260px;
                transition: left 0.3s;
            }
            
            .sidebar.active {
                left: 0;
            }
            
            .main-wrapper {
                margin-left: 0;
            }
            
            .topbar {
                padding: 1rem;
            }
            
            .page-title {
                font-size: 1.1rem;
            }
            
            .content {
                padding: 1.5rem 1rem;
            }
            
            .mobile-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }
            
            .sidebar-overlay.active {
                display: block;
            }
        }
    </style>
</head>
<body class="<?= $title === 'Login' ? 'login-page' : '' ?>">
    
   
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3>SISTEM PEMANTAUAN BAHAN BAKU MBG</h3>
        </div>
        
        <nav class="sidebar-menu">
            <?php if (session()->get('logged_in')): ?>
                <a href="<?= base_url('dashboard') ?>" class="menu-item active">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <?php if (session()->get('role') === 'admin'): ?>
                    <div class="menu-divider"></div>
                    
                    <a href="<?= base_url('users') ?>" class="menu-item">
                        <i class="fas fa-users"></i> Kelola Pengguna
                    </a>
                <?php endif; ?>
                
                <div class="menu-divider"></div>
                
                <a href="<?= base_url('auth/logout') ?>" class="menu-item">
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
    
    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
    
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Top Bar -->
        <div class="topbar">
            <div class="topbar-content">
                <h1 class="page-title"><?= $title ?? 'Dashboard' ?></h1>
                <div class="topbar-right">
                    <span><?= date('d F Y') ?></span>
                </div>
            </div>
        </div>
        
        <!-- Content -->
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
    
    <!-- Mobile Toggle Button -->
    <button class="mobile-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
    </script>
</body>
</html>