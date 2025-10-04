<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">Login</div>
    <div class="card-body">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <form action="<?= base_url('auth/attemptLogin') ?>" method="post" id="form-login" onsubmit="return validateForm('form-login');">
            <div class="form-group mb-3">
                <label for="email" class="form-label required">Email</label>
                <input type="email" class="form-control" id="email" name="email" required placeholder="Masukkan email Anda">
                <div class="invalid-feedback">
                    <i class="fas fa-exclamation-circle"></i>
                    Email wajib diisi
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label required">Password</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password Anda">
                <div class="invalid-feedback">
                    <i class="fas fa-exclamation-circle"></i>
                    Password wajib diisi
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>