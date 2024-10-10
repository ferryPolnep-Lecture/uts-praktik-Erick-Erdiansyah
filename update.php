<?php
require 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$nim = $_POST['nim'];
$kelas = $_POST['kelas'];
$makul = isset($_POST['makul']) ? implode(', ', $_POST['makul']) : '';

$stmt = $conn->prepare("UPDATE mahasiswa SET nama=?, nim=? WHERE id=?");
$stmt->bind_param("ssi", $nama, $nim, $id);

if ($stmt->execute() === TRUE) {
  $stmtKelas = $conn->prepare("UPDATE kelas SET kelas=? WHERE mahasiswa_id=?");
  $stmtKelas->bind_param("si", $kelas, $id);

  if ($stmtKelas->execute() === TRUE) {
    $conn->query("DELETE FROM makul WHERE mahasiswa_id = $id");
    if ($makul) {
      $makulArray = explode(', ', $makul);
      foreach ($makulArray as $item) {
        $conn->query("INSERT INTO makul (mahasiswa_id, makul) VALUES ($id, '$item')");
      }
    }
    header("Location: read.php");
  } else {
    error_log("Error updating kelas: {$stmtKelas->error}");
  }
  $stmtKelas->close();
} else {
  error_log("Error updating mahasiswa: {$stmt->error}");
}

$stmt->close();
$conn->close();