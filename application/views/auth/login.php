<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Login</h3>
                        
                        <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                        <?php endif; ?>
                        
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                        <?php endif; ?>
                        
                        <?= form_open('auth/login_process') ?>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username atau Email</label>
                                <input type="text" class="form-control" name="username" id="username" value="<?= set_value('username') ?>">
                                <?= form_error('username', '<small class="text-danger">', '</small>') ?>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                                <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        <?= form_close() ?>
                        
                        <div class="text-center mt-3">
                            <p>Belum punya akun? <a href="<?= base_url('auth/register') ?>">Daftar disini</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
