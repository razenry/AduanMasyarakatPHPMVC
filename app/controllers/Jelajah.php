<?php

class Jelajah extends Controller
{
    // Fungsi untuk memulai sesi
    private function checkSession()
    {
        session_start();
    }

    // Fungsi utama untuk menampilkan halaman jelajah
    function index()
    {
        // Memastikan sesi aktif
        $this->checkSession();

        // Memeriksa apakah pengguna sudah login
        if (isset($_SESSION['login'])) {
            $data['user'] = $_SESSION['user'];
        } else {
            $data = [];
        }

        // Jika ada pencarian, simpan kata kunci dan arahkan ke halaman pencarian
        if (isset($_POST['cari'])) {
            $key = $_POST['judul'];
            $_SESSION['cari'] = $key;
            $key = str_replace(' ', '+', $key); // Ganti spasi dengan '+'
            header("Location: " . Routes::base("jelajah/cari/" . $key));
            exit(); // Hentikan eksekusi setelah redirection
        }

        // Jika ada filter kecamatan, simpan kecamatan dan arahkan ke halaman filter
        if (isset($_POST['filter'])) {
            $key = $_POST['kecamatan'];
            $_SESSION['filter'] = $key;
            $key = str_replace(' ', '+', $key); // Ganti spasi dengan '+'
            header("Location: " . Routes::base("jelajah/filter/" . $key));
            exit(); // Hentikan eksekusi setelah redirection
        }

        // Mengambil laporan dengan status 'Tuntas' dari model
        $data['laporan'] = $this->model("Laporan_model")->getDataByStatus("Tuntas");
        $data['jml_laporan'] = $this->model("Laporan_model")->countLaporan();

        // Memuat view dengan data yang sudah disiapkan
        $this->view("frontend/layouts/header", $data);
        $this->view("frontend/layouts/navbar", $data);
        $this->view("frontend/jelajah/index", $data);
        $this->view("frontend/layouts/footer");
        $this->view("frontend/layouts/script");
    }

    // Fungsi untuk menangani pencarian laporan berdasarkan judul
    public function cari($url)
    {
        // Memulai sesi
        $this->checkSession();

        // Mengambil data pencarian dari sesi
        $key = isset($_SESSION['cari']) ? $_SESSION['cari'] : '';

        // Menghapus kata kunci pencarian dari sesi setelah digunakan
        unset($_SESSION['cari']);

        // Validasi apakah kata kunci adalah string
        if (!is_string($key)) {
            $key = '';
        }

        // Mengamankan keluaran dengan htmlspecialchars
        $key = htmlspecialchars($key);

        // Mengambil laporan berdasarkan kecamatan dan status 'Tuntas'
        $laporanModel = $this->model('Laporan_model');
        $laporan = $laporanModel->cariLaporanByKecamatanAndStatus($key);

        // Menyiapkan data untuk ditampilkan di view
        $data['laporan'] = $laporan;
        $data['judul'] = $key;
        $data['laporan_tampil'] = "semua";
        $data['user'] = $_SESSION['user'];
        $data['jml_laporan'] = $this->model("Laporan_model")->countLaporan();

        // Memuat view dengan data yang sudah disiapkan
        $this->view("frontend/layouts/header", $data);
        $this->view("frontend/layouts/navbar", $data);
        $this->view("frontend/jelajah/index", $data);
        $this->view("frontend/layouts/footer");
        $this->view("frontend/layouts/script");
    }

    // Fungsi untuk menangani filter laporan berdasarkan kecamatan
    public function filter($key)
    {
        // Memulai sesi
        $this->checkSession();

        // Mengambil data filter dari sesi
        $key = isset($_SESSION['filter']) ? $_SESSION['filter'] : '';

        // Menghapus filter dari sesi setelah digunakan
        unset($_SESSION['filter']);

        // Validasi apakah kata kunci adalah string
        if (!is_string($key)) {
            $key = '';
        }

        // Mengamankan keluaran dengan htmlspecialchars
        $key = htmlspecialchars($key);

        // Mengambil laporan berdasarkan kecamatan dan status 'Tuntas'
        $laporanModel = $this->model('Laporan_model');
        $laporan = $laporanModel->cariLaporanByKecamatanAndStatus($key);

        // Menyiapkan data untuk ditampilkan di view
        $data['laporan'] = $laporan;
        $data['kecamatan'] = $key;
        $data['laporan_tampil'] = "filter";
        $data['user'] = isset($_SESSION['user']) ? $_SESSION['user'] : null;
        $data['jml_laporan'] = $this->model("Laporan_model")->countLaporan();

        // Memuat view dengan data yang sudah disiapkan
        $this->view("frontend/layouts/header", $data);
        $this->view("frontend/layouts/navbar", $data);
        $this->view("frontend/jelajah/index", $data);
        $this->view("frontend/layouts/footer");
        $this->view("frontend/layouts/script");
    }
}
