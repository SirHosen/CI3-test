<div class="container-fluid mt-4">
    <h2>Manage Users</h2>
    
    <div class="card mt-4">
        <div class="card-body">
            <table class="table table-striped" id="usersTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Registered</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user): ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->username ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->full_name ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($user->created_at)) ?></td>
                        <td>
                            <?php if($user->is_active): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/users/view/'.$user->id) ?>" class="btn btn-sm btn-info">View</a>
                            <a href="<?= base_url('admin/users/edit/'.$user->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?= base_url('admin/users/delete/'.$user->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
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
