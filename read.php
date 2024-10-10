<?php
require 'koneksi.php';

$sql = "SELECT m.id, m.nama, m.nim, k.kelas, GROUP_CONCAT(ma.makul SEPARATOR ', ') AS makul 
        FROM mahasiswa m
        LEFT JOIN kelas k ON m.id = k.mahasiswa_id
        LEFT JOIN makul ma ON m.id = ma.mahasiswa_id
        GROUP BY m.id, k.kelas";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  ?>
  <div style="margin-bottom: 1rem;">
    <a href="form_buat_krs.html" style="margin-right: 1rem;">Tambah Data Baru</a>
    <a href="update_form.php">Ubah Data</a>
  </div>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>Nama</th>
      <th>NIM</th>
      <th>Kelas</th>
      <th>Mata Kuliah</th>
      <th>Aksi</th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
      ?>
      <tr>
        <td><?= htmlspecialchars($row['id']); ?></td>
        <td><?= htmlspecialchars($row['nama']); ?></td>
        <td><?= htmlspecialchars($row['nim']); ?></td>
        <td><?= htmlspecialchars($row['kelas']); ?></td>
        <td><?= htmlspecialchars($row['makul']); ?></td>
        <td>
          <a href='update_form.php?id=<?= htmlspecialchars($row['id']); ?>'>Ubah</a> |
          <a href='delete.php?id=<?= htmlspecialchars($row['id']); ?>'
            onclick="return confirm('Apakah Anda yakin ingin menghapus?');">Hapus</a>
        </td>
      </tr>
      <?php
    }
} else {
  ?>
    <div style="margin-bottom: 1rem;">
      <a href="form_buat_krs.html" style="margin-right: 1rem;">Tambah Data Baru</a>
      <a href="update_form.php">Ubah Data</a>
    </div>
    <tr>
      <td colspan='6'>0 hasil, tambahkan data mahasiswa </td>
    </tr>
    <?php
}
?>
</table>
<?php

$conn->close();
?>