<?php

include "../config/auth.php";
requireLogin();

include "../config/database.php";

$user_id = $_SESSION['user_id'];

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $relationship = trim($_POST['relationship']);

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO emergency_contacts
        (user_id,name,phone,relationship)
        VALUES (?,?,?,?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "isss",
        $user_id,
        $name,
        $phone,
        $relationship
    );

    mysqli_stmt_execute($stmt);

    $message = "Emergency contact added.";
}

$result = mysqli_query(
    $conn,
    "SELECT * FROM emergency_contacts
     WHERE user_id=$user_id
     ORDER BY id DESC"
);

include "../includes/header.php";
?>

<div class="form-container">

<h2>Emergency Contacts</h2>

<?php if ($message): ?>

<div class="success">
<?php echo $message; ?>
</div>

<?php endif; ?>

<form method="POST">

<input
    type="text"
    name="name"
    placeholder="Contact Name"
    required
>

<input
    type="text"
    name="phone"
    placeholder="Phone Number"
    required
>

<input
    type="text"
    name="relationship"
    placeholder="Relationship"
>

<button class="btn">
Add Contact
</button>

</form>

</div>


<div class="table-container">

<h2>My Contacts</h2>

<table>

<tr>
<th>Name</th>
<th>Phone</th>
<th>Relationship</th>
</tr>

<?php while ($contact = mysqli_fetch_assoc($result)): ?>

<tr>

<td>
<?php echo htmlspecialchars($contact['name']); ?>
</td>

<td>
<?php echo htmlspecialchars($contact['phone']); ?>
</td>

<td>
<?php echo htmlspecialchars($contact['relationship']); ?>
</td>

</tr>

<?php endwhile; ?>

</table>

</div>

<?php include "../includes/footer.php"; ?>