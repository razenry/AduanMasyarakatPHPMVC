<?php

/**
 * Class Home
 * 
 * Controller untuk mengelola halaman utama, error, dan logout.
 */
class Home extends Controller
{
    // Direktori layout, admin, dan home
    private $layouts = "frontend/layouts/";
    private $admin = "backend/";
    private $home = "frontend/";

    /**
     * Menampilkan halaman utama.
     */
    function index()
    {
        // Memulai sesi pengguna
        session_start();

        // Menyiapkan data pengguna jika sudah login
        if (isset($_SESSION['login'])) {
            $data['user'] = $_SESSION['user'];
        } else {
            $data = [];
        }

        // Mengambil jumlah laporan dan pengguna
        $data['jml_laporan'] = $this->model("Laporan_model")->countLaporan();
        $data['jml_pengguna'] = $this->model("User_model")->countUsers();

        // Menampilkan tampilan dengan data yang disiapkan
        $this->view("frontend/layouts/header", $data);
        $this->view("frontend/layouts/navbar", $data);
        $this->view("frontend/beranda/index", $data);
        $this->view("frontend/layouts/footer");
        $this->view("frontend/layouts/script");
    }

    /**
     * Menampilkan halaman error.
     */
    public function error()
    {
        // Memulai sesi pengguna
        session_start();
        $data = [];

        // Menampilkan tampilan error
        $this->view($this->layouts . 'header', $data);
        $this->view($this->home . 'error/index');
        $this->view($this->layouts . 'script');
    }

    /**
     * Menghentikan sesi pengguna dan melakukan logout.
     */
    public function logout()
    {
        // Memulai sesi pengguna
        session_start();
        session_unset();
        session_destroy();

        // Mengarahkan ke halaman home setelah logout
        header("Location: " . Routes::base('home'));
        exit();
    }
}
