<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}

include("config/db.php");

// Fetch current logged-in user role
$currentUser = $_SESSION['user'];
$userData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE username='$currentUser'"));
$currentRole = $userData['role'];

// Restrict access for non-admin staff
if($currentRole != 'admin'){
    echo "<p style='text-align:center; color:red; font-weight:bold;'>Access Denied! Only Admin can manage users.</p>";
    echo "<p style='text-align:center;'><a href='dashboard.php'>Back to Dashboard</a></p>";
    exit();
}

// Add User
if(isset($_POST['add_user'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role     = mysqli_real_escape_string($conn, $_POST['role']);

    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if(mysqli_num_rows($check) > 0){
        $error = "Username already exists!";
    } else {
        mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', MD5('$password'), '$role')");
        $success = "User added successfully!";
    }
}

// Delete User
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    // Prevent admin from deleting themselves
    $userToDelete = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='$id'"));
    if($userToDelete['username'] == $currentUser){
        $error = "You cannot delete your own admin account!";
    } else {
        mysqli_query($conn, "DELETE FROM users WHERE id='$id'");
        $success = "User deleted successfully!";
    }
}

// Fetch all users
$users = mysqli_query($conn, "SELECT * FROM users ORDER BY id ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users - WMS</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background: #333; color: white; }
        a.button { text-decoration: none; padding: 5px 10px; border-radius: 5px; background: #28a745; color: white; }
        a.delete { background: #dc3545; }
        form { width: 300px; margin: 20px auto; text-align: center; }
        input, select { width: 100%; padding: 8px; margin: 5px 0; }
        button { padding: 10px 15px; background: #007bff; color: white; border: none; border-radius: 5px; }
        .message { text-align: center; font-weight: bold; }
    </style>
</head>
<body>

<h1 align="center">Manage Users</h1>

<?php
if(isset($error)) echo "<p class='message' style='color:red;'>$error</p>";
if(isset($success)) echo "<p class='message' style='color:green;'>$success</p>";
?>

<!-- Add User Form -->
<form method="POST">
    <h3>Add New User</h3>
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <select name="role">
        <option value="admin">Admin</option>
        <option value="staff">Staff</option>
    </select><br>
    <button name="add_user">Add User</button>
</form>
<div style="text-align:center; margin-bottom:15px;">
    <input type="text" id="searchUser" placeholder="Search Users..." style="padding:8px; width:250px; border-radius:5px; border:1px solid #ccc;">
</div>

<!-- Users Table -->
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($users)){ ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['username']; ?></td>
        <td><?php echo $row['role']; ?></td>
        <td>
            <?php if($row['username'] != $currentUser){ ?>
            <a href="users_manage.php?delete=<?php echo $row['id']; ?>" class="button delete" onclick="return confirm('Are you sure to delete?')">Delete</a>
            <?php } else { echo "<span style='color:gray;'>Cannot delete self</span>"; } ?>
        </td>
    </tr>
    <?php } ?>
</table>

<div align="center">
    <a href="dashboard.php" class="button">Back to Dashboard</a>
</div>
<script>
const searchInput = document.getElementById('searchUser');
const table = document.getElementById('usersTable');

searchInput.addEventListener('input', function(){
    const filter = this.value.toLowerCase();
    for(let row of table.tBodies[0].rows){
        row.style.display = row.cells[1].textContent.toLowerCase().includes(filter) ? '' : 'none';
    }
});
</script>

</body>
</html>
