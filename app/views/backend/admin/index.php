<?php
$user = $data['user'];
$nama = $user['nama'];
$email = $user['email'];
$jml_pengguna = $data['jml_pengguna']['total'];
$jml_petugas = $data['jml_petugas']['total'];
$jml_laporan = $data['jml_laporan']['total'];

$statusLaporan = $data['status_laporan'];
?>

<div class="container-fluid content-inner mt-n5 py-0">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Welcome <?= $nama ?>!</h5>
            <p class="card-text"><?= ExtendsHelper::getMotivation() ?>.</p>
            <a href="<?= Routes::base('dataLaporan') ?>" class="btn btn-primary">Lihat Laporan</a>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
        <?php if ($user['level'] == "Admin") : ?>
            <!-- Admin Cards -->
            <div class="col">
                <a class="card shadow hover-card" href="<?= Routes::base("user") ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa-solid fa-users fw-bold fs-2"></i></h5>
                        <h5 class="card-title">Pengguna</h5>
                        <p class="card-text"><?= $jml_pengguna ?></p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a class="card shadow hover-card" href="<?= Routes::base("petugas") ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa-solid fa-user-tie fw-bold fs-2"></i></h5>
                        <h5 class="card-title">Petugas</h5>
                        <p class="card-text"><?= $jml_petugas ?></p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a class="card shadow hover-card" href="<?= Routes::base("dataLaporan") ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa-solid fa-circle-exclamation fw-bold fs-2"></i></h5>
                        <h5 class="card-title">Jumlah Laporan</h5>
                        <p class="card-text"><?= $jml_laporan ?></p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a class="card shadow hover-card" href="#">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa-solid fa-circle-check fw-bold fs-2"></i></h5>
                        <h5 class="card-title">Laporan Selesai</h5>
                        <p class="card-text"><?= $statusLaporan['Tuntas'] ?></p>
                    </div>
                </a>
            </div>

            <!-- Additional Cards for Admin based on Status -->
            <div class="col">
                <a class="card shadow hover-card" href="#">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa-solid fa-hourglass-start fw-bold fs-2"></i></h5>
                        <h5 class="card-title">Menunggu Tanggapan</h5>
                        <p class="card-text"><?= $statusLaporan['Menunggu'] ?></p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a class="card shadow hover-card" href="#">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa-solid fa-check-double fw-bold fs-2"></i></h5>
                        <h5 class="card-title">Diverifikasi</h5>
                        <p class="card-text"><?= $statusLaporan['Diverifikasi'] ?></p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a class="card shadow hover-card" href="#">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa-solid fa-spinner fw-bold fs-2"></i></h5>
                        <h5 class="card-title">Dalam Tindakan</h5>
                        <p class="card-text"><?= $statusLaporan['Tindakan'] ?></p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a class="card shadow hover-card" href="#">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa-solid fa-times-circle fw-bold fs-2"></i></h5>
                        <h5 class="card-title">Ditolak</h5>
                        <p class="card-text"><?= $statusLaporan['Ditolak'] ?></p>
                    </div>
                </a>
            </div>

        <?php elseif ($user['level'] == "Petugas") : ?>
            <!-- Petugas Cards -->
            <div class="col">
                <a class="card shadow hover-card" href="<?= Routes::base("dataLaporan") ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa-solid fa-circle-exclamation fw-bold fs-2"></i></h5>
                        <h5 class="card-title">Jumlah Laporan</h5>
                        <p class="card-text"><?= $jml_laporan ?></p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a class="card shadow hover-card" href="#">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa-solid fa-hourglass-half fw-bold fs-2"></i></h5>
                        <h5 class="card-title">Dalam Antrean</h5>
                        <p class="card-text"><?= $statusLaporan['Menunggu'] ?></p>
                    </div>
                </a>
            </div>

            <!-- Additional Cards for Petugas based on Status -->
            <div class="col">
                <a class="card shadow hover-card" href="#">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa-solid fa-check-double fw-bold fs-2"></i></h5>
                        <h5 class="card-title">Diverifikasi</h5>
                        <p class="card-text"><?= $statusLaporan['Diverifikasi'] ?></p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a class="card shadow hover-card" href="#">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa-solid fa-spinner fw-bold fs-2"></i></h5>
                        <h5 class="card-title">Dalam Tindakan</h5>
                        <p class="card-text"><?= $statusLaporan['Tindakan'] ?></p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a class="card shadow hover-card" href="#">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa-solid fa-check-circle fw-bold fs-2"></i></h5>
                        <h5 class="card-title">Laporan Selesai</h5>
                        <p class="card-text"><?= $statusLaporan['Tuntas'] ?></p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a class="card shadow hover-card" href="#">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa-solid fa-times-circle fw-bold fs-2"></i></h5>
                        <h5 class="card-title">Ditolak</h5>
                        <p class="card-text"><?= $statusLaporan['Ditolak'] ?></p>
                    </div>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
