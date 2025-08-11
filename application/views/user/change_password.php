<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-key"></i> Ubah Password</h4>
                </div>
                <div class="card-body">
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $this->session->flashdata('error'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Password harus minimal 6 karakter dan disarankan menggunakan kombinasi huruf, angka, dan simbol.
                    </div>
                    
                    <?php echo form_open('user/change_password'); ?>
                        <div class="mb-3">
                            <label for="current_password" class="form-label">
                                <i class="fas fa-lock"></i> Password Lama <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="current_password" id="current_password" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('current_password')">
                                    <i class="fas fa-eye" id="eye-current_password"></i>
                                </button>
                            </div>
                            <?php echo form_error('current_password', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="new_password" class="form-label">
                                <i class="fas fa-lock"></i> Password Baru <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="new_password" id="new_password" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('new_password')">
                                    <i class="fas fa-eye" id="eye-new_password"></i>
                                </button>
                            </div>
                            <?php echo form_error('new_password', '<small class="text-danger">', '</small>'); ?>
                            <div class="form-text">Minimal 6 karakter</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">
                                <i class="fas fa-lock"></i> Konfirmasi Password Baru <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirm_password')">
                                    <i class="fas fa-eye" id="eye-confirm_password"></i>
                                </button>
                            </div>
                            <?php echo form_error('confirm_password', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        
                        <div class="mb-3">
                            <div id="password-strength" class="mt-2"></div>
                        </div>
                        
                        <hr>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="<?php echo base_url('profile'); ?>" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
// Toggle password visibility
function togglePassword(fieldId) {
    var field = document.getElementById(fieldId);
    var eye = document.getElementById('eye-' + fieldId);
    
    if (field.type === "password") {
        field.type = "text";
        eye.classList.remove('fa-eye');
        eye.classList.add('fa-eye-slash');
    } else {
        field.type = "password";
        eye.classList.remove('fa-eye-slash');
        eye.classList.add('fa-eye');
    }
}

// Check password strength
document.getElementById('new_password').addEventListener('keyup', function() {
    var password = this.value;
    var strength = document.getElementById('password-strength');
    var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");
    
    if(password.length == 0) {
        strength.innerHTML = '';
    } else if(strongRegex.test(password)) {
        strength.innerHTML = '<div class="alert alert-success"><i class="fas fa-check-circle"></i> Password Kuat</div>';
    } else if(mediumRegex.test(password)) {
        strength.innerHTML = '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Password Sedang</div>';
    } else {
        strength.innerHTML = '<div class="alert alert-danger"><i class="fas fa-times-circle"></i> Password Lemah</div>';
    }
});

// Check if passwords match
document.getElementById('confirm_password').addEventListener('keyup', function() {
    var newPassword = document.getElementById('new_password').value;
    var confirmPassword = this.value;
    
    if(confirmPassword.length > 0) {
        if(newPassword !== confirmPassword) {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        } else {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        }
    } else {
        this.classList.remove('is-invalid');
        this.classList.remove('is-valid');
    }
});
</script>

<style>
.input-group button {
    border: 1px solid #ced4da;
}
.input-group button:hover {
    background-color: #f8f9fa;
}
</style>
