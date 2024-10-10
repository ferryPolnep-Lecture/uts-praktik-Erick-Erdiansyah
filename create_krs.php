<?php
// koneksi database
require 'koneksi.php';

// ambil data dari form
$name = $_POST['name'];
$nim = $_POST['nim'];
$kelas = $_POST['kelas'];
$makul = $_POST['makul'];

$sql_mahasiswa = "INSERT INTO mahasiswa (nama, nim) VALUES ('$name', '$nim')";

if ($conn->query($sql_mahasiswa) === TRUE) {
    $mahasiswa_id = $conn->insert_id;

    $sql_kelas = "INSERT INTO kelas (mahasiswa_id, kelas) VALUES ('$mahasiswa_id', '$kelas')";
    if ($conn->query($sql_kelas) === TRUE) {
        echo "Kelas berhasil ditambahkan<br>";
    } else {
        echo "Error: {$sql_kelas} <br> {$conn->error}<br>";
    }

    foreach ($makul as $m) {
        $sql_makul = "INSERT INTO makul (mahasiswa_id, makul) VALUES ('$mahasiswa_id', '$m')";
        if ($conn->query($sql_makul) === TRUE) {
            echo "Mata Kuliah $m berhasil ditambahkan<br>";
        } else {
            echo "Error: {$sql_makul} <br> {$conn->error}<br>";
        }
    }
} else {
    echo "Error: {$sql_mahasiswa} <br> {$conn->error}<br>";
}

// Tutup koneksi
$conn->close();
