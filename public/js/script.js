function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    if (sidebar && overlay) {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    }
}

function addBahanField(bahanOptions) {
    const container = document.getElementById('bahan-fields');
    if (!container) return;
    
    const index = container.getElementsByClassName('row').length;
    const row = document.createElement('div');
    row.className = 'row mb-3';
    row.innerHTML = `
        <div class="col-5">
            <label for="bahan_id[${index}]" class="form-label required">Bahan</label>
            <select class="form-select" id="bahan_id[${index}]" name="bahan_id[${index}]" required>
                ${bahanOptions}
            </select>
            <div class="invalid-feedback">
                <i class="fas fa-exclamation-circle"></i>
                Bahan wajib dipilih
            </div>
        </div>
        <div class="col-5">
            <label for="jumlah_diminta[${index}]" class="form-label required">Jumlah Diminta</label>
            <input type="number" class="form-control" id="jumlah_diminta[${index}]" name="jumlah_diminta[${index}]" min="1" required placeholder="Masukkan jumlah yang diminta">
            <div class="invalid-feedback">
                <i class="fas fa-exclamation-circle"></i>
                Jumlah diminta wajib diisi
            </div>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-danger mt-4" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-trash-alt"></i> Hapus
            </button>
        </div>
    `;
    container.appendChild(row);
}

function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return true;

    let valid = true;
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    const errorMessages = {
        text: 'Mohon isi field ini',
        email: 'Mohon masukkan email yang valid',
        number: 'Mohon masukkan angka yang valid',
        date: 'Mohon pilih tanggal',
        password: 'Mohon isi password',
        select: 'Mohon pilih salah satu opsi'
    };

    inputs.forEach(input => {
        input.classList.remove('is-invalid');
        let isValid = true;
        let errorMessage = errorMessages.text;

       
        input.setCustomValidity('');

        if (!input.value.trim()) {
            isValid = false;
            if (input.tagName.toLowerCase() === 'select') {
                errorMessage = errorMessages.select;
            } else {
                switch (input.type) {
                    case 'email':
                        errorMessage = errorMessages.email;
                        break;
                    case 'number':
                        errorMessage = errorMessages.number;
                        break;
                    case 'date':
                        errorMessage = errorMessages.date;
                        break;
                    case 'password':
                        errorMessage = errorMessages.password;
                        break;
                }
            }
        } else if (input.type === 'email' && !input.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
            isValid = false;
            errorMessage = 'Format email tidak valid';
        } else if (input.type === 'number' && input.hasAttribute('min')) {
            const min = parseInt(input.getAttribute('min'));
            if (parseInt(input.value) < min) {
                isValid = false;
                errorMessage = `Nilai minimal adalah ${min}`;
            }
        }

        if (!isValid) {
            input.classList.add('is-invalid');
            const feedback = input.nextElementSibling;
            if (feedback && feedback.classList.contains('invalid-feedback')) {
                feedback.textContent = errorMessage;
            }
            valid = false;
        }
    });

    return valid;
}

function openConfirmationModal(id, action, url) {
    const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
    let message = '';
    let buttonText = 'Ya';
    let buttonClass = 'btn-primary';
    let icon = 'fa-question-circle';
    let iconClass = 'text-primary';
    let title = 'Konfirmasi';
    
    if (action === 'reject') {
        message = `Yakin ingin menolak permintaan dengan ID ${id}?`;
        buttonText = 'Tolak';
        buttonClass = 'btn-danger';
        icon = 'fa-times-circle';
        iconClass = 'text-danger';
        title = 'Konfirmasi Penolakan';
    } else if (action === 'approve') {
        message = `Yakin ingin menyetujui permintaan dengan ID ${id}?`;
        buttonText = 'Setuju';
        buttonClass = 'btn-success';
        icon = 'fa-check-circle';
        iconClass = 'text-success';
        title = 'Konfirmasi Persetujuan';
    } else if (action === 'logout') {
        message = 'Yakin ingin keluar dari aplikasi?';
        buttonText = 'Logout';
        buttonClass = 'btn-danger';
        icon = 'fa-sign-out-alt';
        iconClass = 'text-danger';
        title = 'Konfirmasi Logout';
    } else if (action === 'edit') {
        message = `Yakin ingin mengedit data bahan dengan ID ${id}?`;
        buttonText = 'Edit';
        buttonClass = 'btn-warning';
        icon = 'fa-edit';
        iconClass = 'text-warning';
        title = 'Konfirmasi Edit';
    } else if (action === 'hapus') {
        message = `Yakin ingin menghapus bahan dengan ID ${id}?`;
        buttonText = 'Hapus';
        buttonClass = 'btn-danger';
        icon = 'fa-trash-alt';
        iconClass = 'text-danger';
        title = 'Konfirmasi Hapus';
    }
    
    document.getElementById('confirmationModalLabel').textContent = title;
    
    const iconElement = document.getElementById('modalIcon');
    if (iconElement) {
        iconElement.className = `fas ${icon} ${iconClass} fa-3x`;
    }
    
    const confirmBtn = document.getElementById('confirmActionBtn');
    document.getElementById('confirmationMessage').textContent = message;
    
    const newConfirmBtn = confirmBtn.cloneNode(true);
    confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);
    
    newConfirmBtn.textContent = buttonText;
    newConfirmBtn.className = `btn ${buttonClass} px-4`;
    newConfirmBtn.onclick = function() {
        newConfirmBtn.disabled = true;
        newConfirmBtn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`;
        window.location.href = url;
    };
    
    modal.show();
}

function validateAndConfirm(event, formId, action) {
    event.preventDefault();
    const form = document.getElementById(formId);
    if (!validateForm(formId)) {
        return false;
    }

    const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
    modal.show();
    return false;
}

function submitForm(formId) {
    const form = document.getElementById(formId);
    const submitButton = form.querySelector('button[type="submit"]');
    const originalText = submitButton.innerHTML;
    
    submitButton.disabled = true;
    submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
    
    form.submit();
}

function showUpdateConfirmation(form) {
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const nama = form.querySelector('#nama').value;
    const jumlah = form.querySelector('#jumlah').value;
    const satuan = form.querySelector('#satuan').value;
    const kategori = form.querySelector('#kategori').value;

    document.getElementById('confirmNama').textContent = nama;
    document.getElementById('confirmJumlah').textContent = jumlah;
    document.getElementById('confirmSatuan').textContent = satuan;
    document.getElementById('confirmKategori').textContent = kategori;

    const modal = new bootstrap.Modal(document.getElementById('updateConfirmationModal'));
    
    const confirmBtn = document.getElementById('confirmUpdateBtn');
    confirmBtn.onclick = function() {
        this.disabled = true;
        this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...';
        form.submit();
    };
    
    modal.show();
}

function getBahanOptions() {
    const firstSelect = document.querySelector('select[name="bahan_id[0]"]');
    return firstSelect ? firstSelect.innerHTML : '';
}

function addBahanField() {
    const container = document.getElementById('bahan-fields');
    if (!container) return;
    
    const index = container.getElementsByClassName('row').length;
    const bahanOptions = getBahanOptions();
    
    const row = document.createElement('div');
    row.className = 'row mb-3';
    row.innerHTML = `
        <div class="col-5">
            <label for="bahan_id[${index}]" class="form-label required">Bahan</label>
            <select class="form-select" id="bahan_id[${index}]" name="bahan_id[${index}]" required>
                ${bahanOptions}
            </select>
            <div class="invalid-feedback">
                <i class="fas fa-exclamation-circle"></i>
                Bahan wajib dipilih
            </div>
        </div>
        <div class="col-5">
            <label for="jumlah_diminta[${index}]" class="form-label required">Jumlah Diminta</label>
            <input type="number" class="form-control" id="jumlah_diminta[${index}]" name="jumlah_diminta[${index}]" min="1" required placeholder="Masukkan jumlah yang diminta">
            <div class="invalid-feedback">
                <i class="fas fa-exclamation-circle"></i>
                Jumlah diminta wajib diisi
            </div>
        </div>
        <div class="col-2 d-flex align-items-end mb-2">
            <button type="button" class="btn btn-danger" onclick="this.closest('.row').remove()">
                <i class="fas fa-trash-alt"></i> Hapus
            </button>
        </div>
    `;
    container.appendChild(row);
}