<div class="container-fluid mt-4">
    <h2>Reports & Analytics</h2>
    
    <!-- Summary Cards -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo isset($statistics->total_users) ? $statistics->total_users : 0; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Active Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo isset($statistics->active_users) ? $statistics->active_users : 0; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Today's Logins</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo isset($today_logins) ? $today_logins : 0; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sign-in-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                New Users (This Month)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo isset($new_users_month) ? $new_users_month : 0; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Row -->
    <div class="row mt-4">
        <!-- Registration Chart -->
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">User Registration Trend (Last 30 Days)</h6>
                </div>
                <div class="card-body">
                    <canvas id="registrationChart" height="100"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Activity Pie Chart -->
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">User Activity (Last 7 Days)</h6>
                </div>
                <div class="card-body">
                    <canvas id="activityChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tables Row -->
    <div class="row mt-4">
        <!-- Most Active Users -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Most Active Users</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Login Count</th>
                                    <th>Last Login</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($active_users) && !empty($active_users)): ?>
                                    <?php foreach($active_users as $user): ?>
                                    <tr>
                                        <td><?php echo $user->username; ?></td>
                                        <td><?php echo $user->email; ?></td>
                                        <td>
                                            <span class="badge bg-success"><?php echo $user->login_count; ?></span>
                                        </td>
                                        <td>
                                            <?php 
                                            $last_login = isset($user->last_login) ? $user->last_login : $user->created_at;
                                            echo date('d/m/Y H:i', strtotime($last_login)); 
                                            ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No active users found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Activities -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Activities</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($recent_activities) && !empty($recent_activities)): ?>
                                    <?php foreach($recent_activities as $activity): ?>
                                    <tr>
                                        <td><?php echo isset($activity->username) ? $activity->username : 'Unknown'; ?></td>
                                        <td>
                                            <?php
                                            $badge_class = '';
                                            switch($activity->action) {
                                                case 'LOGIN':
                                                    $badge_class = 'bg-success';
                                                    break;
                                                case 'LOGOUT':
                                                    $badge_class = 'bg-warning';
                                                    break;
                                                case 'REGISTER':
                                                    $badge_class = 'bg-info';
                                                    break;
                                                default:
                                                    $badge_class = 'bg-secondary';
                                            }
                                            ?>
                                            <span class="badge <?php echo $badge_class; ?>"><?php echo $activity->action; ?></span>
                                        </td>
                                        <td><?php echo date('d/m H:i', strtotime($activity->created_at)); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center">No recent activities</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Export Buttons -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Export Reports</h6>
                </div>
                <div class="card-body">
                    <button onclick="exportReport('pdf')" class="btn btn-danger">
                        <i class="fas fa-file-pdf"></i> Export to PDF
                    </button>
                    <button onclick="exportReport('excel')" class="btn btn-success">
                        <i class="fas fa-file-excel"></i> Export to Excel
                    </button>
                    <button onclick="exportReport('csv')" class="btn btn-info">
                        <i class="fas fa-file-csv"></i> Export to CSV
                    </button>
                    <button onclick="window.print()" class="btn btn-secondary">
                        <i class="fas fa-print"></i> Print Report
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
// Prepare data for charts
<?php 
// Registration chart data
$reg_chart_data = isset($registration_chart) ? $registration_chart : array();
$reg_labels = array();
$reg_data = array();
foreach($reg_chart_data as $item) {
    $reg_labels[] = $item->date;
    $reg_data[] = $item->count;
}

// Activity chart data
$act_chart_data = isset($activity_chart) ? $activity_chart : array();
$act_labels = array();
$act_counts = array();
$act_colors = array();
foreach($act_chart_data as $item) {
    $act_labels[] = $item->action;
    $act_counts[] = $item->count;
    
    switch($item->action) {
        case 'LOGIN':
            $act_colors[] = 'rgba(75, 192, 192, 0.8)';
            break;
        case 'LOGOUT':
            $act_colors[] = 'rgba(255, 206, 86, 0.8)';
            break;
        case 'REGISTER':
            $act_colors[] = 'rgba(54, 162, 235, 0.8)';
            break;
        default:
            $act_colors[] = 'rgba(201, 203, 207, 0.8)';
    }
}
?>

// Registration Chart
var ctx = document.getElementById('registrationChart').getContext('2d');
var registrationChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($reg_labels); ?>,
        datasets: [{
            label: 'New Registrations',
            data: <?php echo json_encode($reg_data); ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 2,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

// Activity Pie Chart
var ctx2 = document.getElementById('activityChart').getContext('2d');
var activityChart = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: <?php echo json_encode($act_labels); ?>,
        datasets: [{
            data: <?php echo json_encode($act_counts); ?>,
            backgroundColor: <?php echo json_encode($act_colors); ?>,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
            }
        }
    }
});

// Export functions
function exportReport(format) {
    alert('Export to ' + format.toUpperCase() + ' - Feature coming soon!');
    // Uncomment when export functionality is implemented
    // window.location.href = '<?php echo base_url("admin/export_report/"); ?>' + format;
}
</script>

<style>
/* Custom styles for cards */
.border-left-primary {
    border-left: 4px solid #4e73df !important;
}
.border-left-success {
    border-left: 4px solid #1cc88a !important;
}
.border-left-info {
    border-left: 4px solid #36b9cc !important;
}
.border-left-warning {
    border-left: 4px solid #f6c23e !important;
}
.text-xs {
    font-size: .7rem;
}
.text-gray-300 {
    color: #dddfeb !important;
}
.text-gray-800 {
    color: #5a5c69 !important;
}

/* Print styles */
@media print {
    .btn {
        display: none;
    }
    .card {
        border: 1px solid #000 !important;
    }
}
</style>
