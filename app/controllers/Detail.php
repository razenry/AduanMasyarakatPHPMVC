<?php

/**
 * Class Detail
 * 
 * Controller untuk menampilkan detail laporan berdasarkan slug.
 */
class Detail extends Controller
{
    /**
     * Memulai sesi pengguna.
     * 
     * Fungsi ini digunakan untuk memulai sesi pengguna pada setiap permintaan.
     */
    private function checkSession()
    {
        session_start();
    }

    /**
     * Menampilkan halaman detail laporan.
     * 
     * @param array $slug Parameter yang digunakan untuk mengambil data laporan berdasarkan slug.
     */
    function index($slug)
    {
        // Memulai sesi pengguna
        $this->checkSession();

        // Menyiapkan data pengguna jika sudah login
        if (isset($_SESSION['login'])) {
            $data['user'] = $_SESSION['user'];
        } else {
            $data = [];
        }

        // Mengambil data laporan berdasarkan slug
        $data['laporan'] = $this->model("Laporan_model")->getDataBySlug($slug[0]);

        // Menampilkan tampilan dengan data yang disiapkan
        $this->view("frontend/layouts/header", $data);
        $this->view("frontend/layouts/navbar", $data);
        $this->view("frontend/detail/index", $data);
        $this->view("frontend/layouts/footer");
        $this->view("frontend/layouts/script");
    }
}
