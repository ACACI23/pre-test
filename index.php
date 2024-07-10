<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To Do List</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .title {
      float: left;
      color: blue;
    }
    .view-button {
      float: right;
    }
    .clearfix {
      clear: both;
    }
    .add-task-form {
      display: none; /* Form tambah kegiatan default tersembunyi */
      transition: all 0.3s ease; /* Animasi smooth */
    }
    .add-task-form.show {
      display: block; /* Menampilkan form jika memiliki kelas 'show' */
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h1 class="title">List Kegiatanku</h1>
    <a href="#" id="show-form-btn" class="btn btn-primary view-button">Tambah Kegiatan</a>
    <div class="clearfix"></div>

    <!-- Form tambah kegiatan -->
    <form action="add_task.php" method="POST" class="add-task-form mt-3">
      <h3>Masukan Kegiatan Hari Ini</h3>
      <h5>Nama Kegiatan</h5>
      
      <div class="form-group">
        <input type="text" name="task_name" class="form-control col-5" placeholder="Tambahkan kegiatan baru" required>
      </div>

      <button type="submit" class="btn btn-success mt-2">Simpan</button>
    </form>

    <!-- Tabel untuk menampilkan daftar kegiatan -->
    <table class="table mt-3">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Kegiatan</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Kode PHP untuk mengambil dan menampilkan data kegiatan
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "todo_list";

          $conn = new mysqli($servername, $username, $password, $dbname);

          // Periksa koneksi
          if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
          }

          // Query untuk mengambil semua kegiatan dari database
          $sql = "SELECT * FROM tasks";
          $result = $conn->query($sql);

          // Tampilkan data kegiatan dalam tabel jika ada
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<th scope='row'>" . $row["id"] . "</th>";
              echo "<td>" . $row["kegiatan"] . "</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='2'>Belum ada kegiatan tersimpan.</td></tr>";
          }

          $conn->close();
        ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap JS dan dependensi Popper.js & jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    // Script untuk menampilkan/menyembunyikan form tambah kegiatan
    $(document).ready(function() {
      $('#show-form-btn').click(function() {
        $('.add-task-form').toggleClass('show'); // Toggle kelas 'show' pada form tambah kegiatan
      });
    });
  </script>
</body>
</html>
