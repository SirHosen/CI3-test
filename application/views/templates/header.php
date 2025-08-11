<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url('dashboard'); ?>">test</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
                    </li>
                    
                    <?php 
                    // Cek apakah user adalah admin
                    $user_id = $this->session->userdata('user_id');
                    $this->db->select('role');
                    $this->db->where('id', $user_id);
                    $user = $this->db->get('users')->row();
                    
                    if($user && $user->role == 'admin'): 
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                            Admin Menu
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo base_url('admin/dashboard'); ?>">Admin Dashboard</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('admin/users'); ?>">Manage Users</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('admin/logs'); ?>">System Logs</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('admin/reports'); ?>">Reports</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <?php echo $this->session->userdata('full_name'); ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo base_url('user/profile'); ?>">
                                <i class="fas fa-user"></i> My Profile
                            </a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('user/edit_profile'); ?>">
                                <i class="fas fa-edit"></i> Edit Profile
                            </a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('user/change_password'); ?>">
                                <i class="fas fa-key"></i> Ubah Password
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('logout'); ?>">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
