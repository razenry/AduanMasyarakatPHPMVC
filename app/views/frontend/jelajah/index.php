<main class="bg-gray-100 rounded-md lg:py-20 lg:px-20 ">
    <section class="">
        <div class="p-5 lg:p-0" data-aos="zoom-in-up">
            <!-- Breadcrumbs -->
            <div class="mb-6">
                <nav aria-label="Breadcrumb">
                    <ol class="flex space-x-2 text-gray-600">
                        <li><a href="#" class="text-sm text-red-600 hover:text-red-700 lg:text-base">WargaLapor</a></li>
                        <li><span class="text-sm text-gray-400 lg:text-base"> &gt; </span></li>
                        <li><span class="text-sm text-gray-500 lg:text-base">Jelajah Laporan</span></li>
                    </ol>
                </nav>
            </div>
            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-xl font-extrabold text-red-600 lg:text-2xl">Jelajah Laporan</h1>
            </div>
        </div>
        <div class="pb-20 lg:px-20 lg:pb-0">
            <!-- Formulir pencarian laporan -->
            <div class="flex flex-col px-5 mb-10 lg:px-0" data-aos="zoom-in-up">
                <!-- Instruksi pencarian laporan -->
                <p class="mb-2">Cari laporan</p>
                <form class="flex items-center gap-x-5" method="POST" action="<?= Routes::base('jelajah') ?>">
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
            <div class="grid mx-5 bg-white shadow lg:mx-0" data-aos="zoom-in-up" data-aos-offset="-100">
                <div class="">
                    <!-- form header card -->
                    <div class="flex flex-wrap p-4 border-b border-slate-200">
                        <div class="mb-3 lg:w-full lg:mb-3">
                            <p class="text-base font-semibold">Semua Laporan</p>
                            <p class="text-sm font-light text-gray-500">Terdapat total <?= $data['jml_laporan']['total'] ?> laporan yang telah diterima!</p>
                        </div>

                        <div class="w-full lg:justify-self-end">
                            <form action="<?= Routes::base('jelajah') ?>" method="POST" class="flex gap-5 lg:w-full">
                                <select id="kecamatan" name="kecamatan" class="block w-full text-sm text-gray-900 rounded-lg cursor-pointer bg-gray-50 focus:ring-transparent focus:border-gray-300 h-full py-4 px-3">
                                    <option value="Ciputat">Ciputat</option>
                                    <option value="Ciputat Timur">Ciputat Timur</option>
                                    <option value="Pondok Aren">Pondok Aren</option>
                                    <option value="Serpong">Serpong</option>
                                    <option value="Serpong Utara">Serpong Utara</option>
                                    <option value="Setu">Setu</option>
                                </select>
                                <button type="submit" name="filter" class="inline-flex items-center px-10 text-xs font-medium text-white bg-red-700 border border-red-700 rounded-lg hover:bg-red-800 lg:text-sm">
                                    Filter
                                </button>
                            </form>
                        </div>


                    </div>
                    <!-- list of all laporan -->
                    <div class="grid grid-cols-1 gap-5 p-4 rounded shadow-md lg:grid-cols-3">
                        <!-- Card 1 -->

                        <?php foreach ($data['laporan'] as $key => $laporan) : ?>

                            <a href="<?= Routes::base('detail/' . $laporan['slug']) ?>" class="relative flex flex-col items-center p-4 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100">
                                <div class="flex justify-center w-full h-full">
                                    <img class="object-cover rounded-lg" src="<?= Routes::storage("laporan/" . $laporan['fotos'][0]['foto']) ?>" alt="Gambar Laporan">
                                </div>
                                <div class="flex flex-col flex-grow w-full">
                                    <h2 class="mt-1 text-lg font-bold text-gray-600"><?= $laporan['judul'] ?></h2>
                                    <h5 class="mt-1 text-sm font-medium text-geay-600">Kode : <span class="mt-1 text-sm font-bold text-red-600"><?= $laporan['slug'] ?></span></h5>
                                    <p class="mt-1 text-sm font-medium text-gray-900">Kecamatan:
                                        <span class="text-gray-500 "><?= $laporan['kecamatan'] ?></span>
                                    </p>
                                    <p class="mt-1 text-sm font-medium text-gray-900">Deskripsi:
                                        <span class="text-gray-500 description"><?= $laporan['isi_laporan'] ?></span>
                                    </p>
                                    <p class="mt-1 text-sm font-medium text-gray-900">Tanggal:
                                        <span class="text-gray-500 "><?= DateHelper::formatIndonesianDate($laporan['tgl_laporan']) ?></span>
                                    </p>
                                </div>
                                <!-- Status di pojok kiri bawah -->
                                <div class="flex justify-start w-full mt-auto">
                                    <?= StatusBadgeHelper::getStatusBadgeTail($laporan['status']) ?>
                                </div>
                            </a>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Script Memotong Deskripsi -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Mengambil semua elemen dengan kelas 'description'
        const descriptionElements = document.querySelectorAll('.description');

        descriptionElements.forEach(element => {
            let descriptionText = element.textContent;

            if (descriptionText.length > 150) {
                descriptionText = descriptionText.substring(0, 150) + '...';
                element.textContent = descriptionText;
            }
        });
    });
</script>

<!-- Script Live Search Choices JS / Select -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Choices.js untuk dropdown kecamatan
        const kecamatanSelect = new Choices('#kecamatan', {
            searchEnabled: true,
            placeholderValue: 'Kecamatan',
            searchPlaceholderValue: 'Cari Kecamatan...',
            classNames: {
                containerOuter: 'choices bg-gray-50 text-gray-900 text-sm rounded-lg block w-full mb-5 cursor-pointer',
                containerInner: 'choices__inner',
                input: 'choices__input',
                inputCloned: 'choices__input--cloned',
                list: 'choices__list',
                listItems: 'choices__list--multiple',
                listSingle: 'choices__list--single',
                listDropdown: 'choices__list--dropdown',
                item: 'choices__item',
                itemSelectable: 'choices__item--selectable',
                itemDisabled: 'choices__item--disabled',
                itemChoice: 'choices__item--choice',
                placeholder: 'choices__placeholder',
                group: 'choices__group',
                groupHeading: 'choices__heading',
                button: 'choices__button',
                activeState: 'is-active',
                focusState: 'is-focused',
                openState: 'is-open',
                disabledState: 'is-disabled',
                highlightedState: 'is-highlighted',
                selectedState: 'is-selected',
                flippedState: 'is-flipped',
                loadingState: 'is-loading',
                noResults: 'has-no-results',
                noChoices: 'has-no-choices'
            }
        });

        // Inisialisasi Choices.js untuk dropdown sort
        const sortSelect = new Choices('#sort', {
            searchEnabled: true,
            placeholderValue: '',
            searchPlaceholderValue: '',
            itemSelectText: '',
            classNames: {
                containerOuter: 'choices bg-gray-50 text-gray-900 text-sm rounded-lg block w-1/2 lg:w-1/3 h-12 cursor-pointer',
                containerInner: 'choices__inner',
                input: 'choices__input',
                inputCloned: 'choices__input--cloned',
                list: 'choices__list',
                listItems: 'choices__list--multiple',
                listSingle: 'choices__list--single',
                listDropdown: 'choices__list--dropdown',
                item: 'choices__item',
                itemSelectable: 'choices__item--selectable',
                itemDisabled: 'choices__item--disabled',
                itemChoice: 'choices__item--choice',
                placeholder: 'choices__placeholder',
                group: 'choices__group',
                groupHeading: 'choices__heading',
                button: 'choices__button',
                activeState: 'is-active',
                focusState: 'is-focused',
                openState: 'is-open',
                disabledState: 'is-disabled',
                highlightedState: 'is-highlighted',
                selectedState: 'is-selected',
                flippedState: 'is-flipped',
                loadingState: 'is-loading',
                noResults: 'has-no-results',
                noChoices: 'has-no-choices'
            }
        });

        // Redirect halaman saat opsi sort dipilih
        document.querySelector('#sort').addEventListener('change', function(event) {
            const selectedValue = event.detail.value;
            if (selectedValue) {
                window.location.href = selectedValue;
            }
        });
    });
</script>