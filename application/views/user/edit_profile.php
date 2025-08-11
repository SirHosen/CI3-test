<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-user-edit"></i> Edit Profile</h4>
                </div>
                <div class="card-body">
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $this->session->flashdata('error'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php echo form_open('profile/update'); ?>
                        <div class="mb-3">
                            <label for="username" class="form-label">
                                <i class="fas fa-user"></i> Username
                            </label>
                            <input type="text" class="form-control" id="username" value="<?php echo $user->username; ?>" disabled>
                            <small class="text-muted">Username tidak dapat diubah</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="full_name" class="form-label">
                                <i class="fas fa-id-card"></i> Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="full_name" id="full_name" 
                                   value="<?php echo set_value('full_name', $user->full_name); ?>" required>
                            <?php echo form_error('full_name', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i> Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control" name="email" id="email" 
                                   value="<?php echo set_value('email', $user->email); ?>" required>
                            <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                            <div class="form-text">Pastikan email aktif untuk notifikasi</div>
                        </div>
                        
                        <!-- Additional fields (optional) -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">
                                <i class="fas fa-phone"></i> Nomor Telepon
                            </label>
                            <input type="tel" class="form-control" name="phone" id="phone" 
                                   value="<?php echo set_value('phone', isset($user->phone) ? $user->phone : ''); ?>" 
                                   placeholder="08xx-xxxx-xxxx">
                        </div>
                        
                        <div class="mb-3">
                            <label for="address" class="form-label">
                                <i class="fas fa-map-marker-alt"></i> Alamat
                            </label>
                            <textarea class="form-control" name="address" id="address" rows="3" 
                                      placeholder="Masukkan alamat lengkap"><?php echo set_value('address', isset($user->address) ? $user->address : ''); ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="bio" class="form-label">
                                <i class="fas fa-info-circle"></i> Bio / Tentang Saya
                            </label>
                            <textarea class="form-control" name="bio" id="bio" rows="3" 
                                      placeholder="Ceritakan tentang diri Anda"><?php echo set_value('bio', isset($user->bio) ? $user->bio : ''); ?></textarea>
                            <div class="form-text">Maksimal 500 karakter</div>
                        </div>
                        
                        <hr>
                        
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> 
                            <strong>Perhatian:</strong> Perubahan akan langsung tersimpan setelah Anda klik tombol Simpan.
                        </div>
                        
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
            
            <!-- Account Info -->
            <div class="card mt-3">
                <div class="card-body">
                    <h6><i class="fas fa-info-circle"></i> Informasi Akun</h6>
                    <hr>
                    <small class="text-muted">
                        <strong>Terdaftar sejak:</strong> <?php echo date('d F Y', strtotime($user->created_at)); ?><br>
                        <strong>Terakhir diupdate:</strong> 
                        <?php 
                        if($user->updated_at) {
                            echo date('d F Y H:i', strtotime($user->updated_at));
                        } else {
                            echo 'Belum pernah diupdate';
                        }
                        ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
// Character counter for bio
document.getElementById('bio').addEventListener('keyup', function() {
    var maxLength = 500;
    var currentLength = this.value.length;
    
    if(currentLength > maxLength) {
        this.value = this.value.substring(0, maxLength);
    }
});

// Email validation
document.getElementById('email').addEventListener('blur', function() {
    var email = this.value;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if(email.length > 0 && !emailRegex.test(email)) {
        this.classList.add('is-invalid');
    } else {
        this.classList.remove('is-invalid');
    }
});

// Phone number formatting
document.getElementById('phone').addEventListener('input', function() {
    var phone = this.value.replace(/\D/g, '');
    if(phone.length > 0) {
        if(phone.length <= 4) {
            phone = phone;
        } else if(phone.length <= 8) {
            phone = phone.slice(0, 4) + '-' + phone.slice(4);
        } else {
            phone = phone.slice(0, 4) + '-' + phone.slice(4, 8) + '-' + phone.slice(8, 12);
        }
    }
    this.value = phone;
});
</script>

<style>
.form-control:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}
.is-invalid {
    border-color: #dc3545;
}
</style>
