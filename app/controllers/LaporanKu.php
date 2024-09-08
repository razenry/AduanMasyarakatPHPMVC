<?php

/**
 * Kelas LaporanKu
 *
 * Kelas ini menangani berbagai operasi terkait laporan pengguna, termasuk 
 * menampilkan laporan berdasarkan status, dan mengubah jenis laporan.
 */
class LaporanKu extends Controller
{
    /**
     * Memeriksa apakah sesi pengguna sudah aktif.
     * Jika tidak, redirect ke halaman login.
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
     * Menampilkan semua laporan milik pengguna.
     */
    function index()
    {
        $this->checkSession();

        if (isset($_SESSION['login'])) {
            $data['user'] = $_SESSION['user'];
        } else {
            $data = [];
        }

        $data['laporan_tampil'] = "semua";
        $idUser = $data['user']['id'];
        $modelLaporan = $this->model("Laporan_model");
        $data['laporan'] = $modelLaporan->getDataByUserId($idUser);

        $this->view("frontend/layouts/header", $data);
        $this->view("frontend/layouts/navbar", $data);
        $this->view("frontend/laporanKu/index", $data);
        $this->view("frontend/layouts/footer");
        $this->view("frontend/layouts/script");
    }

    /**
     * Menampilkan laporan yang sedang menunggu tanggapan.
     */
    function menunggu()
    {
        $this->checkSession();

        if (isset($_SESSION['login'])) {
            $data['user'] = $_SESSION['user'];
        } else {
            $data = [];
        }

        $data['laporan_tampil'] = "menunggu";
        $idUser = $data['user']['id'];
        $modelLaporan = $this->model("Laporan_model");
        $data['laporan'] = $modelLaporan->getLaporanByStatus($idUser, "Menunggu tanggapan");

        $this->view("frontend/layouts/header", $data);
        $this->view("frontend/layouts/navbar", $data);
        $this->view("frontend/laporanKu/index", $data);
        $this->view("frontend/layouts/footer");
        $this->view("frontend/layouts/script");
    }

    /**
     * Menampilkan laporan yang sudah diverifikasi.
     */
    function diverifikasi()
    {
        $this->checkSession();

        if (isset($_SESSION['login'])) {
            $data['user'] = $_SESSION['user'];
        } else {
            $data = [];
        }

        $data['laporan_tampil'] = "diverifikasi";
        $idUser = $data['user']['id'];
        $modelLaporan = $this->model("Laporan_model");
        $data['laporan'] = $modelLaporan->getLaporanByStatus($idUser, "Diverifikasi");

        $this->view("frontend/layouts/header", $data);
        $this->view("frontend/layouts/navbar", $data);
        $this->view("frontend/laporanKu/index", $data);
        $this->view("frontend/layouts/footer");
        $this->view("frontend/layouts/script");
    }

    /**
     * Menampilkan laporan yang sedang dalam tindakan.
     */
    function dalamTindakan()
    {
        $this->checkSession();

        if (isset($_SESSION['login'])) {
            $data['user'] = $_SESSION['user'];
        } else {
            $data = [];
        }

        $data['laporan_tampil'] = "dalamTindakan";
        $idUser = $data['user']['id'];
        $modelLaporan = $this->model("Laporan_model");
        $data['laporan'] = $modelLaporan->getLaporanByStatus($idUser, "Dalam tindakan");

        $this->view("frontend/layouts/header", $data);
        $this->view("frontend/layouts/navbar", $data);
        $this->view("frontend/laporanKu/index", $data);
        $this->view("frontend/layouts/footer");
        $this->view("frontend/layouts/script");
    }

    /**
     * Menampilkan laporan yang sudah selesai/tuntas.
     */
    function tuntas()
    {
        $this->checkSession();

        if (isset($_SESSION['login'])) {
            $data['user'] = $_SESSION['user'];
        } else {
            $data = [];
        }

        $data['laporan_tampil'] = "tuntas";
        $idUser = $data['user']['id'];
        $modelLaporan = $this->model("Laporan_model");
        $data['laporan'] = $modelLaporan->getLaporanByStatus($idUser, "Tuntas");

        $this->view("frontend/layouts/header", $data);
        $this->view("frontend/layouts/navbar", $data);
        $this->view("frontend/laporanKu/index", $data);
        $this->view("frontend/layouts/footer");
        $this->view("frontend/layouts/script");
    }

    /**
     * Menampilkan laporan yang ditolak.
     */
    function ditolak()
    {
        $this->checkSession();

        if (isset($_SESSION['login'])) {
            $data['user'] = $_SESSION['user'];
        } else {
            $data = [];
        }

        $data['laporan_tampil'] = "ditolak";
        $idUser = $data['user']['id'];
        $modelLaporan = $this->model("Laporan_model");
        $data['laporan'] = $modelLaporan->getLaporanByStatus($idUser, "Ditolak");

        $this->view("frontend/layouts/header", $data);
        $this->view("frontend/layouts/navbar", $data);
        $this->view("frontend/laporanKu/index", $data);
        $this->view("frontend/layouts/footer");
        $this->view("frontend/layouts/script");
    }

    /**
     * Menerbitkan laporan menjadi publik.
     *
     * @param array $slug Array yang berisi slug laporan yang akan diterbitkan.
     */
    public function publish($slug)
    {
        $this->checkSession();

        $slug = htmlspecialchars($slug[0]);
        $idPengguna = $_SESSION['user']['id'];
        $jenis_laporan = "publik";

        $laporanModel = $this->model('Laporan_model');
        if ($laporanModel->setJenisLaporan($slug, $idPengguna, $jenis_laporan)) {
            $_SESSION['berhasil'] = "Laporan berhasil di publish";
            header("Location: " . Routes::base('laporanku'));
            exit();
        }
    }

    /**
     * Mengubah jenis laporan menjadi rahasia.
     *
     * @param array $slug Array yang berisi slug laporan yang akan diubah.
     */
    public function rahasia($slug)
    {
        $this->checkSession();

        $slug = htmlspecialchars($slug[0]);
        $idPengguna = $_SESSION['user']['id'];
        $jenis_laporan = "rahasia";
        $laporanModel = $this->model('Laporan_model');

        if ($laporanModel->setJenisLaporan($slug, $idPengguna, $jenis_laporan)) {
            $_SESSION['berhasil'] = "Laporan berhasil di rahasiakan";
            header("Location: " . Routes::base('laporanku'));
            exit();
        }
    }

    /**
     * Mengubah jenis laporan menjadi anonim.
     *
     * @param array $slug Array yang berisi slug laporan yang akan diubah.
     */
    public function anonim($slug)
    {
        $this->checkSession();

        $slug = htmlspecialchars($slug[0]);
        $idPengguna = $_SESSION['user']['id'];
        $jenis_laporan = "anonim";

        $laporanModel = $this->model('Laporan_model');
        if ($laporanModel->setJenisLaporan($slug, $idPengguna, $jenis_laporan)) {
            $_SESSION['berhasil'] = "Laporan diubah menjadi anonim";
            header("Location: " . Routes::base('laporanku'));
            exit();
        }
    }
}
