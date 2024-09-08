<?php

class Daftar extends Controller
{
    // Menyimpan nama tabel 'pengguna' yang akan digunakan dalam model
    private $table = "pengguna";

    // Fungsi untuk menampilkan halaman registrasi
    function index()
    {
        session_start();

        // Jika pengguna sudah login, arahkan ke halaman beranda
        if (isset($_SESSION['login']) || isset($_SESSION['login']) == "berhasil") {
            header("Location: " . Routes::base('beranda'));
            exit();
        }

        // Memuat view halaman registrasi
        $this->view("frontend/layouts/header");
        $this->view("frontend/auth/register");
        $this->view("frontend/layouts/script");
    }

    // Fungsi untuk membuat akun baru
    public function buatAkun()
    {
        session_start();

        // Jika pengguna sudah login, arahkan ke halaman beranda
        if (isset($_SESSION['login']) || isset($_SESSION['login']) == "berhasil") {
            header("Location: " . Routes::base('beranda'));
            exit();
        }

        var_dump($_POST); // Debugging: menampilkan data POST

        // Memeriksa apakah metode permintaan adalah POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = htmlspecialchars($_POST['email']) ?? ''; // Sanitasi input email

            // Memeriksa apakah email sudah terdaftar
            if ($this->model("User_model")->isEmailExist($email)) {
                $_SESSION['gagal'] = "Email " . $email . " sudah terdaftar.";
                header("Location: " . Routes::base('daftar'));
                exit();
            }

            // Validasi dan persiapan data yang akan disimpan
            $data = [
                'nama' => htmlspecialchars($_POST['nama']) ?? '',
                'email' => $email,
                'password' => password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT) ?? '', // Hash password
                'telp' => htmlspecialchars($_POST['telp']) ?? '',
                'status' => htmlspecialchars($_POST['status']) ?? '1', // Set status pengguna aktif secara default
                'foto' => $this->uploadImage('foto') // Proses upload gambar
            ];

            // Cek apakah nama dan email tidak kosong, jika ya, tambahkan data ke database
            if (!empty($data['nama']) && !empty($data['email'])) {
                if ($this->model("User_model")->addData($data, $this->table)) {
                    $_SESSION['berhasil'] = "Pengguna " . $data['nama'] . " Berhasil Ditambahkan";
                    header("Location: " . Routes::base('masuk'));
                    exit();
                } else {
                    $_SESSION['gagal'] = "Pengguna " . $data['nama'] . " Gagal Ditambahkan";
                    header("Location: " . Routes::base('masuk'));
                    exit();
                }
            } else {
                $_SESSION['gagal'] = "Data tidak valid. Nama dan Email wajib diisi.";
                header("Location: " . Routes::base('masuk'));
                exit();
            }
        } else {
            $_SESSION['gagal'] = "Permintaan tidak valid.";
            header("Location: " . Routes::base('masuk'));
            exit();
        }
    }

    // Fungsi untuk mengupload gambar pengguna
    private function uploadImage($inputName)
    {
        session_start();

        // Direktori upload untuk menyimpan gambar pengguna
        $uploadFileDir = __DIR__ . "/../../public/storage/images/users/";

        // Path file default jika tidak ada gambar yang diunggah
        $defaultImagePath = "/../../public/storage/images/users/default-user.png";

        // Jika file gambar diunggah dan tidak ada error
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES[$inputName]['tmp_name'];
            $fileName = $_FILES[$inputName]['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Ekstensi file yang diizinkan
            $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($fileExtension, $allowedExts)) {
                // Membuat nama file baru dengan string acak dan timestamp
                $randomString = bin2hex(random_bytes(5));
                $timestamp = time();
                $newFileName = 'user-' . $timestamp . '_' . $randomString . '.' . $fileExtension;

                // Path tujuan untuk menyimpan file
                $destPath = $uploadFileDir . $newFileName;

                // Membuat direktori jika belum ada
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }

                // Memindahkan file yang diunggah ke direktori tujuan
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    return $newFileName; // Mengembalikan nama file baru
                } else {
                    error_log('Gagal memindahkan file ke ' . $destPath);
                }
            } else {
                error_log('Ekstensi file tidak diizinkan: ' . $fileExtension);
            }
        }

        // Jika tidak ada file yang diupload, atau gagal, gunakan gambar default
        $randomString = bin2hex(random_bytes(5)); // Generate string acak
        $timestamp = time();
        $newDefaultFileName = 'default-' . $timestamp . '_' . $randomString . '.png';

        // Path tujuan untuk menggandakan file default
        $newDefaultFilePath = $uploadFileDir . $newDefaultFileName;

        // Menyalin file default ke path baru dengan nama baru
        if (copy($defaultImagePath, $newDefaultFilePath)) {
            return $newDefaultFileName; // Mengembalikan nama file default yang baru
        } else {
            error_log('Gagal menggandakan file default ke ' . $newDefaultFilePath);
            return 'default-user.png'; // Jika gagal menggandakan, gunakan nama default asli
        }
    }
}
