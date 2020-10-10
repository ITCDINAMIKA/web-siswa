<?php
require '../functions.php';
$keyword = $_GET["keyword"];

$query = "SELECT * FROM siswa WHERE
    nama LIKE '%$keyword%' OR
    nis LIKE '%$keyword%' OR
    email LIKE '%$keyword%' OR
    jurusan LIKE '%$keyword%' 
    ";
$siswa = query($query);
?>
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
</table>