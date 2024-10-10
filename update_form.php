<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jobsheet 2</title>
  <?php

  require 'koneksi.php';


  // hello world
  // my name is erick
  // and this and that
  // hehe


  $id = $_GET['id'];
  $sql = "SELECT m.id, m.nama, m.nim, k.kelas, GROUP_CONCAT(ma.makul SEPARATOR ', ') AS makul 
  FROM mahasiswa m
  LEFT JOIN kelas k ON m.id = k.mahasiswa_id
  LEFT JOIN makul ma ON m.id = ma.mahasiswa_id
  WHERE m.id = '$id'
  GROUP BY m.id, k.kelas";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
  } else {
    die("Data not found");
  }
  ?>

</head>

<body>
  <form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?= $data['id']; ?>">

    <label for="name">Nama Mahasiswa: </label><br>
    <input type="text" name="nama" value="<?= $data['nama']; ?>"><br>

    <label for="nim">Nomor Induk Mahasiswa: </label><br>
    <input type="text" name="nim" value="<?= $data['nim']; ?>"><br>

    <label for="kelas">Kelas: </label><br>
    <input type="radio" name="kelas" value="5A" <?= $data['kelas'] == '5A' ? 'checked' : ''; ?>>Kelas 5A<br>
    <input type="radio" name="kelas" value="5B" <?= $data['kelas'] == '5B' ? 'checked' : ''; ?>>Kelas 5B<br>
    <input type="radio" name="kelas" value="5C" <?= $data['kelas'] == '5C' ? 'checked' : ''; ?>>Kelas 5C<br>
    <input type="radio" name="kelas" value="5D" <?= $data['kelas'] == '5D' ? 'checked' : ''; ?>>Kelas 5D<br>
    <input type="radio" name="kelas" value="5E" <?= $data['kelas'] == '5E' ? 'checked' : ''; ?>>Kelas 5E<br>

    <label for="makul">Mata Kuliah Pilihan: </label><br>
    <input type="checkbox" name="makul[]" value="Web Application Development" <?= strpos($data['makul'], 'Web Application Development') !== false ? 'checked' : ''; ?>>Web Application Development<br>
    <input type="checkbox" name="makul[]" value="Mobile Application Development" <?= strpos($data['makul'], 'Mobile Application Development') !== false ? 'checked' : ''; ?>>Mobile Application Development<br>
    <input type="checkbox" name="makul[]" value="UI/UX Design" <?= strpos($data['makul'], 'UI/UX Design') !== false ? 'checked' : ''; ?>>UI/UX Design<br>
    <input type="checkbox" name="makul[]" value="Software Engineering" <?= strpos($data['makul'], 'Software Engineering') !== false ? 'checked' : ''; ?>>Software Engineering<br>
    <input type="checkbox" name="makul[]" value="Data Engineering" <?= strpos($data['makul'], 'Data Engineering') !== false ? 'checked' : ''; ?>>Data Engineering<br><br>

    <input type="submit" value="Simpan KRS">
  </form>
</body>

</html>