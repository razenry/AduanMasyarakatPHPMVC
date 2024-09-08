<?php
$laporan = $data['laporan'];
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    .profile-img {
        border: 3px solid #ddd;
        box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
    }

    .profile-img-outline {
        border: 4px solid #007bff;
        box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.1);
    }

    .highlighted-text {
        font-weight: 500;
        line-height: 1.6;
        background-color: #f0f8ff;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .completed-report-card {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        border-radius: 0.375rem;
        padding: 1rem;
        margin-top: 1rem;
    }

    /* Modal container with transparent background */
    .custom-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        /* Transparent background */
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    /* Modal content (image) */
    .modal-content {
        max-width: 90%;
        max-height: 90%;
        display: block;
        margin: auto;
        object-fit: contain;
        /* Maintain aspect ratio */
    }

    /* Close button (X) */
    .close-button {
        position: absolute;
        top: 10px;
        right: 20px;
        color: white;
        font-size: 30px;
        font-weight: bold;
        cursor: pointer;
        z-index: 1001;
    }

    .close-button:hover {
        color: #bbb;
    }

    .copy-icon-btn {
        background: none;
        border: none;
        cursor: pointer;
        color: #007bff;
        /* Warna biru untuk ikon */
        font-size: 1.2em;
        /* Ukuran ikon */
        margin-left: 5px;
        /* Jarak antara teks dan ikon */
    }

    .copy-icon-btn:hover {
        color: #0056b3;
        /* Warna lebih gelap saat hover */
    }

    .copy-icon-btn:focus {
        outline: none;
        /* Hilangkan border focus */
    }

    <?= CSSHelper::getCardStatusCSS() ?>
</style>

<div class="container-fluid content-inner mt-n5 py-0 mt-4">
    <div class="row g-4">
        <!-- Sidebar User Information -->
        <div class="col-lg-4 col-md-5">
            <div class="card shadow-sm rounded-4 border-0">
                <div class="card-body text-center">
                    <img src="<?= Routes::storage("users/" . $laporan['pengguna']['foto']) ?>" alt="Foto Pengguna" class="profile-img rounded-circle mb-3" width="100px">
                    <h5 class="mb-1"><?= $laporan['pengguna']['nama']; ?></h5>
                    <p class="text-muted mb-2"><?= $laporan['pengguna']['email']; ?></p>
                    <p class="mb-3">
                        <i class="bi bi-telephone-fill me-2"></i><?= !empty($laporan['pengguna']['telp']) ? $laporan['pengguna']['telp'] : 'Tidak tersedia'; ?>
                    </p>
                    <p class="mb-3">
                        <?= StatusBadgeHelper::getStatusUser($laporan['pengguna']['status']) ?>
                    </p>
                    <a href="tel:<?= $laporan['pengguna']['telp']; ?>" class="btn btn-primary w-100">
                        <i class="bi bi-chat-dots-fill me-2"></i>Hubungi Pengguna
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-8 col-md-7">
            <div class="row">
                <!-- Completed Report Status Card -->
                <?= StatusBadgeHelper::getCompletionNotification($laporan['status']) ?>
                <!-- Detail Laporan -->
                <div class="col-12">
                    <div class="card shadow-sm rounded-4 border-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Detail Laporan</h4>
                            <div>
                                <?= StatusBadgeHelper::getStatusBadge($laporan['status']) ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>ID Laporan:</strong> <?= $laporan['id']; ?></p>
                                    <p>
                                        <strong>Kode Laporan:</strong>
                                        <span id="kodeLaporan"><?= $laporan['slug']; ?></span>
                                        <button id="copyButton" onclick="copyToClipboard()" title="Salin Kode Laporan" class="copy-icon-btn">
                                            <i class="fas fa-copy"></i> <!-- Ikon salin -->
                                        </button>
                                    </p>
                                    <p><strong>Jenis Laporan:</strong> <?= ucfirst($laporan['jenis_laporan']); ?></p>
                                    <p><strong>Kecamatan:</strong> <?= $laporan['kecamatan']; ?></p>
                                    <p><strong>Kelurahan:</strong> <?= $laporan['kelurahan']; ?></p>
                                </div>


                                <div class="col-md-6">
                                    <p><strong>Tanggal Laporan:</strong> <?= DateHelper::formatIndonesianDate($laporan['tgl_laporan']); ?></p>
                                    <p><strong>Jam Lapor:</strong> <?= DateHelper::formatTime($laporan['jam_lapor']); ?> WIB</p>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h5>Isi Laporan</h5>
                                <p class="highlighted-text"><?= $laporan['isi_laporan']; ?></p>
                            </div>
                            <div class="text-end">
                                <?= ActionButtonHelper::getActionButtons($laporan, $data['user']['level']) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Foto Laporan -->
                <div class="col-12">
                    <div class="card shadow-sm rounded-4 border-0">
                        <div class="card-body">
                            <h5 class="mb-4">Foto Laporan</h5>
                            <?php if (!empty($laporan['fotos'])): ?>
                                <div id="fotoLaporanCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php foreach ($laporan['fotos'] as $index => $foto): ?>
                                            <?php $imagePath = Routes::storage("laporan/" . $foto['foto']); ?>
                                            <div class="carousel-item <?= $index === 0 ? 'active' : ''; ?>">
                                                <img src="<?= $imagePath ?>" class="d-block w-100 rounded" alt="Foto Laporan <?= $index + 1; ?>" style="cursor: pointer;">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#fotoLaporanCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Sebelumnya</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#fotoLaporanCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Berikutnya</span>
                                    </button>
                                </div>
                            <?php else: ?>
                                <p>Tidak ada foto terkait laporan ini.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Image Preview -->
<div id="imagePreviewModal" class="custom-modal">
    <span class="close-button" onclick="closeModal()">&times;</span>
    <img src="" id="modalImage" class="modal-content">
</div>

<?= ModalHelper::statusModal($laporan) ?>

<?= ModalHelper::responseModal($laporan) ?>

<?= ModalHelper::rejectModal($laporan) ?>

<?= ModalHelper::restoreModal($laporan) ?>

<?= ModalHelper::verifyModal($laporan) ?>

<?= ModalHelper::actionModal($laporan) ?>

<!-- Form Validation -->
<script>
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })();

    function openModal(imgSrc) {
        var modal = document.getElementById("imagePreviewModal");
        var modalImage = document.getElementById("modalImage");
        modalImage.src = imgSrc;
        modal.style.display = "flex"; // Show the modal
    }

    function closeModal() {
        var modal = document.getElementById("imagePreviewModal");
        modal.style.display = "none"; // Hide the modal
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Ambil semua gambar di carousel
        var carouselImages = document.querySelectorAll('#fotoLaporanCarousel .carousel-item img');

        // Tambahkan event listener untuk setiap gambar
        carouselImages.forEach(function(image) {
            image.addEventListener('click', function() {
                var imgSrc = this.getAttribute('src'); // Ambil source dari gambar yang diklik
                openModal(imgSrc); // Open the modal with clicked image
            });
        });
    });

    function copyToClipboard() {
        // Ambil teks dari elemen dengan id kodeLaporan
        var kodeLaporan = document.getElementById("kodeLaporan").innerText;

        // Buat elemen teks sementara untuk menyalin teks ke clipboard
        var tempInput = document.createElement("input");
        tempInput.value = kodeLaporan;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);

        // Tampilkan notifikasi menggunakan SweetAlert2
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Kode Laporan berhasil disalin: ' + kodeLaporan,
            showConfirmButton: false,
            timer: 2000
        });
    }
</script>