<?php
require 'koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM makul WHERE mahasiswa_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

$sql = "DELETE FROM kelas WHERE mahasiswa_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

$sql = "DELETE FROM mahasiswa WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php");
} else {
    echo "Error: {$stmt->error}";
}

$stmt->close();
$conn->close();
?>
