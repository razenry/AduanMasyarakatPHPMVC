<?php

$user = $data['user'];
$nama = $user['nama'];
$email = $user['email'];
$motivation = $data['motivation'];
$jml_pengguna = $data['jml_pengguna']['total'];
$jml_petugas = $data['jml_petugas']['total'];

?>

<style>
    .container-fluid .row .col .hover-card {
        outline: none;
        transition: all ease 0.3s;
        background-color: #fff;
    }

    .container-fluid .row .col .hover-card:hover {
        background-color: #e9ecef;
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(255, 40, 40, 0.822);
    }

    .container-fluid .row .col .hover-card .card-title,
    .container-fluid .row .col .hover-card .card-text {
        transition: color ease 0.3s;
    }

    .container-fluid .row .col .hover-card:hover .card-title,
    .container-fluid .row .col .hover-card:hover .card-text {
        color: #343a40;
    }
</style>

<div class="container-fluid content-inner mt-n5 py-0">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Welcome <?= $nama ?> !</h5>
            <p class="card-text"><?= $motivation ?>.</p>
            <a href="<?= Routes::base('dataLaporan') ?>" class="btn btn-primary">Lihat Laporan</a>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
            <a class="card shadow hover-card" href="<?= Routes::base('dataLaporan') ?>">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="fa-solid fa-circle-exclamation fw-bold fs-2"></i></h5>
                    <h5 class="card-title">Laporan</h5>
                    <p class="card-text">0</p>
                </div>
            </a>
        </div>

        <div class="col">
            <a class="card shadow hover-card" href="#">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="fa-solid fa-hourglass-start fw-bold fs-2"></i></h5>
                    <h5 class="card-title">Menunggu</h5>
                    <p class="card-text">0</p>
                </div>
            </a>
        </div>

        <div class="col">
            <a class="card shadow hover-card" href="#">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="fa-solid fa-thumbs-up fw-bold fs-2"></i></h5>
                    <h5 class="card-title">Diverifikasi</h5>
                    <p class="card-text">0</p>
                </div>
            </a>
        </div>

        <div class="col">
            <a class="card shadow hover-card" href="#">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="fa-solid fa-screwdriver-wrench fw-bold fs-2"></i></h5>
                    <h5 class="card-title">Dalam tindakan</h5>
                    <p class="card-text">0</p>
                </div>
            </a>
        </div>

        <div class="col">
            <a class="card shadow hover-card" href="#">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="fa-solid fa-circle-check fw-bold fs-2"></i></h5>
                    <h5 class="card-title">Tuntas</h5>
                    <p class="card-text">0</p>
                </div>
            </a>
        </div>

        <div class="col">
            <a class="card shadow hover-card" href="#">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="fa-solid fa-circle-xmark fw-bold fs-2"></i></h5>
                    <h5 class="card-title">Ditolak</h5>
                    <p class="card-text">0</p>
                </div>
            </a>
        </div>
    </div>
</div>
