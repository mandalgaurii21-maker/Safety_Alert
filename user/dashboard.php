<?php

include "../config/auth.php";
requireLogin();

include "../config/database.php";
include "../includes/header.php";
?>

<h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?> 👋</h1>

<div class="dashboard-grid">

<div class="dashboard-card emergency">

<h2>🚨 SOS</h2>

<p>
Send an emergency alert.
</p>

<a href="../emergency/sos.php" class="btn danger">
Send SOS
</a>

</div>


<div class="dashboard-card">

<h2>👮 Police Alert</h2>

<p>
Send alert to police.
</p>

<a href="../emergency/police_alert.php" class="btn">
Police Alert
</a>

</div>


<div class="dashboard-card">

<h2>📞 Contacts</h2>

<p>
Manage emergency contacts.
</p>

<a href="../emergency/contacts.php" class="btn">
Contacts
</a>

</div>


<div class="dashboard-card">

<h2>📝 Report Incident</h2>

<p>
Report a safety incident.
</p>

<a href="../incidents/report.php" class="btn">
Report
</a>

</div>

</div>

<?php include "../includes/footer.php"; ?>