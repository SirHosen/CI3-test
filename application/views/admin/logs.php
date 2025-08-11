<div class="container-fluid mt-4">
    <h2>System Logs</h2>
    
    <div class="card mt-4">
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th>IP Address</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($logs as $log): ?>
                    <tr>
                        <td><?= $log->id ?></td>
                        <td><?= $log->username ?></td>
                        <td>
                            <span class="badge bg-<?= $log->action == 'LOGIN' ? 'success' : ($log->action == 'LOGOUT' ? 'warning' : 'info') ?>">
                                <?= $log->action ?>
                            </span>
                        </td>
                        <td><?= $log->description ?></td>
                        <td><?= $log->ip_address ?></td>
                        <td><?= date('d/m/Y H:i:s', strtotime($log->created_at)) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
