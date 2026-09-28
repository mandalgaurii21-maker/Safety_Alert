<?php

include "../config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];

    if ($name == "" || $email == "" || $password == "") {

        $message = "Please fill all required fields.";

    } else {

        $check = mysqli_prepare(
            $conn,
            "SELECT id FROM users WHERE email = ?"
        );

        mysqli_stmt_bind_param($check, "s", $email);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {

            $message = "Email already registered.";

        } else {

            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $role = "user";

            $stmt = mysqli_prepare(
                $conn,
                "INSERT INTO users
                (name,email,phone,password,role)
                VALUES (?,?,?,?,?)"
            );

            mysqli_stmt_bind_param(
                $stmt,
                "sssss",
                $name,
                $email,
                $phone,
                $hashedPassword,
                $role
            );

            if (mysqli_stmt_execute($stmt)) {

                header("Location: login.php?registered=1");
                exit();

            } else {

                $message = "Registration failed.";
            }
        }
    }
}

include "../includes/header.php";
?>

<div class="form-container">

<h2>Create Account</h2>

<?php if ($message): ?>
    <div class="message">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<form method="POST">

<label>Name</label>
<input type="text" name="name" required>

<label>Email</label>
<input type="email" name="email" required>

<label>Phone</label>
<input type="text" name="phone">

<label>Password</label>
<input type="password" name="password" required>

<button type="submit" class="btn">
    Register
</button>

</form>

<p>
Already have an account?
<a href="login.php">Login</a>
</p>

</div>

<?php include "../includes/footer.php"; ?>