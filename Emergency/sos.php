<?php

include "../config/auth.php";
requireLogin();

include "../config/database.php";

$user_id = $_SESSION['user_id'];

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $latitude = $_POST['latitude'] ?? "";
    $longitude = $_POST['longitude'] ?? "";

    $type = "SOS";

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO alerts
        (user_id,type,latitude,longitude,status)
        VALUES (?,?,?,?,?)"
    );

    $status = "active";

    mysqli_stmt_bind_param(
        $stmt,
        "issss",
        $user_id,
        $type,
        $latitude,
        $longitude,
        $status
    );

    if (mysqli_stmt_execute($stmt)) {

        $message =
        "🚨 SOS Alert sent successfully!";

    } else {

        $message = "Unable to send alert.";
    }
}

include "../includes/header.php";
?>

<div class="sos-container">

<h1>🚨 Emergency SOS</h1>

<p>
Press the button below to send an emergency alert.
</p>

<?php if ($message): ?>

<div class="success">
    <?php echo $message; ?>
</div>

<?php endif; ?>

<form method="POST" id="sosForm">

<input
    type="hidden"
    name="latitude"
    id="latitude"
>

<input
    type="hidden"
    name="longitude"
    id="longitude"
>

<button
    type="submit"
    class="sos-button"
    onclick="getLocation()"
>
    SOS
</button>

</form>

<p id="locationStatus"></p>

</div>

<?php include "../includes/footer.php"; ?>