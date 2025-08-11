<div class="container-fluid mt-4">
    <!-- Header untuk tampilan layar -->
    <div class="d-print-none">
        <h2>Reports & Analytics</h2>
        <div class="mb-3">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print"></i> Print Report
            </button>
        </div>
    </div>
    
    <!-- Header untuk print -->
    <div class="d-none d-print-block print-header">
        <div class="text-center mb-4">
            <h2>LAPORAN SISTEM MANAJEMEN USER</h2>
            <h4>CI3 Testing</h4>
            <p>Tanggal Cetak: <?php echo date('d F Y H:i:s'); ?></p>
            <hr>
        </div>
    </div>
    
    <!-- Summary Cards Section -->
    <div id="summary-section">
        <h4 class="section-title">Ringkasan Statistik</h4>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-label">Total Users</div>
                        <div class="stat-value"><?php echo isset($statistics->total_users) ? $statistics->total_users : 0; ?></div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-label">Active Users</div>
                        <div class="stat-value text-success"><?php echo isset($statistics->active_users) ? $statistics->active_users : 0; ?></div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-label">Today's Logins</div>
                        <div class="stat-value text-info"><?php echo isset($today_logins) ? $today_logins : 0; ?></div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body">
                        <div class="stat-label">New Users (This Month)</div>
                        <div class="stat-value text-warning"><?php echo isset($new_users_month) ? $new_users_month : 0; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Section -->
    <div id="chart-section" class="mt-5">
        <h4 class="section-title">Grafik & Visualisasi</h4>
        <div class="row mt-4">
            <!-- Registration Chart -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">User Registration Trend (Last 30 Days)</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="registrationChart" height="100"></canvas>
                    </div>
                </div>
            </div>
            
            <!-- Activity Summary -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">User Activity Summary (Last 7 Days)</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="activityChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tables Section -->
    <div id="table-section" class="mt-5">
        <h4 class="section-title">Detail Data</h4>
        <div class="row mt-4">
            <!-- Most Active Users -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Most Active Users</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Login Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($active_users) && !empty($active_users)): ?>
                                        <?php $no = 1; ?>
                                        <?php foreach($active_users as $user): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $user->username; ?></td>
                                            <td><?php echo $user->email; ?></td>
                                            <td class="text-center"><?php echo $user->login_count; ?></td>
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
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Recent Activities</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>Action</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($recent_activities) && !empty($recent_activities)): ?>
                                        <?php $no = 1; ?>
                                        <?php foreach($recent_activities as $activity): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo isset($activity->username) ? $activity->username : 'Unknown'; ?></td>
                                            <td>
                                                <span class="badge bg-info"><?php echo $activity->action; ?></span>
                                            </td>
                                            <td><?php echo date('d/m H:i', strtotime($activity->created_at)); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No recent activities</td>
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
    
    <!-- Footer untuk print -->
    <div class="d-none d-print-block print-footer mt-5">
        <hr>
        <div class="row">
            <div class="col-6">
                <p>Dicetak oleh: <?php echo $this->session->userdata('full_name'); ?></p>
            </div>
            <div class="col-6 text-end">
                <p>© <?php echo date('Y'); ?> Testing</p>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Custom CSS -->
<style>
/* Screen styles */
.stat-card {
    border-left: 4px solid #007bff;
    transition: transform 0.2s;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.stat-label {
    font-size: 0.875rem;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-value {
    font-size: 2rem;
    font-weight: bold;
    margin-top: 0.5rem;
}

.section-title {
    color: #333;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

/* Print styles */
@media print {
    @page {
        size: A4;
        margin: 1.5cm;
    }
    
    body {
        font-size: 12pt;
    }
    
    .card {
        border: 1px solid #000 !important;
        page-break-inside: avoid;
    }
    
    .stat-card {
        border: 2px solid #333 !important;
        text-align: center;
    }
    
    .table {
        font-size: 10pt;
    }
    
    .table th,
    .table td {
        border: 1px solid #000 !important;
        padding: 5px !important;
    }
    
    .badge {
        border: 1px solid #000;
        padding: 2px 4px;
    }
    
    canvas {
        max-height: 300px !important;
    }
}
</style>

<!-- JavaScript for Charts -->
<script>
// Prepare chart data
<?php 
$reg_chart_data = isset($registration_chart) ? $registration_chart : array();
$reg_labels = array();
$reg_data = array();
foreach($reg_chart_data as $item) {
    $reg_labels[] = date('d/m', strtotime($item->date));
    $reg_data[] = $item->count;
}

$act_chart_data = isset($activity_chart) ? $activity_chart : array();
$act_labels = array();
$act_counts = array();
foreach($act_chart_data as $item) {
    $act_labels[] = $item->action;
    $act_counts[] = $item->count;
}
?>

// Registration Chart
var ctx = document.getElementById('registrationChart');
if (ctx) {
    var registrationChart = new Chart(ctx.getContext('2d'), {
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
}

// Activity Chart
var ctx2 = document.getElementById('activityChart');
if (ctx2) {
    var activityChart = new Chart(ctx2.getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($act_labels); ?>,
            datasets: [{
                data: <?php echo json_encode($act_counts); ?>,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ],
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
}
</script>
