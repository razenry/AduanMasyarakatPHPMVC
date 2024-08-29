<main class="bg-gray-100 rounded-md lg:py-20 lg:px-20 ">
    <section>
        <div class="p-5 lg:p-0" data-aos="zoom-in-up">
            <!-- Breadcrumbs -->
            <div class="mb-6">
                <nav aria-label="Breadcrumb">
                    <ol class="flex space-x-2 text-gray-600">
                        <li><a href="#" class="text-sm text-red-600 hover:text-red-700 lg:text-base">WargaLapor</a></li>
                        <li><span class="text-sm text-gray-400 lg:text-base"> &gt; </span></li>
                        <li><span class="text-sm text-gray-500 lg:text-base">Profil</span></li>
                    </ol>
                </nav>
            </div>
            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-xl font-extrabold text-red-600 lg:text-2xl">Profil</h1>
            </div>
        </div>
        <div class="grid grid-cols-1 px-4 pb-20 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900 lg:px-20 lg:pb-0" data-aos="zoom-in-up" data-aos-offset="-100">

            <div class="col-span-12">
                <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 lg:p-6 dark:bg-gray-800">
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">Informasi Umum</h3>
                    <form action="#">
                        <div class="grid grid-cols-6 gap-6">
                            <!-- Label untuk Profil -->
                            <div class="col-span-6">
                                <label for="profil" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profil</label>
                                <!-- Dropzone untuk lampiran file -->
                                <div x-data="dataFileDnD()" class="relative flex flex-col text-gray-400 rounded">
                                    <div class="flex flex-col items-center justify-center gap-4 lg:flex-row lg:justify-normal">
                                        <!-- Area dropzone -->
                                        <div x-ref="dnd"
                                            class="relative flex items-center justify-center w-40 h-40 rounded-full shadow-md bg-gray-50 hover:bg-gray-100"
                                            style="background-image: url('<?= baseUrl('img/complain.png'); ?>'); background-size: cover; background-position: center;">
                                        </div>

                                        <div class="flex flex-col items-center lg:items-start">
                                            <!-- Tombol Ubah Foto Profil -->
                                            <button @click="$refs.fileInput.click()" class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 w-fit" type="button">Ubah Foto Profil</button>
                                            <input x-ref="fileInput" accept="image/jpeg, image/jpg, image/png" type="file" class="hidden" @change="addFiles($event)">
                                            <!-- Pesan jenis file -->
                                            <p class="text-sm text-center lg:text-left">Format yang didukung: JPEG, JPG, atau PNG.</p>
                                        </div>
                                    </div>


                                    <!-- Modal untuk cropping -->
                                    <div x-ref="modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50" @click.away="cancelCrop()">
                                        <div class="relative flex flex-col w-1/2 p-4 bg-white rounded h-1/2">
                                            <!-- Gambar untuk crop -->
                                            <div class="relative flex-grow w-full h-full">
                                                <img id="image-to-crop" src="<?= baseUrl('img/complain.png') ?>" alt="Image to crop" class="object-cover w-full h-full">
                                            </div>
                                            <!-- Kontrol modal berada di bawah gambar -->
                                            <div class="p-4 mt-4 rounded">
                                                <div class="flex justify-center space-x-4">
                                                    <button @click="cancelCrop()" class="px-4 py-2 text-white bg-gray-500 rounded" type="button">Batal</button>
                                                    <button @click="cropImage()" class="px-4 py-2 text-white bg-red-500 rounded" type="button">Crop</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Input -->
                            <div class="col-span-6 lg:col-span-3">
                                <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                <input type="text" name="first-name" id="first-name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Edo Priyatna" required>
                            </div>
                            <div class="col-span-6 lg:col-span-3">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="nama@gmail.com" required>
                            </div>
                            <div class="col-span-6 lg:col-span-3">
                                <label for="phone-number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Telepon</label>
                                <input type="text" name="phone-number" id="phone-number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="08123456789" required>
                            </div>
                            <div class="col-span-6 lg:col-full">
                                <button class="text-white bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Simpan</button>
                            </div>
                        </div>

                        <script>
                            function dataFileDnD() {
                                return {
                                    cropper: null,
                                    addFiles(event) {
                                        const file = event.target.files[0];
                                        if (file && file.type.startsWith('image/')) {
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                // Tampilkan modal untuk crop
                                                const modal = this.$refs.modal;
                                                modal.classList.remove('hidden'); // Tampilkan modal
                                                const imageElement = document.getElementById('image-to-crop');
                                                imageElement.src = e.target.result;

                                                // Inisialisasi Cropper.js
                                                this.cropper = new Cropper(imageElement, {
                                                    aspectRatio: 1, // Menjaga proporsi persegi
                                                    viewMode: 1,
                                                    background: false,
                                                    zoomable: false,
                                                });
                                            };
                                            reader.readAsDataURL(file);
                                        }
                                    },
                                    cropImage() {
                                        const canvas = this.cropper.getCroppedCanvas();
                                        const croppedImageURL = canvas.toDataURL('image/png');

                                        // Terapkan hasil crop ke background image dropzone
                                        this.$refs.dnd.style.backgroundImage = `url('${croppedImageURL}')`;

                                        // Hapus modal dan reset Cropper
                                        const modal = this.$refs.modal;
                                        modal.classList.add('hidden'); // Sembunyikan modal
                                        this.cropper.destroy();
                                        this.cropper = null;
                                    },
                                    cancelCrop() {
                                        // Hapus modal dan reset Cropper tanpa menyimpan perubahan
                                        const modal = this.$refs.modal;
                                        modal.classList.add('hidden'); // Sembunyikan modal
                                        if (this.cropper) {
                                            this.cropper.destroy();
                                            this.cropper = null;
                                        }
                                    }
                                };
                            }
                        </script>

                    </form>
                </div>
                <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 lg:p-6 dark:bg-gray-800">
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">Ubah Kata Sandi</h3>
                    <form action="#">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 lg:col-span-3">
                                <label for="current-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata Sandi Lama</label>
                                <input type="text" name="current-password" id="current-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="••••••••" required>
                            </div>
                            <div class="col-span-6 lg:col-span-3">
                                <div class="col-span-6 lg:col-span-3">
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata Sandi Baru</label>
                                    <input type="text" name="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="••••••••" required>
                                </div>
                            </div>
                            <div class="col-span-6 lg:col-span-3">
                                <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi Kata Sandi</label>
                                <input type="text" name="confirm-password" id="confirm-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="••••••••" required>
                            </div>
                            <div class="col-span-6 lg:col-full">
                                <button class="text-white bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</main>