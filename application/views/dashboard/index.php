<div class="container mt-4">
    <h2>Dashboard</h2>
    
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informasi User</h5>
                    <p><strong>Username:</strong> <?= $user->username ?></p>
                    <p><strong>Email:</strong> <?= $user->email ?></p>
                    <p><strong>Nama:</strong> <?= $user->full_name ?></p>
                    <p><strong>Bergabung:</strong> <?= date('d M Y', strtotime($user->created_at)) ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Statistik Sistem</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center">
                                <h3><?= $statistics->total_users ?></h3>
                                <p>Total User</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h3><?= $statistics->active_users ?></h3>
                                <p>User Aktif</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h3><?= $statistics->inactive_users ?></h3>
                                <p>User Tidak Aktif</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h3><?= $statistics->registration_days ?></h3>
                                <p>Hari Registrasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">User Aktif</h5>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Login Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($active_users as $au): ?>
                                <tr>
                                    <td><?= $au->username ?></td>
                                    <td><?= $au->email ?></td>
                                    <td><?= $au->login_count ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Log Aktivitas Anda</h5>
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
                                <?php foreach($logs as $log): ?>
                                <tr>
                                    <td><span class="badge bg-info"><?= $log->action ?></span></td>
                                    <td><?= $log->description ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($log->created_at)) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
