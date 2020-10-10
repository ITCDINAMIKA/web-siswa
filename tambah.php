<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';
if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        echo "<script>
        alert('data berhasil ditambahkan!');
        document.location.href = 'index.php';
    </script>";
    }
    $error = true;
    mysqli_error($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah data siswa</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
        }

        .pesan {
            font-weight: bold;
            color: white;
            padding: 20px;
            background-color: red;
            text-align: center;
        }

        .navbar {
            box-shadow: 0 3px 6px 0 rgba(0, 0, 0, .3);
            background-color: dodgerblue;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .tulisan-navbar {
            font-family: sans-serif;
            color: white;
            display: block;
            flex-grow: 1;
            overflow: hidden;
            text-align: center;
            text-overflow: ellipsis;
            white-space: nowrap;
        }


        .kembali {
            -webkit-transform: scaleX(-1);
            transform: scaleX(-1);
            text-decoration: none;
        }

        input[type=text],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid salmon;
            border-radius: 4px;
            resize: vertical;
        }

        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
        }

        .submit[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            margin-top: 20px;
            border-radius: 5px;
            background-color: greenyellow;
            padding: 20px;
        }

        .col-25 {
            float: left;
            width: 25%;
            margin-top: 6px;
        }

        .col-75 {
            float: left;
            width: 75%;
            margin-top: 6px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        @media screen and (max-width: 600px) {

            .col-25,
            .col-75,
            input[type=submit] {
                width: 100%;
                margin-top: 0;
            }
        }

        .upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .tombol-upload {
            border: 2px solid gray;
            color: gray;
            background-color: white;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 20px;
            font-weight: bold;
        }

        .upload input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }
    </style>
</head>

<body>
    <?php if (isset($error)) : ?>
        <div class="pesan">Data Gagal Ditambahkan</div>
    <?php endif; ?>
    <nav class="navbar" id="abcde">
        <i><a href="index.php" class="kembali"><img class="kembali" src="img/icons/icons8-arrow-50.png"></a>
        </i>
        <h1 class="tulisan-navbar">Tambah Data Siswa</h1>
    </nav>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-25">
                    <label for="nis">NIS</label>
                </div>
                <div class="col-75">
                    <input type="text" id="nis" name="nis" placeholder="NIS">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="nama">Nama</label>
                </div>
                <div class="col-75">
                    <input type="text" id="nama" name="nama" placeholder="Nama Lengkap">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="email">Email</label>
                </div>
                <div class="col-75">
                    <input type="text" id="email" name="email" placeholder="email">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="jurusan">Jurusan</label>
                </div>
                <div class="col-75">
                    <select id="jurusan" name="jurusan">
                        <option value="pilih">Pilih Jurusan-</option>
                        <option value="teknik komputer dan jaringan">Teknik komputer Dan Jaringan</option>
                        <option value="multi media">Multi Media</option>
                        <option value="rekayasa perangkat lunak">Rekayasa Perangkat Lunak</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="foto">Upload foto</label>
                </div>
                <div class="col-75">
                    <div class="upload">
                        <button type="submit" class="tombol-upload">Upload foto</button>
                        <input type="file" name="foto" />
                    </div>
                </div>
            </div>
            <div class="row">
                <button class="submit" type="submit" name="submit">Tambah Data</button>
            </div>
        </form>
    </div>


</body>

</html>