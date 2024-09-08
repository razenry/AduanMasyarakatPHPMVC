<?php

$laporan = $data['laporan'];

?>

<!-- Modal Image -->
<div id="imageModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-75">
    <div class="relative">
        <button class="absolute top-0 right-0 m-4 text-3xl text-red-600" onclick="closeModal()">&times;</button>
        <img id="modalImage" src="" alt="Modal Image" class="max-w-full max-h-screen rounded-md">
    </div>
</div>

<main class="bg-gray-100 rounded-md lg:py-20 lg:px-20">
    <section class="container">
        <div class="p-5" data-aos="zoom-in-up">
            <!-- Breadcrumbs -->
            <div class="mb-6">
                <nav aria-label="Breadcrumb">
                    <ol class="flex space-x-2 text-gray-600">
                        <li><a href="#" class="text-sm text-red-600 hover:text-red-700 lg:text-base">WargaLapor</a></li>
                        <li><span class="text-sm text-gray-400 lg:text-base"> &gt; </span></li>
                        <li><span class="text-sm text-gray-500 lg:text-base">LaporanKu</span></li>
                        <li><span class="text-sm text-gray-400 lg:text-base"> &gt; </span></li>
                        <li><span class="text-sm text-gray-500 lg:text-base">Detail</span></li>
                    </ol>
                </nav>
            </div>
            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-xl font-extrabold text-red-600 lg:text-2xl">Detail</h1>
            </div>
        </div>
        <!-- Card aduan -->
        <div class="px-5 lg:px-0" data-aos="zoom-in-up" data-aos-offset="-100">
            <div class="grid grid-cols-3 gap-5 lg:min-h-fit lg:space-y-0">
                <!-- Section Progress dan Diskusi -->
                <div class="col-span-3 mb-6 lg:col-span-1 lg:pl-2 ">
                    <div class="p-2 bg-white shadow lg:mb-6">
                        <ul class="flex py-2 font-semibold text-center text-gray-500 border-b dark:text-gray-400 border-slate-200" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                            <li class="w-full pr-1" role="presentation">
                                <a href="#" class="inline-block w-full px-4 py-3 text-red-600 border-red-600 rounded-lg hover:bg-red-50 hover:text-red-700 active bg-red-50 dark:text-red-500 dark:hover:text-red-500 dark:border-red-500 active:bg-red-50" id="progress-tab">STATUS</a>
                            </li>
                        </ul>

                        <div id="myTabContent pt-8">
                            <!-- Tab Content Progres -->
                            <div class="p-4 rounded-lg w-full lg:w-full lg:pt-2 overflow-y-auto" id="progress" role="tabpanel" aria-labelledby="progress-tab" style="height: 25.1rem;">
                                <?= StatusBadgeHelper::getStatusInfo($laporan['status'], $laporan['tgl_edit']) ?>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-span-3 lg:col-span-2 lg:pr-2">
                    <!-- Section Detail Aduan -->
                    <div class="mb-6">
                        <div class="bg-white shadow">
                            <!-- header card -->
                            <div class="grid grid-cols-2 p-4 border-b border-slate-200">
                                <div class="col-span-1">
                                    <p class="text-base font-semibold">Rincian Aduan : <span class="text-red-600"><?= $laporan['slug'] ?></span></p>
                                </div>
                            </div>
                            <!-- Content Card -->
                            <div class="p-4 border-b border-slate-200">
                                <!-- Tampilan desktop -->
                                <div class="hidden lg:block">
                                    <div class="grid grid-cols-3 gap-4">
                                        <?php foreach ($laporan['fotos'] as $foto) : ?>

                                            <div>
                                                <a href="#">
                                                    <img src="<?= Routes::storage('laporan/' . $foto['foto']) ?>" class="object-cover w-full rounded h-52 cursor-pointer" alt="image 1" onclick="openModal(this)">
                                                </a>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                                <!-- Tampilan Mobile -->
                                <div id="carousel-aduan" class="relative w-full max-w-2xl mx-auto lg:hidden">
                                    <!-- Carousel wrapper -->
                                    <div class="relative h-64 overflow-hidden rounded-lg">
                                        <!-- Slides -->
                                        <?php foreach ($laporan['fotos'] as $key => $foto) : ?>
                                            <div class="absolute inset-0 transition-transform duration-500 transform" data-carousel-item="<?= $key ?>">
                                                <img src="<?= Routes::storage('laporan/' . $foto['foto']) ?>" class="block object-cover w-full h-full cursor-pointer" alt="Slide 1" onclick="openModal(this)">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- Slider controls -->
                                    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full shadow-md bg-white/30 group-hover:bg-white/50">
                                            <svg class="w-4 h-4 text-red-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                                            </svg>
                                            <span class="sr-only">Previous</span>
                                        </span>
                                    </button>
                                    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full shadow-md bg-white/30 group-hover:bg-white/50">
                                            <svg class="w-4 h-4 text-red-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                            </svg>
                                            <span class="sr-only">Next</span>
                                        </span>
                                    </button>
                                    <!-- Slide indicators -->
                                    <div class="absolute left-0 right-0 flex justify-center space-x-3 bottom-4">
                                        <button class="w-3 h-3 bg-red-700 rounded-full focus:outline-none" data-carousel-indicator="0" aria-label="Slide 1"></button>
                                        <button class="w-3 h-3 bg-gray-300 rounded-full focus:outline-none" data-carousel-indicator="1" aria-label="Slide 2"></button>
                                        <button class="w-3 h-3 bg-gray-300 rounded-full focus:outline-none" data-carousel-indicator="2" aria-label="Slide 3"></button>
                                    </div>
                                </div>

                                <div class="py-3 content-text">
                                    <p class="text-sm font-light text-gray-500">Kecamatan <?= $laporan['kecamatan'] ?>, Kelurahan <?= $laporan['kelurahan'] ?>, <?= DateHelper::formatIndonesianDate($laporan['tgl_laporan']) ?></p>
                                    <p class="pt-2 overflow-hidden text-sm"><?= $laporan['isi_laporan'] ?></p>
                                </div>

                                <?= StatusBadgeHelper::getVisibilityBadge($laporan['jenis_laporan']) ?>

                            </div>

                            <!-- footer card -->
                            <div class="grid grid-cols-2 p-4 border-b border-slate-200">
                                <div class="flex justify-between col-span-2 lg:col-span-1 lg:justify-start">
                                    <button id="copyLinkButton" type="button" class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 flex items-center focus:outline-none">
                                        Bagikan Link
                                        <i class="ml-1 fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Hidden input to hold the URL -->
                            <input type="hidden" id="reportUrl" value="<?= Routes::base('detail/' . $laporan['slug']) ?>">

                            <!-- Section Tanggapan -->
                            <div class="mb-6">
                                <?php if (isset($data['tanggapan'])) : ?>
                                    <div class="bg-white shadow">
                                        <!-- header card -->
                                        <div class="grid grid-cols-2 p-4 border-b border-slate-200">
                                            <div class="col-span-1">
                                                <p class="text-base font-semibold">Tanggapan</p>
                                            </div>
                                        </div>
                                        <!-- Content Card -->
                                        <div class="p-4 border-b border-slate-200">
                                            <!-- Tampilan desktop -->
                                            <div class="hidden lg:block">
                                                <div class="grid grid-cols-3 gap-4">
                                                    <div>
                                                        <a href="#">
                                                            <img src="https://i.pinimg.com/564x/d0/2d/df/d02ddf362eb3b10cc6eb489e9e4721ac.jpg" class="object-cover w-full rounded h-52" alt="response image 1" onclick="openModal(this)">
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="#">
                                                            <img src="https://i.pinimg.com/564x/e8/b8/10/e8b81060ca2b1e0d80b5ae1ea9cb1122.jpg" class="object-cover w-full rounded h-52" alt="response image 2" onclick="openModal(this)">
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="#">
                                                            <img src="https://i.pinimg.com/564x/54/68/a3/5468a33bc43e258995f15ad01e5ad7cc.jpg" class="object-cover w-full rounded h-52" alt="response image 3" onclick="openModal(this)">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Tampilan Mobile -->
                                            <div id="carousel-tanggapan" class="relative w-full max-w-2xl mx-auto lg:hidden">
                                                <!-- Carousel wrapper -->
                                                <div class="relative h-64 overflow-hidden rounded-lg">
                                                    <!-- Slides -->
                                                    <div class="absolute inset-0 transition-transform duration-500 transform" data-carousel-item="0">
                                                        <img src="https://i.pinimg.com/564x/d0/2d/df/d02ddf362eb3b10cc6eb489e9e4721ac.jpg" class="block object-cover w-full h-full cursor-pointer" alt="Response Slide 1" onclick="openModal(this)">
                                                    </div>
                                                    <div class="absolute inset-0 transition-transform duration-500 transform translate-x-full" data-carousel-item="1">
                                                        <img src="https://i.pinimg.com/564x/e8/b8/10/e8b81060ca2b1e0d80b5ae1ea9cb1122.jpg" class="block object-cover w-full h-full cursor-pointer" alt="Response Slide 2" onclick="openModal(this)">
                                                    </div>
                                                    <div class="absolute inset-0 transition-transform duration-500 transform translate-x-full" data-carousel-item="2">
                                                        <img src="https://i.pinimg.com/564x/54/68/a3/5468a33bc43e258995f15ad01e5ad7cc.jpg" class="block object-cover w-full h-full cursor-pointer" alt="Response Slide 3" onclick="openModal(this)">
                                                    </div>
                                                </div>
                                                <!-- Slider controls -->
                                                <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full shadow-md bg-white/30 group-hover:bg-white/50">
                                                        <svg class="w-4 h-4 text-red-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                                                        </svg>
                                                        <span class="sr-only">Previous</span>
                                                    </span>
                                                </button>
                                                <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full shadow-md bg-white/30 group-hover:bg-white/50">
                                                        <svg class="w-4 h-4 text-red-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                                        </svg>
                                                        <span class="sr-only">Next</span>
                                                    </span>
                                                </button>
                                                <!-- Slide indicators -->
                                                <div class="absolute left-0 right-0 flex justify-center space-x-3 bottom-4">
                                                    <button class="w-3 h-3 bg-red-700 rounded-full focus:outline-none" data-carousel-indicator="0" aria-label="Slide 1"></button>
                                                    <button class="w-3 h-3 bg-gray-300 rounded-full focus:outline-none" data-carousel-indicator="1" aria-label="Slide 2"></button>
                                                    <button class="w-3 h-3 bg-gray-300 rounded-full focus:outline-none" data-carousel-indicator="2" aria-label="Slide 3"></button>
                                                </div>
                                            </div>
                                            <div class="py-3 content-text">
                                                <p class="pt-2 overflow-hidden text-sm">Terima kasih atas kesabaran Anda. Kami ingin menginformasikan bahwa laporan yang Anda sampaikan telah berhasil kami tindaklanjuti dan selesaikan. Kami berharap hasil ini dapat memenuhi harapan Anda. Terima kasih atas partisipasi Anda dalam menjaga kualitas layanan.</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Alert -->
<div id="alert" class="fixed top-4 right-4 p-4 bg-green-500 text-white rounded-lg shadow-lg flex items-center space-x-4 opacity-0 transition-opacity duration-300">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 12h2v2h-2zm0-4h2v2h-2zm1 8a9 9 0 100-18 9 9 0 000 18z"></path>
    </svg>
    <span>Link copied to clipboard!</span>
    <button onclick="closeAlert()" class="ml-auto bg-transparent text-white hover:text-gray-200">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>

<script>
    function openModal(element) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        modalImage.src = element.src;
        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
    }

    function showAlert() {
        const alert = document.getElementById('alert');
        alert.classList.remove('opacity-0');
        alert.classList.add('opacity-100');
        setTimeout(() => {
            alert.classList.remove('opacity-100');
            alert.classList.add('opacity-0');
        }, 3000); // Hide the alert after 3 seconds
    }

    function closeAlert() {
        const alert = document.getElementById('alert');
        alert.classList.remove('opacity-100');
        alert.classList.add('opacity-0');
    }

    document.getElementById('copyLinkButton').addEventListener('click', function() {
        const url = document.getElementById('reportUrl').value;
        navigator.clipboard.writeText(url).then(function() {
            showAlert(); // Show the alert
        }, function(err) {
            alert('Failed to copy the link: ', err);
        });
    });
</script>