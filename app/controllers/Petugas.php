<?php

/**
 * Kelas Petugas
 *
 * Kelas ini menangani berbagai operasi terkait petugas seperti menampilkan daftar petugas, menambahkan, memperbarui, menghapus, dan mengubah status petugas.
 */
class Petugas extends Controller
{
    private $layouts = "backend/layouts/";
    private $admin = "backend/admin/";
    private $table = "petugas";
    private $model;

    public function __construct()
    {
        $this->model = $this->model("User_model");
    }

    /**
     * Menampilkan daftar petugas.
     */
    public function index()
    {
        session_start();

        if (!isset($_SESSION['login']) || $_SESSION['login'] !== "berhasil") {
            header("Location: " . Routes::base('admin/auth'));
            exit();
        }

        if ($_SESSION['user']['level'] != "Admin") {
            $_SESSION['gagal'] = "Akses ditolak";
            header("Location: " . Routes::base('admin/auth'));
            exit();
        }

        $data['title'] = 'Petugas';
        $data['target'] = 'petugas';
        $data['user'] = $_SESSION['user'];
        $data['pengguna'] = $this->model->getAllData($this->table);
        $data['breadcrumb'] = [
            'Dashboard' => "admin",
            'Master Data' => "",
            'Petugas' => [
                'link' => "petugas",
                'status' => "active"
            ]
        ];

        $this->view($this->layouts . 'header', $data);
        $this->view($this->layouts . 'loader');
        $this->view($this->layouts . 'navbar', $data);
        $this->view($this->admin . 'user/index', $data);
        $this->view($this->admin . 'user/components/modal', $data);
        $this->view($this->layouts . 'footer');
    }

    /**
     * Menambahkan petugas baru.
     */
    public function add()
    {
        session_start();

        if (!isset($_SESSION['login']) || $_SESSION['login'] !== "berhasil") {
            header("Location: " . Routes::base('admin/auth'));
            exit();
        }

        if ($_SESSION['user']['level'] != "Admin") {
            $_SESSION['gagal'] = "Akses ditolak";
            header("Location: " . Routes::base('admin/auth'));
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars($_POST['email']) ?? '';

            if ($this->model->isEmailExist($email)) {
                $_SESSION['gagal'] = "Email " . $email . " sudah terdaftar.";
                header("Location: " . Routes::base('petugas'));
                exit();
            }

            if (htmlspecialchars($_POST['konfirmasi_password']) !== htmlspecialchars($_POST['password'])) {
                $_SESSION['gagal'] = "Password tidak cocok.";
                header("Location: " . Routes::base('petugas'));
                exit();
            }

            $data = [
                'nama' => htmlspecialchars($_POST['nama']) ?? '',
                'email' => $email,
                'password' => password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT) ?? '',
                'telp' => htmlspecialchars($_POST['telp']) ?? '',
                'status' => htmlspecialchars($_POST['status']) ?? '',
                'level' => htmlspecialchars($_POST['level']) ?? '',
                'foto' => $this->uploadImage('foto')
            ];

            if (!empty($data['nama']) && !empty($data['email'])) {
                if ($this->model->addData($data, $this->table)) {
                    $_SESSION['berhasil'] = "Petugas " . $data['nama'] . " Berhasil Ditambahkan";
                    header("Location: " . Routes::base('petugas'));
                    exit();
                } else {
                    $_SESSION['gagal'] = "Petugas " . $data['nama'] . " Gagal Ditambahkan";
                    header("Location: " . Routes::base('petugas'));
                    exit();
                }
            } else {
                $_SESSION['gagal'] = "Data tidak valid. Nama dan Email wajib diisi.";
                header("Location: " . Routes::base('petugas'));
                exit();
            }
        } else {
            $_SESSION['gagal'] = "Permintaan tidak valid.";
            header("Location: " . Routes::base('petugas'));
            exit();
        }
    }

    /**
     * Memperbarui data petugas.
     */
    public function update()
    {
        session_start();

        if (!isset($_SESSION['login']) || $_SESSION['login'] !== "berhasil") {
            header("Location: " . Routes::base('admin/auth'));
            exit();
        }

        if ($_SESSION['user']['level'] != "Admin") {
            $_SESSION['gagal'] = "Akses ditolak";
            header("Location: " . Routes::base('admin/auth'));
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $email = htmlspecialchars($_POST['email']) ?? '';
            $petugas = $this->model->getById($id, $this->table);

            if (!$petugas) {
                $_SESSION['gagal'] = "Petugas tidak ditemukan.";
                header("Location: " . Routes::base('petugas'));
                exit();
            }

            if ($email == $petugas['email']) {
                $emailToUpdate = $petugas['email'];
            } else {
                if ($this->model->isEmailExist($email)) {
                    $_SESSION['gagal'] = "Email " . $email . " sudah terdaftar.";
                    header("Location: " . Routes::base('petugas'));
                    exit();
                } else {
                    $emailToUpdate = $email;
                }
            }

            if (htmlspecialchars($_POST['konfirmasi_password']) !== htmlspecialchars($_POST['password'])) {
                $_SESSION['gagal'] = "Password tidak cocok.";
                header("Location: " . Routes::base('petugas'));
                exit();
            }

            $image = $this->uploadImage('foto');
            if (!$image) {
                $image = $petugas['foto'];
            } else {
                $oldImagePath = Routes::storage("users/") . $petugas['foto'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $data = [
                'nama' => htmlspecialchars($_POST['nama']) ?? '',
                'email' => $emailToUpdate,
                'password' => !empty($_POST['password']) ? password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT) : $petugas['password'],
                'telp' => htmlspecialchars($_POST['telp']) ?? '',
                'status' => htmlspecialchars($_POST['status']) ?? '',
                'level' => htmlspecialchars($_POST['level']) ?? '',
                'foto' => $image
            ];

            if ($id && !empty($data['nama']) && !empty($data['email'])) {
                if ($this->model->updateData($id, $data, $this->table)) {
                    $_SESSION['berhasil'] = "Petugas " . $data['nama'] . " berhasil diperbarui";
                    header("Location: " . Routes::base('petugas'));
                    exit();
                } else {
                    $_SESSION['gagal'] = "Petugas " . $data['nama'] . " gagal diperbarui";
                    header("Location: " . Routes::base('petugas'));
                    exit();
                }
            } else {
                $_SESSION['gagal'] = "Data tidak valid";
                header("Location: " . Routes::base('petugas'));
                exit();
            }
        } else {
            $_SESSION['gagal'] = "Permintaan tidak valid";
            header("Location: " . Routes::base('petugas'));
            exit();
        }
    }

    /**
     * Menghapus data petugas.
     */
    public function delete()
    {
        session_start();

        if (!isset($_SESSION['login']) || $_SESSION['login'] !== "berhasil") {
            header("Location: " . Routes::base('admin/auth'));
            exit();
        }

        if ($_SESSION['user']['level'] != "Admin") {
            $_SESSION['gagal'] = "Akses ditolak";
            header("Location: " . Routes::base('admin/auth'));
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            $petugas = $this->model->getById($id, $this->table);
            $nama = $petugas['nama'];
            if (!$petugas) {
                $_SESSION['gagal'] = "Petugas $nama tidak ditemukan.";
                header("Location: " . Routes::base('petugas'));
                exit();
            }

            if ($id) {
                if ($this->model->deleteData($id, $this->table)) {
                    $_SESSION['berhasil'] = "Petugas $nama berhasil dihapus";
                    header("Location: " . Routes::base('petugas'));
                    exit();
                } else {
                    $_SESSION['gagal'] = "Petugas $nama gagal dihapus";
                    header("Location: " . Routes::base('petugas'));
                    exit();
                }
            } else {
                $_SESSION['gagal'] = "ID petugas tidak ditemukan.";
                header("Location: " . Routes::base('petugas'));
                exit();
            }
        } else {
            $_SESSION['gagal'] = "Permintaan tidak valid";
            header("Location: " . Routes::base('petugas'));
            exit();
        }
    }

    /**
     * Mengubah status petugas.
     */
    public function status()
    {
        session_start();

        if (!isset($_SESSION['login']) || $_SESSION['login'] !== "berhasil") {
            header("Location: " . Routes::base('admin/auth'));
            exit();
        }

        if ($_SESSION['user']['level'] != "Admin") {
            $_SESSION['gagal'] = "Akses ditolak";
            header("Location: " . Routes::base('admin/auth'));
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $status = $_POST['status'] ?? null;

            $petugas = $this->model->getById($id, $this->table);
            $nama = $petugas['nama'];
            if (!$petugas) {
                $_SESSION['gagal'] = "Petugas $nama tidak ditemukan.";
                header("Location: " . Routes::base('petugas'));
                exit();
            }

            if ($id && $status) {
                $data = ['status' => $status];
                if ($this->model->updateData($id, $data, $this->table)) {
                    $_SESSION['berhasil'] = "Status petugas $nama berhasil diubah";
                    header("Location: " . Routes::base('petugas'));
                    exit();
                } else {
                    $_SESSION['gagal'] = "Status petugas $nama gagal diubah";
                    header("Location: " . Routes::base('petugas'));
                    exit();
                }
            } else {
                $_SESSION['gagal'] = "Data tidak valid";
                header("Location: " . Routes::base('petugas'));
                exit();
            }
        } else {
            $_SESSION['gagal'] = "Permintaan tidak valid";
            header("Location: " . Routes::base('petugas'));
            exit();
        }
    }

    /**
     * Mengunggah gambar.
     *
     * @param string $inputName Nama input file
     * @return string|false Nama file gambar yang diunggah atau false jika gagal
     */
    private function uploadImage($inputName)
    {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES[$inputName]['tmp_name'];
            $fileName = $_FILES[$inputName]['name'];
            $fileSize = $_FILES[$inputName]['size'];
            $fileType = $_FILES[$inputName]['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            if (in_array($fileExtension, $allowedExtensions)) {
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = Routes::storage("users/");
                $destPath = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    return $newFileName;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
