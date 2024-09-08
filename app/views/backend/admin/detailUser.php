<?php
// Data yang Anda miliki
$user = $data['user'];

$nama = $user['nama'];
$email = $user['email'];
$role = $user['level'];
$foto = $user['foto'];

// Memisahkan nama berdasarkan spasi
$namaArray = explode(' ', $nama);

// Mengambil nama depan (kata pertama)
$namaDepan = isset($namaArray[0]) ? $namaArray[0] : '';

?>

<div class="container-fluid content-inner mt-n5 py-0">
    <div class="card">
        <div class="card-header">
            <div class="header-title">
                <h4 class="card-title">Profil</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="text-center">
                <div class="user-profile">
                    <img src="<?= Routes::storage('users/' . $foto ) ?>" alt="profile-img"
                        class="rounded-pill avatar-130 img-fluid">
                </div>
                <div class="mt-3">
                    <h3 class="d-inline-block"><?= $namaDepan ?></h3>
                    <p class="d-inline-block pl-3"> - <?= $role ?></p>
                    <p class="mb-0"><?= ExtendsHelper::getMotivation() ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="header-title">
                <h4 class="card-title">Tentang Pengguna</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="user-bio">
                <p>Tart I love sugar plum I love oat cake. Sweet roll caramels I love jujubes. Topping cake wafer.</p>
            </div>
            <div class="mt-2">
                <h6 class="mb-1">Joined:</h6>
                <p>Feb 15, 2021</p>
            </div>
            <div class="mt-2">
                <h6 class="mb-1">Lives:</h6>
                <p>United States of America</p>
            </div>
            <div class="mt-2">
                <h6 class="mb-1">Email:</h6>
                <p><a href="#" class="text-body"><?= $email ?></a></p>
            </div>
            <div class="mt-2">
                <h6 class="mb-1">Url:</h6>
                <p><a href="#" class="text-body" target="_blank"> www.bootstrap.com </a></p>
            </div>
            <div class="mt-2">
                <h6 class="mb-1">Contact:</h6>
                <p><a href="#" class="text-body">(001) 4544 565 456</a></p>
            </div>
        </div>
    </div>
</div>