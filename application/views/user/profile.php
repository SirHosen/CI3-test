<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Profile User</h4>
                </div>
                <div class="card-body">
                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $this->session->flashdata('error'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Username</th>
                            <td><?php echo $user->username; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $user->email; ?></td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td><?php echo $user->full_name; ?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>
                                <?php if(isset($user->role) && $user->role == 'admin'): ?>
                                    <span class="badge bg-danger">Admin</span>
                                <?php else: ?>
                                    <span class="badge bg-primary">User</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Bergabung</th>
                            <td><?php echo date('d F Y', strtotime($user->created_at)); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <?php if($user->is_active == 1): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    
                    <!-- TOMBOL-TOMBOL ACTION -->
                    <div class="mt-3 d-flex gap-2">
                        <a href="<?php echo base_url('user/edit_profile'); ?>" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Profile
                        </a>
                        <a href="<?php echo base_url('user/change_password'); ?>" class="btn btn-warning">
                            <i class="fas fa-key"></i> Ubah Password
                        </a>
                        <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Activity Logs -->
            <div class="card mt-3">
                <div class="card-header">
                    <h5>Aktivitas Terakhir</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Deskripsi</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($logs)): ?>
                                    <?php foreach($logs as $log): ?>
                                    <tr>
                                        <td>
                                            <span class="badge bg-info"><?php echo $log->action; ?></span>
                                        </td>
                                        <td><?php echo $log->description; ?></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($log->created_at)); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada aktivitas</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
