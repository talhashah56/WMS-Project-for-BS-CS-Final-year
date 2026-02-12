<?php
session_start();
include("../config/db.php");

if(isset($_POST['add_user'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role     = mysqli_real_escape_string($conn, $_POST['role']);

    // Check if username exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if(mysqli_num_rows($check) > 0){
        $error = "Username already exists!";
    } else {
        mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', MD5('$password'), '$role')");
        $success = "User added successfully!";
    }
}
?>

<h2>Add User</h2>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <select name="role">
        <option value="admin">Admin</option>
        <option value="staff">Staff</option>
    </select><br><br>
    <button name="add_user">Add User</button>
</form>

<?php 
if(isset($error)) echo "<p style='color:red'>$error</p>";
if(isset($success)) echo "<p style='color:green'>$success</p>";
?>
