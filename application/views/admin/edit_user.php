<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Edit User: <?php echo $user->username; ?></h4>
                </div>
                <div class="card-body">
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>
                    
                    <?php echo form_open('admin/edit/'.$user->id); ?>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" value="<?php echo $user->username; ?>" disabled>
                            <small class="text-muted">Username cannot be changed</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="full_name" id="full_name" 
                                   value="<?php echo set_value('full_name', $user->full_name); ?>" required>
                            <?php echo form_error('full_name', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" id="email" 
                                   value="<?php echo set_value('email', $user->email); ?>" required>
                            <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                            <select class="form-control" name="role" id="role" required>
                                <option value="user" <?php echo ($user->role == 'user') ? 'selected' : ''; ?>>User</option>
                                <option value="admin" <?php echo ($user->role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                            </select>
                            <?php echo form_error('role', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" 
                                       value="1" <?php echo ($user->is_active == 1) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="is_active">
                                    Active Account
                                </label>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                        <a href="<?php echo base_url('admin/users'); ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
