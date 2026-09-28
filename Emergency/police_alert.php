<?php

include "../config/auth.php";
requireLogin();

include "../config/database.php";

$user_id = $_SESSION['user_id'];

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $type = "Police";

    $status = "active";

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO alerts
        (user_id,type,latitude,longitude,status)
        VALUES (?,?,?,?,?)"
    );

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
        "Police alert sent successfully.";

    } else {

        $message =
        "Unable to send police alert.";
    }
}

include "../includes/header.php";
?>

<div class="form-container">

<h2>👮 Police Emergency Alert</h2>

<?php if ($message): ?>

<div class="success">
<?php echo $message; ?>
</div>

<?php endif; ?>

<form method="POST">

<input
    type="hidden"
    name="latitude"
    id="policeLatitude"
>

<input
    type="hidden"
    name="longitude"
    id="policeLongitude"
>

<label>Emergency Description</label>

<textarea
    name="description"
    rows="5"
    placeholder="Describe your emergency..."
></textarea>

<button
    type="submit"
    class="btn danger"
    onclick="getPoliceLocation()"
>
    Send Police Alert
</button>

</form>

</div>

<?php include "../includes/footer.php"; ?>