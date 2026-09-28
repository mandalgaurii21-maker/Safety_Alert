<?php

include "../config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);

    $stmt = mysqli_prepare(
        $conn,
        "SELECT id FROM users WHERE email = ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {

        $message =
        "Password reset request received. Contact administrator.";

    } else {

        $message = "Email not found.";
    }
}

include "../includes/header.php";
?>

<div class="form-container">

<h2>Forgot Password</h2>

<?php if ($message): ?>

<div class="message">
    <?php echo $message; ?>
</div>

<?php endif; ?>

<form method="POST">

<label>Email</label>

<input
    type="email"
    name="email"
    required
>

<button class="btn">
    Submit
</button>

</form>

</div>

<?php include "../includes/footer.php"; ?>