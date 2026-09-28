<?php

include "../config/auth.php";
requireRole("admin");

include "../config/database.php";

$totalUsers = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total FROM users"
    )
)['total'];

$totalAlerts = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total FROM alerts"
    )
)['total'];

$totalReports = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total FROM incidents"
    )
)['total'];

include "../includes/header.php";
?>

<h1>⚙ Admin Dashboard</h1>

<div class="dashboard-grid">

<div class="dashboard-card">

<h2>👥 Users</h2>

<h1>
<?php echo $totalUsers; ?>
</h1>

</div>


<div class="dashboard-card">

<h2>🚨 Alerts</h2>

<h1>
<?php echo $totalAlerts; ?>
</h1>

</div>


<div class="dashboard-card">

<h2>📝 Reports</h2>

<h1>
<?php echo $totalReports; ?>
</h1>

</div>

</div>

<?php include "../includes/footer.php"; ?>