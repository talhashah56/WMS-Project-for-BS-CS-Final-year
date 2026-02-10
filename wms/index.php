<?php
session_start();
include("config/db.php");

if(isset($_POST['login'])){
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    // check username and password
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$user' AND password='$pass'");

    if(mysqli_num_rows($check) == 1){
        $_SESSION['user'] = $user;  // set session
        header("Location: dashboard.php");
        exit();  // stop script after redirect
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>WMS Login</title>
    <style>
        .login-box{
            width:350px;
            margin:120px auto;
            padding:30px;
            background:white;
            border-radius:12px;
            box-shadow:0 4px 15px rgba(0,0,0,.1);
            text-align:center;
            align-items: center;
        }
        input{
            width:85%;
            padding:10px;
            margin:10px 0;
            border-radius:6px;
            border:1px solid #ccc;
            font-size:16px;
            align-items: center;
        }
        button{
            padding:10px 30px;
            background:#1e90ff;
            border:none;
            color:white;
            border-radius:6px;
            cursor:pointer;
            font-size:16px;
        }
        button:hover{ background:#0f70d1; }
        .error{ color:red; margin-top:10px; }
    </style>
</head>
<body>



<form method="POST" class="login-box">
    <h2>Warehouse Management System Login</h2>
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button name="login">Login</button>
</form>

<?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>

</body>
</html>
