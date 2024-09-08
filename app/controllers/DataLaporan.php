<?php

class DataLaporan extends Controller
{
    // Menyimpan path untuk layout dan tampilan admin
    private $layouts = "backend/layouts/";
    private $admin = "backend/admin/";
    private $table = "laporan";
    private $model;

    // Konstruktor untuk memanggil model Laporan
    public function __construct()
    {
        $this->model = $this->model("Laporan_model");
    }

    // Fungsi untuk menampilkan halaman daftar laporan
    public function index()
    {
        session_start();

        // Memeriksa apakah pengguna sudah login
        if (!isset($_SESSION['login']) || $_SESSION['login'] != "berhasil") {
            header("Location: " . Routes::base('admin/auth'));
            exit();
        }

        // Mengambil data laporan dari model dan menyiapkan data untuk view
        $data['title'] = 'Laporan';
        $data['target'] = 'laporan';
        $data['user'] = $_SESSION['user'];
        $data['laporan'] = $this->model->getAllData();
        $data['breadcrumb'] = [
            'Dashboard' => "admin",
            'Laporan' => [
                'link' => "laporan",
                'status' => "active"
            ]
        ];

        // Memuat tampilan
        $this->view($this->layouts . 'header', $data);
        $this->view($this->layouts . 'loader');
        $this->view($this->layouts . 'navbar', $data);
        $this->view($this->admin . 'laporan/index', $data);
        $this->view($this->layouts . 'footer');
    }

    // Fungsi untuk menampilkan detail laporan berdasarkan slug
    public function detail($slug)
    {
        session_start();

        // Memeriksa apakah pengguna sudah login
        if (!isset($_SESSION['login']) || $_SESSION['login'] != "berhasil") {
            header("Location: " . Routes::base('admin/auth'));
            exit();
        }

        // Mengambil detail laporan berdasarkan slug
        $data['title'] = 'Laporan';
        $data['target'] = 'laporan';
        $data['user'] = $_SESSION['user'];
        $data['laporan'] = $this->model->getDataBySlug($slug[0]);
        $data['breadcrumb'] = [
            'Dashboard' => "admin",
            'Laporan' => "dataLaporan",
            'Detail' => [
                'link' => "laporan",
                'status' => "active"
            ]
        ];

        // Memuat tampilan detail laporan
        $this->view($this->layouts . 'header', $data);
        $this->view($this->layouts . 'loader');
        $this->view($this->layouts . 'navbar', $data);
        $this->view($this->admin . 'laporan/detail', $data);
        $this->view($this->layouts . 'footer');
    }

    // Fungsi untuk memperbarui status laporan
    public function status()
    {
        session_start();

        // Memeriksa apakah pengguna sudah login
        if (!isset($_SESSION['login']) || $_SESSION['login'] != "berhasil") {
            header("Location: " . Routes::base('admin/auth'));
            exit();
        }

        // Mengambil data dari POST untuk memperbarui status
        $slug = $_POST['slug'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $status = $_POST['status'] ?? null;

            // Memastikan ID dan status ada sebelum melakukan update
            if ($id && $status !== null) {
                if ($this->model->updateStatus($id, $status)) {
                    $_SESSION['id'] = $id;
                    $_SESSION['berhasil'] = "Status laporan berhasil diperbarui";
                    header("Location: " . Routes::base('dataLaporan/detail/' . $slug));
                    exit();
                } else {
                    $_SESSION['gagal'] = "Gagal memperbarui status laporan";
                    header("Location: " . Routes::base('dataLaporan/detail/' . $slug));
                    exit();
                }
            } else {
                $_SESSION['gagal'] = "Data tidak lengkap.";
                header("Location: " . Routes::base('dataLaporan/detail/' . $slug));
                exit();
            }
        } else {
            $_SESSION['gagal'] = "Permintaan tidak valid.";
            header("Location: " . Routes::base('dataLaporan/detail/' . $slug));
            exit();
        }
    }

    // Fungsi untuk menambahkan laporan baru
    public function add()
    {
        session_start();

        // Debugging data POST dan FILES
        die(var_dump($_POST) . var_dump($_FILES));

        // Memeriksa apakah pengguna sudah login
        if (!isset($_SESSION['login']) || $_SESSION['login'] != "berhasil") {
            header("Location: " . Routes::base('admin/auth'));
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'idPengguna' => htmlspecialchars($_POST['idPengguna']),
                'isiLaporan' => htmlspecialchars($_POST['isiLaporan']),
                'tglLapor' => htmlspecialchars($_POST['tglLapor']),
                'jamLapor' => htmlspecialchars($_POST['jamLapor']),
                'jenisLaporan' => htmlspecialchars($_POST['jenisLaporan']),
                'status' => htmlspecialchars($_POST['status']),
                'kecamatan' => htmlspecialchars($_POST['kecamatan']),
                'kelurahan' => htmlspecialchars($_POST['kelurahan'])
            ];

            // Proses upload gambar
            $fotos = [];
            if (isset($_FILES['fotos']) && is_array($_FILES['fotos']['name'])) {
                $file_count = count($_FILES['fotos']['name']);
                for ($i = 0; $i < $file_count; $i++) {
                    if ($_FILES['fotos']['error'][$i] === UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES['fotos']['tmp_name'][$i];
                        $name = basename($_FILES['fotos']['name'][$i]);
                        $upload_dir = __DIR__ . "/../../public/storage/images/tanggapan/";
                        $upload_file = $upload_dir . $name;

                        if (move_uploaded_file($tmp_name, $upload_file)) {
                            $fotos[] = $upload_file;
                        }
                    }
                }
            }

            // Menambahkan data laporan ke database
            if ($this->model->addData($data, $fotos)) {
                $_SESSION['berhasil'] = "Laporan berhasil ditambahkan";
                header("Location: " . Routes::base('dataLaporan'));
                exit();
            } else {
                $_SESSION['gagal'] = "Gagal menambahkan laporan";
                header("Location: " . Routes::base('dataLaporan'));
                exit();
            }
        } else {
            $_SESSION['gagal'] = "Permintaan tidak valid.";
            header("Location: " . Routes::base('dataLaporan'));
            exit();
        }
    }

    // Fungsi untuk memperbarui data laporan
    public function update()
    {
        session_start();

        // Memeriksa apakah pengguna sudah login
        if (!isset($_SESSION['login']) || $_SESSION['login'] != "berhasil") {
            header("Location: " . Routes::base('admin/auth'));
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            // Validasi jika ID tidak ditemukan
            if (!$id) {
                $_SESSION['gagal'] = "ID tidak ditemukan";
                header("Location: " . Routes::base('dataLaporan'));
                exit();
            }

            // Mengambil data laporan berdasarkan ID
            $laporan = $this->model->getById($id);
            if (!$laporan) {
                $_SESSION['gagal'] = "Laporan tidak ditemukan.";
                header("Location: " . Routes::base('dataLaporan'));
                exit();
            }

            $data = [
                'idPengguna' => htmlspecialchars($_POST['idPengguna']),
                'isiLaporan' => htmlspecialchars($_POST['isiLaporan']),
                'tglLapor' => htmlspecialchars($_POST['tglLapor']),
                'jamLapor' => htmlspecialchars($_POST['jamLapor']),
                'jenisLaporan' => htmlspecialchars($_POST['jenisLaporan']),
                'status' => htmlspecialchars($_POST['status']),
                'kecamatan' => htmlspecialchars($_POST['kecamatan']),
                'kelurahan' => htmlspecialchars($_POST['kelurahan'])
            ];

            // Proses upload gambar
            $fotos = [];
            if (isset($_FILES['fotos']) && is_array($_FILES['fotos']['name'])) {
                $file_count = count($_FILES['fotos']['name']);
                for ($i = 0; $i < $file_count; $i++) {
                    if ($_FILES['fotos']['error'][$i] === UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES['fotos']['tmp_name'][$i];
                        $name = basename($_FILES['fotos']['name'][$i]);
                        $upload_dir = 'uploads/';
                        $upload_file = $upload_dir . $name;

                        if (move_uploaded_file($tmp_name, $upload_file)) {
                            $fotos[] = $upload_file;
                        }
                    }
                }
            }

            // Memperbarui data laporan di database
            if ($this->model->updateData($id, $data, $fotos)) {
                $_SESSION['berhasil'] = "Laporan berhasil diperbarui";
                header("Location: " . Routes::base('dataLaporan'));
                exit();
            } else {
                $_SESSION['gagal'] = "Gagal memperbarui laporan";
                header("Location: " . Routes::base('dataLaporan'));
                exit();
            }
        } else {
            $_SESSION['gagal'] = "Permintaan tidak valid.";
            header("Location: " . Routes::base('dataLaporan'));
            exit();
        }
    }

    // Fungsi untuk menghapus laporan
    public function delete()
    {
        session_start();

        // Memeriksa apakah pengguna sudah login
        if (!isset($_SESSION['login']) || $_SESSION['login'] != "berhasil") {
            header("Location: " . Routes::base('admin/auth'));
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            // Validasi jika ID tidak ditemukan
            if (!$id) {
                $_SESSION['gagal'] = "ID tidak ditemukan";
                header("Location: " . Routes::base('dataLaporan'));
                exit();
            }

            // Mengambil data laporan berdasarkan ID
            $laporan = $this->model->getById($id);
            if (!$laporan) {
                $_SESSION['gagal'] = "Laporan tidak ditemukan.";
                header("Location: " . Routes::base('dataLaporan'));
                exit();
            }

            // Menghapus laporan
            if ($this->model->deleteData($id)) {
                $_SESSION['berhasil'] = "Laporan berhasil dihapus";
                header("Location: " . Routes::base('dataLaporan'));
                exit();
            } else {
                $_SESSION['gagal'] = "Gagal menghapus laporan";
                header("Location: " . Routes::base('dataLaporan'));
                exit();
            }
        } else {
            $_SESSION['gagal'] = "Permintaan tidak valid.";
            header("Location: " . Routes::base('dataLaporan'));
            exit();
        }
    }
}
