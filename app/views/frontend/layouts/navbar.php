<?php

if (isset($data['user'])) {
    $user = $data['user'];
} else {
    $user['foto'] = "";
}
?>
<header data-aos="fade-down" class="relative top-0 left-0 z-50 w-full bg-white shadow-md ">
    <!-- Navbar Container -->
    <nav class="px-4 py-5 border-gray-200 lg:px-14">
        <!-- Container untuk flex dan tata letak menu -->
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto">
            <!-- Logo dan Nama Situs -->
            <a href="https://flowbite.com" class="flex items-center">
                <img src="<?= Routes::public('img/iconlogo.png') ?>" class="h-6 mr-3 sm:h-10" alt="Logo" />
                <span class="self-center font-semibold text-md lg:text-xl whitespace-nowrap">
                    Warga<span class="text-primary-600">Lapor!</span>
                </span>
            </a>

            <!-- Kontainer Flex untuk Menu dan Tombol Masuk -->
            <div class="flex items-center space-x-4 lg:space-x-6 lg:order-2">
                <!-- Menu dan Tombol Masuk (Desktop) -->
                <div class="hidden lg:flex lg:items-center lg:space-x-5">
                    <!-- Daftar Menu -->
                    <ul class="flex flex-row space-x-5 font-semibold">
                        <li>
                            <!-- Link Menu Beranda -->
                            <a href="<?= Routes::base("beranda") ?>" class="block py-2 pl-3 pr-4 text-red-600 duration-300 border-b border-red-100 hover:bg-red-50 lg:hover:bg-transparent lg:border-0 lg:p-0 hover:text-red-700">
                                Beranda
                            </a>
                        </li>
                        <?php if (isset($_SESSION['login'])) : ?>
                            <li>
                                <!-- Link Menu Laporan -->
                                <a href="<?= Routes::base("laporan") ?>" class="block py-2 pl-3 pr-4 text-red-600 duration-300 border-b border-red-100 hover:bg-red-50 lg:hover:bg-transparent lg:border-0 lg:p-0 hover:text-red-700">
                                    Ajukan Laporan
                                </a>
                            </li>
                            <li>
                                <!-- Link Menu LaporanKu -->
                                <a href="<?= Routes::base("laporanku") ?>" class="block py-2 pl-3 pr-4 text-red-600 duration-300 border-b border-red-100 hover:bg-red-50 lg:hover:bg-transparent lg:border-0 lg:p-0 hover:text-red-700">
                                    LaporanKu
                                </a>
                            </li>
                        <?php endif ?>
                        <li>
                            <!-- Link Menu Jelajah -->
                            <a href="<?= Routes::base("jelajah") ?>" class="block py-2 pl-3 pr-4 text-red-600 duration-300 border-b border-red-100 hover:bg-red-50 lg:hover:bg-transparent lg:border-0 lg:p-0 hover:text-red-700">
                                Jelajah Laporan
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Tombol Masuk (Desktop) -->
                <a href="<?= Routes::base("masuk") ?>" class="hover:bg-red-800 text-white bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center <?php echo isset($_SESSION['login']) ? 'hidden' : 'hidden sm:hidden md:hidden lg:block'; ?>">
                    <i class="mr-2 fa-regular fa-message"></i>
                    Ajukan Laporan
                </a>



                <div class="relative flex items-center space-x-3 md:order-2 md:space-x-0 rtl:space-x-reverse">
                    <!-- Tombol untuk membuka menu pengguna, menampilkan gambar profil -->
                    <button type="button" class="flex text-sm shadow-md border p-1 rounded-full md:me-0 <?php if (!isset($_SESSION['login'])) echo "hidden" ?>" id="user-menu">
                        <span class="sr-only">Buka Menu Pengguna</span>
                        <!-- Gambar profil pengguna -->
                        <?php if ($user['foto'] == "default-user.png") : ?>
                            <img class="w-10 h-10 rounded-full" src="<?= Routes::storage() . "users/default/default-user.png" ?>" alt="test">
                        <?php else : ?>
                            <img class="w-10 h-10 rounded-full" src="<?= Routes::storage("users/" . $user['foto']) ?>" alt="Profil">
                        <?php endif; ?>
                    </button>

                    <!-- Dropdown menu pengguna -->
                    <div class="absolute z-50 hidden w-56 mt-2 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-md -right-10 top-14 " id="user-menu-content">
                        <!-- Informasi dasar pengguna yang ditampilkan di bagian atas dropdown -->
                        <div class="px-4 py-3">
                            <!-- Nama pengguna -->
                            <span class="block text-sm text-gray-900"><?php if (isset($user['nama'])) echo $user['nama'] ?></span>
                            <!-- Email pengguna, ditampilkan sebagai teks yang terpotong jika terlalu panjang -->
                            <span class="block text-sm text-gray-500 truncate"><?php if (isset($user['email'])) echo $user['email'] ?></span>
                        </div>
                        <!-- Daftar menu yang tersedia dalam dropdown -->
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                <!-- Link menuju halaman profil pengguna -->
                                <a href="<?= Routes::base("profil") ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                            </li>
                            <li>
                                <!-- Link untuk keluar dari sistem -->
                                <button id="deleteButton" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Menu Toggle Button (Mobile) -->
                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon untuk membuka menu (hamburger) -->
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <!-- Icon untuk menutup menu (X) -->
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu-2" class="hidden w-full bg-white border-t border-gray-200 lg:hidden">
        <!-- Menu Items dan Tombol Masuk untuk Mobile -->
        <div class="container px-3 mx-auto">
            <div class="flex flex-col w-full">
                <!-- Daftar Menu Mobile -->
                <ul class="flex flex-col font-semibold">
                    <li>
                        <!-- Link Menu Beranda untuk Mobile -->
                        <a href="<?= Routes::base("beranda") ?>" class="block py-2 pl-3 pr-4 text-left text-red-600 border-b border-red-100 hover:bg-red-50">
                            Beranda
                        </a>
                    </li>
                    <?php if (isset($_SESSION['login'])) : ?>

                        <!-- Link Menu Tentang untuk Mobile -->
                        <li>
                            <a href="<?= Routes::base("laporan") ?>" class="block py-2 pl-3 pr-4 text-left text-red-600 border-b border-red-100 hover:bg-red-50">
                                Ajukan Laporan
                            </a>
                        </li>
                        <li>
                            <!-- Link Menu Jelajah untuk Mobile -->
                            <a href="<?= Routes::base("laporanku") ?>" class="block py-2 pl-3 pr-4 text-left text-red-600 border-b border-red-100 hover:bg-red-50">
                                Laporanku
                            </a>
                        </li>
                    <?php endif ?>
                    <li>
                        <!-- Link Menu Jelajah untuk Mobile -->
                        <a href="<?= Routes::base("jelajah") ?>" class="block py-2 pl-3 pr-4 text-left text-red-600 border-b border-red-100 hover:bg-red-50">
                            Jelajah Laporan
                        </a>
                    </li>
                </ul>
                <!-- Tombol Masuk (Desktop) -->
                <a href="<?= Routes::base("masuk") ?>" class="hover:bg-red-800 text-white bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center duration-500 my-2.5 <?php if (isset($_SESSION['login'])) echo "hidden" ?> ">
                    <i class="mr-2 fa-regular fa-message "></i>
                    Ajukan laporan
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Modal toggle -->
<!-- <div class="flex justify-center m-5">
    <button id="deleteButton" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button">
        Show delete confirmation
    </button>
</div> -->

<!-- Main modal -->
<div id="deleteModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5 sm:py-10">
            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <i class="fa-solid fa-right-from-bracket text-5xl mb-4 text-red-600"></i>
            <h3 class="text-2xl">Yakin untuk keluar?</h3>
            <p class="mb-4 text-gray-500 dark:text-gray-300">Kamu akan di kembalikan ke halaman masuk.</p>
            <div class="flex justify-center items-center space-x-4">
                <button data-modal-toggle="deleteModal" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100">
                    Batal
                </button>
                <a href="<?= Routes::base('home/logout') ?>" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 ">
                    Keluar
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userMenuButton = document.getElementById('user-menu');
        const userMenuContent = document.getElementById('user-menu-content');

        userMenuButton.addEventListener('click', function() {
            // Toggle visibility of the dropdown menu
            userMenuContent.classList.toggle('hidden');
        });

        // Optional: Close the dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!userMenuButton.contains(event.target) && !userMenuContent.contains(event.target)) {
                userMenuContent.classList.add('hidden');
            }
        });
    });
</script>