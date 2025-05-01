<?php
session_start();
if (!isset($_SESSION['admin'])) header('Location: login.php');
include('../includes/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Event Manager</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .main-content {
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .table-responsive {
            overflow-x: auto;
        }
        .action-btns .btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar bg-dark">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">Event Manager</h4>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add_event.php">
                                <i class="fas fa-calendar-plus me-2"></i>Add Event
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-users me-2"></i>Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog me-2"></i>Settings
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link text-danger" href="logout.php">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <a href="add_event.php" class="btn btn-sm btn-success">
                                <i class="fas fa-plus me-1"></i> Add Event
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title">Total Events</h5>
                                        <?php
                                        $totalEvents = $conn->query("SELECT COUNT(*) as count FROM events")->fetch_assoc()['count'];
                                        ?>
                                        <h2 class="mb-0"><?php echo $totalEvents; ?></h2>
                                    </div>
                                    <i class="fas fa-calendar fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title">Upcoming Events</h5>
                                        <?php
                                        $upcomingEvents = $conn->query("SELECT COUNT(*) as count FROM events WHERE date >= CURDATE()")->fetch_assoc()['count'];
                                        ?>
                                        <h2 class="mb-0"><?php echo $upcomingEvents; ?></h2>
                                    </div>
                                    <i class="fas fa-calendar-check fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-info mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title">Past Events</h5>
                                        <?php
                                        $pastEvents = $conn->query("SELECT COUNT(*) as count FROM events WHERE date < CURDATE()")->fetch_assoc()['count'];
                                        ?>
                                        <h2 class="mb-0"><?php echo $pastEvents; ?></h2>
                                    </div>
                                    <i class="fas fa-history fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Events Table -->
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">All Events</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = $conn->query("SELECT * FROM events ORDER BY date DESC");
                                    while ($row = $result->fetch_assoc()) {
                                        $isPast = strtotime($row['date']) < time();
                                        $status = $isPast ? 'Past' : 'Upcoming';
                                        $statusClass = $isPast ? 'bg-secondary' : 'bg-success';
                                        
                                        echo "<tr>
                                            <td>" . htmlspecialchars($row['title']) . "</td>
                                            <td>" . date('M j, Y', strtotime($row['date'])) . "</td>
                                            <td>" . htmlspecialchars($row['location']) . "</td>
                                            <td><span class='badge $statusClass'>$status</span></td>
                                            <td class='action-btns'>
                                                <a href='edit_event.php?id=".$row['id']."' class='btn btn-sm btn-primary'>
                                                    <i class='fas fa-edit'></i> Edit
                                                </a>
                                                <a href='delete_event.php?id=".$row['id']."' 
                                                   class='btn btn-sm btn-danger' 
                                                   onclick='return confirm(\"Are you sure you want to delete this event?\")'>
                                                    <i class='fas fa-trash-alt'></i> Delete
                                                </a>
                                            </td>
                                        </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>