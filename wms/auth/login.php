<?php
session_start();
include("../config/db.php");   // fixed path

if(isset($_POST['login'])){

    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $check = mysqli_query($conn,
        "SELECT * FROM users 
         WHERE username='$user' AND password='$pass'"
    );

    if(mysqli_num_rows($check) == 1){
        $_SESSION['user'] = $user;
        header("Location: ../dashboard.php");  // go back to main folder
        exit();
    }else{
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>WMS Login</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .login-box{
            width:350px;
            margin:120px auto;
            padding:30px;
            background:white;
            border-radius:12px;
            box-shadow:0 4px 15px rgba(0,0,0,.1);
            text-align:center;
        }
        input{
            width:85%;
            padding:10px;
            margin:10px 0;
            border-radius:6px;
            border:1px solid #ccc;
            font-size:16px;
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

<div class="login-box">
    <h2>Warehouse Login</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login">Login</button>
    </form>

    <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
</div>

</body>
</html>
