<div class="container-fluid mt-4">
    <h2>Manage Users</h2>
    
    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <div class="card mt-4">
        <div class="card-body">
            <table class="table table-striped" id="usersTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user): ?>
                    <tr>
                        <td><?php echo $user->id; ?></td>
                        <td><?php echo $user->username; ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo $user->full_name; ?></td>
                        <td>
                            <?php if($user->role == 'admin'): ?>
                                <span class="badge bg-danger">Admin</span>
                            <?php else: ?>
                                <span class="badge bg-primary">User</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($user->is_active): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo date('d/m/Y', strtotime($user->created_at)); ?></td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="<?php echo base_url('admin/view/'.$user->id); ?>" 
                                   class="btn btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo base_url('admin/edit/'.$user->id); ?>" 
                                   class="btn btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <?php if($user->id != $this->session->userdata('user_id')): ?>
                                    <?php if($user->is_active): ?>
                                        <a href="<?php echo base_url('admin/toggle_status/'.$user->id); ?>" 
                                           class="btn btn-secondary" title="Deactivate"
                                           onclick="return confirm('Nonaktifkan user ini?')">
                                            <i class="fas fa-user-slash"></i>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo base_url('admin/toggle_status/'.$user->id); ?>" 
                                           class="btn btn-success" title="Activate"
                                           onclick="return confirm('Aktifkan user ini?')">
                                            <i class="fas fa-user-check"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <a href="<?php echo base_url('admin/delete/'.$user->id); ?>" 
                                       class="btn btn-danger" title="Delete"
                                       onclick="return confirm('Hapus user ini? Aksi ini tidak dapat dibatalkan!')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                <?php else: ?>
                                    <span class="btn btn-sm btn-light disabled">Current User</span>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tambahkan DataTables jika perlu
    if (typeof $ !== 'undefined' && $.fn.DataTable) {
        $('#usersTable').DataTable();
    }
});
</script>
