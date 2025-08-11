<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Dinonaktifkan - CI3 App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-user-slash text-danger" style="font-size: 64px;"></i>
                        <h3 class="mt-4 mb-3">Akun Anda Dinonaktifkan</h3>
                        <p class="text-muted">
                            Maaf, akun Anda telah dinonaktifkan oleh administrator. 
                            Anda tidak dapat mengakses sistem saat ini.
                        </p>
                        <hr>
                        <p>Untuk informasi lebih lanjut, silakan hubungi:</p>
                        <div class="alert alert-info">
                            <i class="fas fa-envelope"></i> admin@example.com<br>
                            <i class="fas fa-phone"></i> (021) 1234-5678
                        </div>
                        <a href="<?php echo base_url('auth/login'); ?>" class="btn btn-primary mt-3">
                            <i class="fas fa-arrow-left"></i> Kembali ke Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
