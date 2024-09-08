<div class="wrapper">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>

    <div class="gradient">
        <div class="container">
            <img src="<?= Routes::public("assets/images/error/404.png") ?>" class="img-fluid mb-4 w-50" alt="" />
            <h2 class="mb-0 mt-4 text-white"><?= $_SESSION['pesan']['judul'] ?></h2>
            <p class="mt-2 text-white"><?= $_SESSION['pesan']['isi'] ?></p>
            <a class="btn bg-white text-primary d-inline-flex align-items-center" href="<?= Routes::base("admin") ?>">Kembali</a>
        </div>
        <div class="box">
            <div class="c xl-circle">
                <div class="c lg-circle">
                    <div class="c md-circle">
                        <div class="c sm-circle">
                            <div class="c xs-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="wrapper">
    <div class="gradient">
        <div class="container">
            <img src="../../assets/images/error/500.png" class="img-fluid mb-4 w-50" alt="" />
            <h2 class="mb-0 mt-4 text-white"><?= $_SESSION['pesan']['judul'] ?></h2>
            <p class="mt-2 text-white"><?= $_SESSION['pesan']['isi'] ?></p>
            <a class="btn bg-white text-primary d-inline-flex align-items-center" href="<?= Routes::base("admin") ?>">Kembali</a>
        </div>
        <div class="box">
            <div class="c xl-circle">
                <div class="c lg-circle">
                    <div class="c md-circle">
                        <div class="c sm-circle">
                            <div class="c xs-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->