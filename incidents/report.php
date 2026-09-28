<?php

include "../config/auth.php";
requireLogin();

include "../config/database.php";

$user_id = $_SESSION['user_id'];

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $location = trim($_POST['location']);

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO incidents
        (user_id,title,description,location,status)
        VALUES (?,?,?,?,?)"
    );

    $status = "pending";

    mysqli_stmt_bind_param(
        $stmt,
        "issss",
        $user_id,
        $title,
        $description,
        $location,
        $status
    );

    if (mysqli_stmt_execute($stmt)) {

        $message =
        "Incident reported successfully.";

    } else {

        $message = "Report failed.";
    }
}

include "../includes/header.php";
?>

<div class="form-container">

<h2>📝 Report an Incident</h2>

<?php if ($message): ?>

<div class="success">
<?php echo $message; ?>
</div>

<?php endif; ?>

<form method="POST">

<label>Incident Title</label>

<input
    type="text"
    name="title"
    required
>

<label>Description</label>

<textarea
    name="description"
    rows="6"
    required
></textarea>

<label>Location</label>

<input
    type="text"
    name="location"
>

<button class="btn">
Submit Report
</button>

</form>

</div>

<?php include "../includes/footer.php"; ?>