<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - CI3 App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Register</h3>
                        
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                        <?php endif; ?>
                        
                        <?= form_open('auth/register_process') ?>
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="full_name" id="full_name" value="<?= set_value('full_name') ?>">
                                <?= form_error('full_name', '<small class="text-danger">', '</small>') ?>
                            </div>
                            
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username" value="<?= set_value('username') ?>">
                                <?= form_error('username', '<small class="text-danger">', '</small>') ?>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
                                <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                                <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                            </div>
                            
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                                <?= form_error('confirm_password', '<small class="text-danger">', '</small>') ?>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        <?= form_close() ?>
                        
                        <div class="text-center mt-3">
                            <p>Sudah punya akun? <a href="<?= base_url('auth/login') ?>">Login disini</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
