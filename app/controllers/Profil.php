<?php

/**
 * Kelas Profil
 *
 * Kelas ini menangani tampilan profil pengguna.
 */
class Profil extends Controller
{
    /**
     * Memeriksa sesi pengguna untuk memastikan pengguna terautentikasi.
     */
    private function checkSession()
    {
        session_start();

        if (!isset($_SESSION['login']) || $_SESSION['login'] !== "berhasil") {
            header("Location: " . Routes::base('masuk'));
            exit();
        }
    }

    /**
     * Menampilkan halaman profil pengguna.
     */
    function index()
    {
        $this->checkSession();

        if (isset($_SESSION['login'])) {
            $data['user'] = $_SESSION['user'];
        } else {
            $data = [];
        }

        // Menampilkan berbagai komponen halaman
        $this->view("frontend/layouts/header", $data);
        $this->view("frontend/layouts/navbar", $data);
        $this->view("frontend/profil/index", $data);
        $this->view("frontend/layouts/footer");
        $this->view("frontend/layouts/script");
    }
}
