<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <link rel="shortcut icon" href="./public/favicon.ico" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200">
  <?php
  $success_message = '';
  $error_message = '';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $birthdateDay = htmlspecialchars($_POST['birthdate_day']);
    $birthdateMonth = htmlspecialchars($_POST['birthdate_month']);
    $birthdateYear = htmlspecialchars($_POST['birthdate_year']);
    $gender = htmlspecialchars($_POST['gender']);
    $birthDate = $birthdateYear . '-' . $birthdateMonth . '-' . $birthdateDay;

    // Contoh validasi sederhana
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($gender)) {
      $error_message = "Harap mengisi semua field";
    } else {

      // Logika untuk menyimpan data ke database
      $servername = "localhost:3306";
      $username = "root";
      $dbpassword = "";
      $dbname = "clonefb";

      // Membuat koneksi
      $conn = new mysqli($servername, $username, $dbpassword, $dbname);

      // Memeriksa koneksi
      if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
      }

      $sql = "INSERT INTO users (first_name, last_name, email, password, birth_date, gender)
                    VALUES ('$firstName', '$lastName', '$email', '$password', '$birthDate', '$gender')";

      if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman login.php setelah registrasi berhasil
        header("Location: login.php?success_message=Registrasi berhasil, silahkan login");
        exit(); // Pastikan untuk keluar dari skrip setelah melakukan redirect
      } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
      }

      $conn->close();
    }
  }
  ?>
  <div class="flex flex-col justify-center items-center min-h-[90vh] w-[90vw] mx-auto">
    <div class="mb-2">
      <img src="./public/facebook.svg" alt="Facebook Logo" class="w-72" />
    </div>
    <!-- Register Container -->
    <div class="bg-white px-4 py-3 border-2 rounded-lg shadow-xl min-w-[26rem] max-w-md mb-8">
      <h1 class="text-2xl text-center text-neutral-700 font-bold">Buat Akun Baru</h1>
      <h2 class="text-md text-center text-neutral-500">Ini cepat dan mudah</h2>
      <hr class="border-neutral-300 my-3 w-full" />
      <?php
      if (!empty($error_message)) {
        echo "<div class='bg-red-200 text-red-800 p-4 mb-4 rounded-md text-center'>$error_message</div>";
      } elseif (!empty($success_message)) {
        echo "<div class='bg-green-200 text-green-800 p-4 mb-4 rounded-md text-center'>$success_message</div>";
      }
      ?>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="mb-3 flex gap-2">
          <input type="text" name="first_name" id="first_name" placeholder="Nama depan" required class="mt-1 block w-1/2 px-3 py-2 border border-neutral-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" />
          <input type="text" name="last_name" id="last_name" placeholder="Nama belakang" required class="mt-1 block w-1/2 px-3 py-2 border border-neutral-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" />
        </div>
        <div class="mb-3">
          <input type="text" name="email" id="email" placeholder="Nomor seluler atau email" required class="mt-1 block w-full px-3 py-2 border border-neutral-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" />
        </div>
        <div class="mb-3">
          <input type="password" name="password" id="password" placeholder="Kata sandi baru" required class="mt-1 block w-full px-3 py-2 border border-neutral-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" />
        </div>
        <div class="mb-3">
          <label for="birthdate" class="block text-sm text-gray-700">Tanggal Lahir</label>
          <div class="flex gap-2 mt-1">
            <select name="birthdate_day" id="birthdate_day" class="w-1/3 px-3 py-2 border border-neutral-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
              <?php for ($i = 1; $i <= 31; $i++) : ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
            <select name="birthdate_month" id="birthdate_month" class="w-1/3 px-3 py-2 border border-neutral-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
              <?php
              $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
              foreach ($months as $index => $month) : ?>
                <option value="<?php echo $index + 1; ?>"><?php echo $month; ?></option>
              <?php endforeach; ?>
            </select>
            <select name="birthdate_year" id="birthdate_year" class="w-1/3 px-3 py-2 border border-neutral-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
              <?php
              $currentYear = date("Y");
              for ($i = $currentYear; $i >= $currentYear - 100; $i--) : ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
        </div>
        <div class="mb-4 gap-2">
          <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
          <div class="flex gap-2 mt-1">
            <label class="flex w-1/3 min-w-[8rem] px-3 py-1 border border-neutral-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 justify-between items-center">
              <span>Perempuan</span>
              <input type="radio" name="gender" value="female" class="form-radio" required />
            </label>
            <label class="flex w-1/3 min-w-[8rem] px-3 py-1 border border-neutral-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 justify-between items-center">
              <span>Laki-laki</span>
              <input type="radio" name="gender" value="male" class="form-radio" required />
            </label>
            <label class="flex w-1/3 min-w-[8rem] px-3 py-1 border border-neutral-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 justify-between items-center">
              <span>Khusus</span>
              <input type="radio" name="gender" value="other" class="form-radio" required />
            </label>
          </div>
        </div>
        <div class="mb-4 text-xs text-gray-600">Orang yang menggunakan layanan kami dapat mengunggah informasi kontak Anda ke Facebook. <a class="text-blue-800 hover:underline">Pelajari selengkapnya</a></div>
        <div class="mb-4 text-xs text-gray-600">
          Dengan mengklik Daftar, Anda menyetujui <a class="text-blue-800 hover:underline">Ketentuan</a>, <a class="text-blue-800 hover:underline">Kebijakan Privasi</a>, dan
          <a class="text-blue-800 hover:underline">Kebijakan Cookie</a> kami. Anda akan menerima Notifikasi SMS dari kami dan bisa berhenti kapan saja.
        </div>
        <div class="flex items-center justify-center mb-4">
          <button type="submit" class="w-[12rem] py-1 px-4 mb-2 bg-green-700 text-white hover:text-gray-200 text-xl font-bold rounded-md hover:bg-green-700 focus:outline-none focus:bg-green-700">Daftar</button>
        </div>
        <div class="text-center mb-3">
          <a href="login.php" class="text-blue-500 hover:underline text-md">Sudah memiliki akun?</a>
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