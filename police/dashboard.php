<?php

include "../config/auth.php";
requireRole("police");

include "../config/database.php";

$alerts = mysqli_query(
    $conn,
    "SELECT
        alerts.*,
        users.name,
        users.phone
     FROM alerts
     JOIN users
     ON alerts.user_id = users.id
     ORDER BY alerts.created_at DESC"
);

include "../includes/header.php";
?>

<h1>👮 Police Dashboard</h1>

<div class="table-container">

<table>

<tr>

<th>ID</th>
<th>User</th>
<th>Phone</th>
<th>Type</th>
<th>Location</th>
<th>Status</th>
<th>Date</th>

</tr>

<?php while ($alert = mysqli_fetch_assoc($alerts)): ?>

<tr>

<td>
<?php echo $alert['id']; ?>
</td>

<td>
<?php echo htmlspecialchars($alert['name']); ?>
</td>

<td>
<?php echo htmlspecialchars($alert['phone']); ?>
</td>

<td>
<?php echo htmlspecialchars($alert['type']); ?>
</td>

<td>

<?php if ($alert['latitude'] && $alert['longitude']): ?>

<a
href="https://www.google.com/maps?q=<?php echo $alert['latitude']; ?>,<?php echo $alert['longitude']; ?>"
target="_blank"
>
View Location
</a>

<?php else: ?>

Not available

<?php endif; ?>

</td>

<td>
<?php echo htmlspecialchars($alert['status']); ?>
</td>

<td>
<?php echo $alert['created_at']; ?>
</td>

</tr>

<?php endwhile; ?>

</table>

</div>

<?php include "../includes/footer.php"; ?>