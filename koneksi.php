<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'uts5e';

try {
  $conn = new mysqli($host, $username, $password);
  if ($conn->connect_error) {
    die("Koneksi gagal: {$conn->connect_error}");
  }
} catch (mysqli_sql_exception $e) {
  die("Connection failed: " . $e->getMessage());
}

try {
  $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
  if ($conn->query($sql) === TRUE) {
    error_log('the query success or something');
  } else {
    die("Error creating database: {$conn->error}");
  }

  $conn->select_db($dbname);

  $sql_mahasiswa = "CREATE TABLE IF NOT EXISTS mahasiswa(
                        id INT(2) PRIMARY KEY AUTO_INCREMENT, 
                        nama VARCHAR(30),
                        nim VARCHAR(30)
                      )";

  if ($conn->query($sql_mahasiswa) === TRUE) {
    error_log("the query success or something");
  } else {
    die("Error creating 'mahasiswa' table: {$conn->error}");
  }

  $sql_kelas = "CREATE TABLE IF NOT EXISTS kelas(
                    id INT(2) PRIMARY KEY AUTO_INCREMENT, 
                    mahasiswa_id INT(2), 
                    kelas VARCHAR(50)
                  )";

  if ($conn->query($sql_kelas) === TRUE) {
    error_log("the query success or something");
  } else {
    die("Error creating 'kelas' table: {$conn->error}");
  }

  $sql_makul = "CREATE TABLE IF NOT EXISTS makul(
                    id INT(2) PRIMARY KEY AUTO_INCREMENT, 
                    mahasiswa_id INT(2), 
                    makul VARCHAR(50),
                    FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa(id)
                  )";

  if ($conn->query($sql_makul) === TRUE) {
    error_log("the query success or something");
  } else {
    die("Error creating 'makul' table: {$conn->error}");
  }

} catch (Exception $exception) {
  error_log("Error: " . $exception->getMessage());
}
