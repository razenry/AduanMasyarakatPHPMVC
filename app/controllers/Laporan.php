<?php

/**
 * Class Laporan
 * 
 * Controller untuk mengelola laporan, termasuk menampilkan, menambah, mencari, dan menghapus laporan.
 */
class Laporan extends Controller
{
    /**
     * Memeriksa sesi pengguna untuk memastikan mereka sudah login.
     * 
     * Jika pengguna tidak login, akan diarahkan ke halaman masuk.
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
     * Menampilkan halaman utama laporan.
     * 
     * Jika ada pencarian, akan mengarahkan ke halaman pencarian.
     */
    function index()
    {
        $this->checkSession();

        // Menyiapkan data pengguna jika sudah login
        if (isset($_SESSION['login'])) {
            $data['user'] = $_SESSION['user'];
        } else {
            $data = [];
        }

        // Menangani pencarian laporan
        if (isset($_POST['cari'])) {
            $key = $_POST['judul'];
            $_SESSION['cari'] = $key; // Simpan kata kunci pencarian di session
            $key = str_replace(' ', '+', $key); // Ganti spasi dengan '+'
            header("Location: " . Routes::base("laporan/cari/" . $key));
            exit(); // Pastikan tidak ada kode lain yang dieksekusi setelah redirection
        }

        // Menampilkan tampilan dengan data yang disiapkan
        $this->view("frontend/layouts/header", $data);
        $this->view("frontend/layouts/navbar", $data);
        $this->view("frontend/laporan/index", $data);
        $this->view("frontend/layouts/footer");
        $this->view("frontend/layouts/script");
    }

    /**
     * Menambahkan laporan baru.
     * 
     * Menggunakan metode POST untuk menerima data laporan dan foto.
     */
    public function add()
    {
        $this->checkSession();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $laporanModel = $this->model('Laporan_model');

            // Menyiapkan data laporan
            $data = [
                'slug' => $laporanModel->generateUniqueSlug(),
                'id_pengguna' => $_SESSION['user']['id'],
                'judul' => htmlspecialchars($_POST['judul']),
                'isi_laporan' => htmlspecialchars($_POST['isi_laporan']),
                'kecamatan' => htmlspecialchars($_POST['kecamatan']),
                'kelurahan' => htmlspecialchars($_POST['kelurahan']),
                'jenis_laporan' => htmlspecialchars($_POST['jenis_laporan'] ?? 'publik'),
                'tgl_laporan' => date('Y-m-d'),
                'jam_lapor' => date('H:i:s'),
                'status' => 'Menunggu tanggapan',
                'fotos' => []
            ];

            // Menangani upload foto
            if (isset($_FILES['foto'])) {
                $files = $_FILES['foto'];

                for ($i = 0; $i < count($files['name']); $i++) {
                    $fileName = 'laporan-' . uniqid() . '-' . date("Y-m-d")  . '-' . basename($files['name'][$i]);
                    $fileTmpName = $files['tmp_name'][$i];

                    $uploadFileDir = __DIR__ . "/../../public/storage/images/laporan/";
                    $fileDestination = $uploadFileDir . $fileName;

                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        $data['fotos'][] = $fileName;
                    }
                }
            }

            // Menyimpan data laporan ke database
            if ($laporanModel->addData($data)) {
                header("Location: " . Routes::base('laporanku'));
                exit();
            } else {
                echo "Terjadi kesalahan saat menyimpan laporan.";
            }
        }
    }

    /**
     * Mencari laporan berdasarkan kata kunci.
     * 
     * @param array $url Parameter yang digunakan untuk pencarian.
     */
    public function cari($url)
    {
        $this->checkSession();

        // Mengambil data pencarian dari session
        $key = isset($_SESSION['cari']) ? $_SESSION['cari'] : '';

        // Hapus pencarian dari session setelah digunakan
        unset($_SESSION['cari']);

        // Validasi bahwa $key adalah string
        if (!is_string($key)) {
            $key = '';
        }

        $key = htmlspecialchars($key); // Pastikan output aman
        $idPengguna = $_SESSION['user']['id'];

        $laporanModel = $this->model('Laporan_model');
        $laporan = $laporanModel->cariLaporan($key, $idPengguna);

        // Menyiapkan data untuk tampilan
        $data['laporan'] = $laporan;
        $data['judul'] = $key;
        $data['laporan_tampil'] = "semua";
        $data['user'] = $_SESSION['user'];

        // Menampilkan tampilan dengan data yang disiapkan
        $this->view("frontend/layouts/header", $data);
        $this->view("frontend/layouts/navbar", $data);
        $this->view("frontend/laporanku/index", $data);
        $this->view("frontend/layouts/footer");
        $this->view("frontend/layouts/script");
    }

    /**
     * Menghapus laporan berdasarkan slug.
     * 
     * @param array $slug Parameter yang digunakan untuk mengidentifikasi laporan yang akan dihapus.
     */
    public function delete($slug)
    {
        $this->checkSession();

        $laporanModel = $this->model('Laporan_model');
        $laporan = $laporanModel->getDataBySlug($slug[0]);

        if ($laporan) {
            // Menghapus data laporan dari database
            if ($laporanModel->deleteData($laporan['id'])) {
                $_SESSION['berhasil'] = "Berhasil menghapus laporan";
                header("Location: " . Routes::base('laporanku'));
                exit();
            } else {
                echo "Terjadi kesalahan saat menghapus laporan.";
            }
        } else {
            echo "Laporan tidak ditemukan.";
        }
    }
}
