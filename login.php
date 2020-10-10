<?php
session_start();
require 'functions.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            $_SESSION["login"] = true;

            if (isset($_POST["remember"])) {        //akan logout secara otomatis selama 29 hari    
                setcookie('id', $row['id'], time() + 60 * 60 * 24 * 29);
                setcookie(
                    'key',
                    hash('sha256', $row['username']),
                    time() + 60
                );
            }


            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        body {
            font-family: sans-serif;
            background-color: dodgerblue;
        }

        .pesan {
            font-weight: bold;
            color: white;
            padding: 20px;
            background-color: red;
            text-align: center;
        }

        .box {
            width: 300px;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #191919;
            text-align: center;
        }

        .box h1 {
            color: white;
            text-transform: uppercase;
            font-weight: 500;
        }

        .box input[type="text"],
        .box input[type="password"] {
            border: 0;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #3498db;
            padding: 14px 10px;
            width: 200px;
            outline: none;
            color: white;
            border-radius: 24px;
            transition: 0.25s;
        }

        .box input[type="text"]:focus,
        .box input[type="password"]:focus {
            width: 280px;
            border-color: #2ecc71;
        }

        .box input[type="submit"] {
            border: 0;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #2ecc71;
            padding: 14px 40px;
            outline: none;
            color: white;
            border-radius: 24px;
            transition: 0.25s;
            cursor: pointer;
        }

        .box input[type="submit"]:hover {
            background: #2ecc71;
        }

        a {
            color: dodgerblue;
        }
    </style>
    <title>Login</title>
</head>

<body>
    <?php if (isset($error)) : ?>
        <div class="pesan">Username atau password salah</div>
    <?php endif; ?>
    <form class="box" action="" method="POST">
        <h1>Login</h1>
        <input type="text" name="username" placeholder="Username" />
        <input type="password" name="password" placeholder="Password" />
        <input type="submit" name="login" value="Login" />
        <input type="checkbox" name="remember" id="remember"><label for="remember" style="
  display: inline-block;
  box-sizing: border-box; color:white;">Remember me</label>
        <a href="registrasi.php">Buat Akun</a>
    </form>
</body>

</html>