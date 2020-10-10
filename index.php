<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
$siswa = query("SELECT * FROM siswa");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Siswa</title>
    <link rel="stylesheet" href="css/style.css" />
    <style>
        .loader {
            width: 100px;
            position: absolute;
            top: 75px;
            z-index: -100;
            left: 245px;
            display: none;
        }

        .topnav {
            overflow: hidden;
            background-color: #e9e9e9;
        }

        .topnav a {
            float: left;
            display: block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #2196F3;
            color: white;
        }

        .topnav .search-container {
            float: right;
        }

        .topnav input[type=text] {
            padding: 6px;
            margin-top: 8px;
            font-size: 17px;
            border: none;
        }

        .topnav .search-container button {
            float: right;
            padding: 6px 10px;
            margin-top: 8px;
            margin-right: 16px;
            background: #ddd;
            font-size: 17px;
            border: none;
            cursor: pointer;
        }

        .topnav .search-container button:hover {
            background: #ccc;
        }

        @media screen and (max-width: 600px) {
            .topnav .search-container {
                float: none;
            }

            .topnav a,
            .topnav input[type=text],
            .topnav .search-container button {
                float: none;
                display: block;
                text-align: left;
                width: 100%;
                margin: 0;
                padding: 14px;
            }

            .topnav input[type=text] {
                border: 1px solid #ccc;
            }
        }
    </style>

    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/script.js"></script>
</head>

<body>
    <h1 style="text-align: center; font-family: sans-serif;">Daftar Siswa</h1>
    <nav id="navbar" class="topnav">
        <a class="active" href="index.php">Home</a>
        <a href="tambah.php">Tambah</a>
        <a href="logout.php" style="color: red;">Logout</a>
        <div class="search-container">
            <form action="" method="POST">
                <input type="text" name="keyword" size="35" autofocus placeholder="masukan keyword pencarian.." autocomplete="off" id="keyword">
                <button type="submit" name="cari" id="tombol-cari">Cari</button>
                <img src="img/loading.gif" class="loader">
            </form>
        </div>
    </nav>
    <div id="container">
        <table class="content-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Aksi</th>
                    <th>NIS</th>
                    <th>Foto</th>
                    <th>Nama Siswa</th>
                    <th>Email</th>
                    <th>Jurusan</th>
                </tr>
            </thead>
            <?php $i = 1; ?>
            <?php foreach ($siswa as $row) : ?>
                <tbody>
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <a style="color: dodgerblue;" href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> | <a style="color: salmon;" href="hapus.php?id=<?= $row["id"]; ?>" onclick="
                    return confirm('Yakin')">Hapus</a>
                        </td>
                        <td>
                            <?= $row["nis"]; ?></td>
                        </td>
                        <td>
                            <img src="img/<?= $row["foto"]; ?>" width="70">
                        </td>
                        <td><?= $row["nama"]; ?></td>
                        <td><?= $row["email"] ?></td>
                        <td><?= $row["jurusan"]; ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
                </tbody>
        </table>
    </div>
    <script>
        let prevScrollpos = window.pageYOffset;
        window.onscroll = function() {
            let currentScrollPos = window.pageYOffset;
            if (prevScrollpos > currentScrollPos) {
                document.getElementById("navbar").style.top = "0";
            } else {
                document.getElementById("navbar").style.top = "-50px";
            }
            prevScrollpos = currentScrollPos;
        }
    </script>
</body>

</html>