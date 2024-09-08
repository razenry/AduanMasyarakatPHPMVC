<?php

/**
 * Kelas Masuk
 *
 * Kelas ini menangani proses login, logout, dan penanganan kesalahan.
 */
class Masuk extends Controller
{
    private $layouts = "frontend/layouts/";
    private $admin = "backend/";
    private $home = "frontend/";

    /**
     * Menampilkan halaman login.
     */
    function index()
    {
        $this->view("frontend/layouts/header");
        $this->view("frontend/auth/login");
        $this->view("frontend/layouts/script");
    }

    /**
     * Mengautentikasi pengguna berdasarkan email dan password yang dikirim melalui POST.
     */
    public function auth()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Mengambil data pengguna berdasarkan email
            $user = $this->model('User_model')->getPengguna($email);

            if ($user && password_verify($password, $user['password'])) {
                // Verifikasi status akun
                if ($user['status'] == 1) {
                    // Akun aktif, lanjutkan login
                    $_SESSION['login'] = "berhasil";
                    $_SESSION['user'] = $user;
                    $_SESSION['berhasil_login'] = "Selamat datang $email";

                    header("Location: " . Routes::base('home'));
                    exit();
                } else {
                    // Akun tidak aktif, kirim pesan kesalahan
                    $_SESSION['gagal'] = "Akun Anda tidak aktif. Hubungi administrator.";
                    header("Location: " . Routes::base('masuk'));
                    exit();
                }
            } else {
                $_SESSION['gagal'] = "Gagal login. Email atau password salah.";
                header("Location: " . Routes::base('masuk') . "?error=Invalid");
                exit();
            }
        } else {
            $_SESSION['gagal'] = "Gagal login. Harap coba lagi.";
            header("Location: " . Routes::base('masuk'));
            exit();
        }
    }

    /**
     * Mengakhiri sesi pengguna dan mengarahkan ke halaman login.
     */
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: " . Routes::base('masuk'));
        exit();
    }

    /**
     * Menampilkan halaman kesalahan.
     */
    public function error()
    {
        session_start();

        $data['title'] = $_SESSION['pesan']['judul'];

        $this->view($this->layouts . 'header', $data);
        $this->view($this->admin . 'error/index');
        $this->view($this->layouts . 'footer');
    }
}
