<?php
require 'functions.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('user baru berhasil dibuat!');
        document.location.href = 'login.php';
    </script>";
    } else {
        echo mysqli_error($conn);
    }
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

        .box button[type="submit"] {
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
    </style>
    <title>Registrasi</title>
</head>

<body>
    <?php if (isset($error)) : ?>
        <div class="pesan">Gagagl membuat akun</div>
    <?php endif; ?>
    <form class="box" action="" method="POST">
        <h1>Registrasi</h1>
        <input type="text" name="username" placeholder="Username" autocomplete="off" />
        <input type="password" name="password" placeholder="Password" />
        <input type="password" name="password2" placeholder="Konfirmasi Password" />
        <button type="submit" name="register" value="Buat Akun">Buat Akun</button>
        <a style="color: white;" href="login.php">Sudah punya akun?</a>
    </form>
</body>

</html>