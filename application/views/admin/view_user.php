<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4>User Details: <?php echo $user->username; ?></h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">ID</th>
                            <td><?php echo $user->id; ?></td>
                        </tr>
                        <tr>
                            <th>Username</th>
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
                                <?php if($user->role == 'admin'): ?>
                                    <span class="badge bg-danger">Admin</span>
                                <?php else: ?>
                                    <span class="badge bg-primary">User</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <?php if($user->is_active): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Inactive</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Registered</th>
                            <td><?php echo date('d F Y H:i', strtotime($user->created_at)); ?></td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>
                                <?php 
                                if($user->updated_at) {
                                    echo date('d F Y H:i', strtotime($user->updated_at));
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                    
                    <div class="mt-3">
                        <a href="<?php echo base_url('admin/edit/'.$user->id); ?>" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit User
                        </a>
                        <a href="<?php echo base_url('admin/users'); ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Users
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- User Activity Logs -->
            <div class="card mt-3">
                <div class="card-header">
                    <h5>User Activity Logs</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Description</th>
                                    <th>IP</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($logs)): ?>
                                    <?php foreach($logs as $log): ?>
                                    <tr>
                                        <td><span class="badge bg-info"><?php echo $log->action; ?></span></td>
                                        <td><?php echo $log->description; ?></td>
                                        <td><?php echo $log->ip_address; ?></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($log->created_at)); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No activity logs</td>
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
