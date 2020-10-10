<?php
$conn = mysqli_connect("localhost", "root", "", "daftar_siswa");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;
    $nis = htmlspecialchars($data["nis"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    $foto = upload();
    if (!$foto) {
        return false;
    }
    $query = "INSERT INTO siswa VALUE ('','$nis', '$nama', '$email', '$jurusan', '$foto')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function upload()
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    if ($error === 4) {
        echo '<div class="pesan">Pilih foto lebih dulu</div>';;
        return false;
    }
    $ekstensiFotoValid = ['jpg', 'png', 'jpeg'];
    $ekstensiFoto = explode('.', $namaFile);
    $ekstensiFoto = strtolower(end($ekstensiFoto));
    if (!in_array($ekstensiFoto, $ekstensiFotoValid)) {
        echo '<div class="pesan">Yang diupload bukan foto</div>';;
        return false;
    }
    if ($ukuranFile > 60000) {
        echo '<div class="pesan">Ukuran file teralu besar</div>';
        return false;
    }
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFoto;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}
function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM siswa WHERE id =$id");
    return mysqli_affected_rows($conn);
}
function ubah($data)
{
    global $conn;

    $id = $data["id"];
    $nis = htmlspecialchars($data["nis"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $fotoLama = htmlspecialchars($data["fotoLama"]);
    if ($_FILES['foto']['error'] === 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload();
    }
    $query = "UPDATE siswa SET 
    nis = '$nis',
    nama = '$nama',
    email = '$email',
    jurusan = '$jurusan',
    foto = '$foto'
WHERE id = $id
                ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function cari($keyword)
{
    $query = "SELECT * FROM siswa
    WHERE
    nama LIKE '%$keyword%' OR
    nis LIKE '%$keyword%' OR
    email LIKE '%$keyword%' OR
    jurusan LIKE '%$keyword%' 
    ";
    return query($query);
}
function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    $result = mysqli_query($conn, "SELECT username FROM users WHERE
    username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo '<div class="pesan">Username Sudah digunakan</div>';
        return false;
    }


    if ($password !== $password2) {
        echo '<div class="pesan">Konfirmasi password tidak sama</div>';
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO users VALUE('', '$username'
    , '$password')");
    return mysqli_affected_rows($conn);
}
