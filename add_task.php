<?php
// Koneksi ke database (misalnya menggunakan MySQL)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todo_list";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Tangkap data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $task_name = $_POST["task_name"];

  // Masukkan data ke database
  $sql = "INSERT INTO tasks (kegiatan) VALUES ('$task_name')";

  if ($conn->query($sql) === TRUE) {
    // Redirect kembali ke halaman utama setelah berhasil disimpan
    header("Location: index.php");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>
