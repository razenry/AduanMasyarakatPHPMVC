<main class="bg-gray-100 rounded-md lg:py-20 lg:px-20">
    <section class="container">
        <div class="p-5 lg:p-0" data-aos="zoom-in-up">
            <!-- Breadcrumbs -->
            <div class="mb-6">
                <nav aria-label="Breadcrumb">
                    <ol class="flex space-x-2 text-gray-600">
                        <li><a href="#" class="text-sm text-red-600 hover:text-red-700 lg:text-base">WargaLapor</a></li>
                        <li><span class="text-sm text-gray-400 lg:text-base"> &gt; </span></li>
                        <li><span class="text-sm text-gray-500 lg:text-base">LaporanKu</span></li>
                    </ol>
                </nav>
            </div>
            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-xl font-extrabold text-red-600 lg:text-2xl">LaporanKu</h1>
            </div>
        </div>

        <!-- Formulir pencarian laporan -->
        <div class="flex flex-col px-5 mb-10 lg:px-0" data-aos="zoom-in-up">
            <!-- Instruksi pencarian laporan -->
            <p class="mb-2">Sudah pernah melaporkan? Cek judul laporan di sini.</p>
            <form class="flex items-center gap-x-5" method="POST" action="<?= Routes::base('laporan') ?>">
                <!-- Label untuk input pencarian (tersembunyi) -->
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Cari Laporan!</label>
                <!-- Input pencarian -->
                <input type="search" name="judul" id="default-search" class="flex-grow p-4 text-xs font-semibold text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-red-500 focus:border-red-500 lg:text-sm" placeholder="" required />
                <!-- Tombol pencarian -->
                <button type="submit" name="cari" class="inline-flex items-center p-4 text-xs font-medium text-white bg-red-700 border border-red-700 rounded-lg lg:text-sm hover:bg-red-800 ">
                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    Cari Laporan!
                </button>
            </form>
        </div>

        <div class="pb-20 lg:pb-0" data-aos="zoom-in-up" data-aos-offset="-100">

            <!-- Section Detail Aduan -->
            <div class="p-6 mx-5 bg-white rounded-lg shadow-lg lg:mx-0 lg:col-span-3">

                <?php if (isset($_SESSION['berhasil'])) : ?>
                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-green-200 dark:text-green-900" role="alert">
                        <?= $_SESSION['berhasil']; ?>
                    </div>
                    <?php unset($_SESSION['berhasil']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['gagal'])) : ?>
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-red-200 dark:text-red-900" role="alert">
                        <?= $_SESSION['gagal']; ?>
                    </div>
                    <?php unset($_SESSION['gagal']); ?>
                <?php endif; ?>

                <div class="flex flex-wrap items-center justify-between pb-4 mb-6 border-b border-gray-300 lg:flex-nowrap">
                    <!-- Container untuk daftar menu -->
                    <div class="w-full overflow-x-auto lg:w-auto lg:overflow-x-visible">
                        <ul class="flex space-x-4 text-gray-600 flex-nowrap">

                            <li><a href="<?= Routes::base('laporanku') ?>" class="<?= ($data['laporan_tampil'] ?? '') === 'semua' ? 'pb-2 text-red-600 border-b-2 border-red-600' : 'hover:text-red-600' ?>">Semua</a></li>

                            <li><a href="<?= Routes::base('laporanku/menunggu') ?>" class="<?= ($data['laporan_tampil'] ?? '') === 'menunggu' ? 'pb-2 text-red-600 border-b-2 border-red-600' : 'hover:text-red-600' ?>">Menunggu</a></li>

                            <li><a href="<?= Routes::base('laporanku/diverifikasi') ?>" class="<?= ($data['laporan_tampil'] ?? '') === 'diverifikasi' ? 'pb-2 text-red-600 border-b-2 border-red-600' : 'hover:text-red-600' ?>">Diverifikasi</a></li>

                            <li><a href="<?= Routes::base('laporanku/dalamTindakan') ?>" class="<?= ($data['laporan_tampil'] ?? '') === 'dalamTindakan' ? 'pb-2 text-red-600 border-b-2 border-red-600' : 'hover:text-red-600' ?>">Dalam Tindakan</a></li>

                            <li><a href="<?= Routes::base('laporanku/tuntas') ?>" class="<?= ($data['laporan_tampil'] ?? '') === 'tuntas' ? 'pb-2 text-red-600 border-b-2 border-red-600' : 'hover:text-red-600' ?>">Tuntas</a></li>

                            <li><a href="<?= Routes::base('laporanku/ditolak') ?>" class="<?= ($data['laporan_tampil'] ?? '') === 'ditolak' ? 'pb-2 text-red-600 border-b-2 border-red-600' : 'hover:text-red-600' ?>">Tidak Layak</a></li>

                        </ul>
                    </div>

                    <!-- Tombol untuk tambah laporan -->
                    <a href="<?= Routes::base('laporan') ?>" class="px-4 py-2 mt-4 text-white bg-red-700 rounded-md lg:mt-0 hover:bg-red-700">Tambah Laporan</a>
                </div>


                <div id="myTabContent">
                    <!-- Tab Content Aduanku -->
                    <div class="space-y-6">
                        <div id="aduanku" class="space-y-4">

                            <?php foreach ($data['laporan'] as $key => $laporan) : ?>

                                <div id="aduan-list" class="relative flex flex-col transition duration-300 bg-white border rounded-lg shadow cursor-pointer lg:flex-row hover:bg-gray-100">
                                    <div class="flex-none w-full lg:w-36">
                                        <a href="">
                                            <img src="<?= Routes::storage("laporan/" . $laporan['fotos'][0]['foto']) ?>" class="object-cover w-full rounded-t-lg h-36 lg:rounded-none" alt="image card">
                                        </a>
                                    </div>
                                    <div class="flex-1 p-4">
                                        <a href="<?= Routes::base("detail/" . $laporan['slug']) ?>">
                                            <p class="text-sm font-semibold text-gray-600"><?= $laporan['judul'] ?></p>
                                            <p class="text-sm text-gray-500">Kecamatan <?= $laporan['kecamatan'] ?>, <?= DateHelper::formatIndonesianDate($laporan['tgl_laporan']) ?></p>
                                            <p class="mt-2 text-sm text-gray-700"><?= $laporan['isi_laporan'] ?></p>
                                        </a>
                                        <div class="flex flex-wrap gap-2 mt-3">
                                            <span class="px-2 py-1 text-sm <?= StatusHelper::getStatusClass($laporan['status']) ?> rounded-full"><?= htmlspecialchars($laporan['status'], ENT_QUOTES, 'UTF-8') ?></span>
                                            <span class="px-2 py-1 text-sm <?= StatusHelper::getJenisLaporanClass($laporan['jenis_laporan']) ?> rounded-full"><?= htmlspecialchars(TextHelper::capitalizeFirstLetter($laporan['jenis_laporan']), ENT_QUOTES, 'UTF-8') ?></span>
                                        </div>

                                    </div>

                                    <!-- Dropdown button -->
                                    <button id="dropdownButton<?= $laporan['slug'] ?>" data-dropdown-toggle="<?= $laporan['slug'] ?>" class="absolute top-5 right-5 text-white bg-red-700 rounded-lg text-sm p-1.5 shadow-md" type="button">
                                        <span class="sr-only">Open dropdown</span>
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                            <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                        </svg>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdownMenu<?= $laporan['slug'] ?>" class="absolute hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow top-10 right-2 w-fit">
                                        <ul class="py-2" aria-labelledby="dropdownButton<?= $laporan['slug'] ?>">
                                            <li>
                                                <?php if ($laporan['jenis_laporan'] == "rahasia") : ?>
                                                    <a href="<?= Routes::base('laporanku/publish/' . $laporan['slug']) ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Publish Laporan</a>
                                                <?php else : ?>
                                                    <a href="<?= Routes::base('laporanku/rahasia/' . $laporan['slug']) ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Rahasiakan Laporan</a>
                                                <?php endif; ?>
                                            </li>
                                            <li>
                                                <a href="<?= Routes::base('laporanku/anonim/' . $laporan['slug']) ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Anonim</a>
                                            </li>
                                            <li>
                                                <a href="<?= Routes::base('laporan/delete/' . $laporan['slug']) ?>" data-confirm class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Hapus Laporan</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <!-- Dropdown button -->
                                    <button id="dropdownButton<?= $laporan['slug'] ?>" data-dropdown-toggle="<?= $laporan['slug'] ?>" class="absolute top-5 right-5 text-white bg-red-700 rounded-lg text-sm p-1.5 shadow-md" type="button">
                                        <span class="sr-only">Open dropdown</span>
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                            <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                        </svg>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdownMenu<?= $laporan['slug'] ?>" class="absolute hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow top-10 right-2 w-fit">
                                        <ul class="py-2" aria-labelledby="dropdownButton">
                                            <li>
                                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Publish Laporan</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Hapus Laporan</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            <?php endforeach; ?>


                        </div>
                    </div>

                    <!-- Tab Content Aduan Ditandai -->
                    <div class="hidden" id="diskusi" role="tabpanel" aria-labelledby="diskusi-tab">
                        <p class="text-xs text-gray-500">Menampilkan <span id="aduan-ditandai-length">0</span> dari <span id="aduan-ditandai-total">0</span> aduan</p>
                        <div id="aduan-ditandai"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Modal delete -->
<!-- Confirmation Modal -->
<div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h2>
        <p class="mb-4">Apakah Anda yakin ingin menghapus laporan ini?</p>
        <div class="flex justify-end">
            <button id="cancelButton" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">Batal</button>
            <a id="confirmButton" href="#" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded ml-3">Hapus</a>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menangani dropdown
        document.querySelectorAll('[data-dropdown-toggle]').forEach(button => {
            const dropdownMenuId = button.getAttribute('data-dropdown-toggle');
            const dropdownMenu = document.getElementById('dropdownMenu' + dropdownMenuId);

            button.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevent event from bubbling up to document
                // Tampilkan atau sembunyikan dropdown menu
                dropdownMenu.classList.toggle('hidden');
            });

            // Tutup dropdown saat mengklik di luar menu
            document.addEventListener('click', function(event) {
                if (!button.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Select modal and buttons
        const confirmationModal = document.getElementById('confirmationModal');
        const confirmButton = document.getElementById('confirmButton');
        const cancelButton = document.getElementById('cancelButton');

        // Add event listener to delete link
        document.querySelectorAll('[data-confirm]').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const href = this.getAttribute('href');

                // Show modal
                confirmationModal.classList.remove('hidden');

                // Set href for confirm button
                confirmButton.setAttribute('href', href);
            });
        });

        // Hide modal on cancel
        cancelButton.addEventListener('click', function() {
            confirmationModal.classList.add('hidden');
        });

        // Hide modal on click outside
        confirmationModal.addEventListener('click', function(event) {
            if (event.target === confirmationModal) {
                confirmationModal.classList.add('hidden');
            }
        });
    });
</script>