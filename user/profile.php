<?php

include "../config/auth.php";
requireLogin();

include "../config/database.php";

$user_id = $_SESSION['user_id'];

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE users
         SET name=?, phone=?
         WHERE id=?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssi",
        $name,
        $phone,
        $user_id
    );

    mysqli_stmt_execute($stmt);

    $_SESSION['name'] = $name;

    $message = "Profile updated successfully.";
}

$stmt = mysqli_prepare(
    $conn,
    "SELECT name,email,phone
     FROM users
     WHERE id=?"
);

mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

$user = mysqli_fetch_assoc(
    mysqli_stmt_get_result($stmt)
);

include "../includes/header.php";
?>

<div class="form-container">

<h2>My Profile</h2>

<?php if ($message): ?>

<div class="success">
    <?php echo $message; ?>
</div>

<?php endif; ?>

<form method="POST">

<label>Name</label>

<input
    type="text"
    name="name"
    value="<?php echo htmlspecialchars($user['name']); ?>"
    required
>

<label>Email</label>

<input
    type="email"
    value="<?php echo htmlspecialchars($user['email']); ?>"
    disabled
>

<label>Phone</label>

<input
    type="text"
    name="phone"
    value="<?php echo htmlspecialchars($user['phone']); ?>"
>

<button class="btn">
    Update Profile
</button>

</form>

</div>

<?php include "../includes/footer.php"; ?>