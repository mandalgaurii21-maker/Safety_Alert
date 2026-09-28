<?php

include "../config/database.php";
include "../config/auth.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare(
        $conn,
        "SELECT id,name,email,password,role
         FROM users
         WHERE email = ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === "admin") {

                header("Location: ../admin/dashboard.php");

            } elseif ($user['role'] === "police") {

                header("Location: ../police/dashboard.php");

            } else {

                header("Location: dashboard.php");
            }

            exit();

        } else {

            $message = "Invalid password.";

        }

    } else {

        $message = "Account not found.";
    }
}

include "../includes/header.php";
?>

<div class="form-container">

<h2>Login</h2>

<?php if (isset($_GET['registered'])): ?>

<div class="success">
    Registration successful. Please login.
</div>

<?php endif; ?>

<?php if ($message): ?>

<div class="message">
    <?php echo $message; ?>
</div>

<?php endif; ?>

<form method="POST">

<label>Email</label>
<input type="email" name="email" required>

<label>Password</label>
<input type="password" name="password" required>

<button type="submit" class="btn">
    Login
</button>

</form>

<p>
<a href="forgot_password.php">
Forgot Password?
</a>
</p>

<p>
Don't have an account?
<a href="register.php">Register</a>
</p>

</div>

<?php include "../includes/footer.php"; ?>