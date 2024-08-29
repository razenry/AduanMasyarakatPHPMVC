<?php

$user = $data['user'];

$username = $user['username'];
$nama = $user['nama'];
$email = $user['email'];
$motivation = $data['motivation'];

?>

<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Welcome <?= $nama ?> !</h5>
            <p class="card-text"><?= $motivation ?>.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
</div>