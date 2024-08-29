<!-- Content Card -->
<div class="p-4 border-b border-slate-200">
    <!-- Tampilan dekstop -->
    <div class="hidden sm:block">
        <div class="grid grid-cols-3 gap-4 images">
            <div class="items-center justify-center col-span-1">
                <a href="#">
                    <img src="https://i.pinimg.com/474x/0e/2a/e2/0e2ae21aa010d78c7a27a0287748c093.jpg" class="object-cover w-full rounded h-52" alt="image card" onclick="openModal(this)">
                </a>
            </div>
            <div class="items-center justify-center col-span-1">
                <a href="#">
                    <img src="https://i.pinimg.com/474x/2d/16/2c/2d162c7e97143e38ac32e0587e92f09e.jpg" class="object-cover w-full rounded h-52" alt="image card" onclick="openModal(this)">
                </a>
            </div>
            <div class="items-center justify-center col-span-1">
                <a href="#">
                    <img src="https://i.pinimg.com/474x/8c/c4/8b/8cc48bd6aa94d83d6d43e90f2e40517d.jpg" class="object-cover w-full rounded h-52" alt="image card" onclick="openModal(this)">
                </a>
            </div>
        </div>
    </div>
    <!-- Tampilan Mobile -->
    <div class="relative w-full max-w-2xl mx-auto sm:hidden">
        <!-- Carousel wrapper -->
        <div class="relative h-64 overflow-hidden rounded-lg">
            <!-- Slide 1 -->
            <div class="absolute inset-0 transition-transform duration-500 transform translate-x-0 carousel-item">
                <img src="https://i.pinimg.com/474x/0e/2a/e2/0e2ae21aa010d78c7a27a0287748c093.jpg" class="block object-cover w-full h-full cursor-pointer" alt="Slide 1" onclick="openModal(this)">
            </div>
            <!-- Slide 2 -->
            <div class="absolute inset-0 transition-transform duration-500 transform translate-x-full carousel-item">
                <img src="https://i.pinimg.com/474x/2d/16/2c/2d162c7e97143e38ac32e0587e92f09e.jpg" class="block object-cover w-full h-full cursor-pointer" alt="Slide 2" onclick="openModal(this)">
            </div>
            <!-- Slide 3 -->
            <div class="absolute inset-0 transition-transform duration-500 transform translate-x-full carousel-item">
                <img src="https://i.pinimg.com/474x/8c/c4/8b/8cc48bd6aa94d83d6d43e90f2e40517d.jpg" class="block object-cover w-full h-full cursor-pointer" alt="Slide 3" onclick="openModal(this)">
            </div>
        </div>

        <!-- Slider controls -->
        <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" onclick="prevSlide()">
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full shadow-md bg-white/30 group-hover:bg-white/50">
                <svg class="w-4 h-4 text-red-700 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" onclick="nextSlide()">
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full shadow-md bg-white/30 group-hover:bg-white/50">
                <svg class="w-4 h-4 text-red-700 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>

        <!-- Slide indicators -->
        <div class="absolute left-0 right-0 flex justify-center space-x-3 bottom-4">
            <button class="w-3 h-3 bg-gray-300 rounded-full focus:outline-none" onclick="currentSlide(0)" aria-label="Slide 1"></button>
            <button class="w-3 h-3 bg-gray-300 rounded-full focus:outline-none" onclick="currentSlide(1)" aria-label="Slide 2"></button>
            <button class="w-3 h-3 bg-gray-300 rounded-full focus:outline-none" onclick="currentSlide(2)" aria-label="Slide 3"></button>
        </div>
    </div>

    <!-- Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-75">
        <span class="absolute top-0 right-0 p-4 text-2xl text-red-500 cursor-pointer" onclick="closeModal()">&times;</span>
        <img class="object-contain w-auto h-auto max-w-full max-h-full" id="modalImage" alt="Modal Image">
    </div>

    <div class="py-3 content-text">
        <p class="text-sm font-light text-gray-500">Kecamatan Serpong, Kelurahan Buaran, 28 Aug 2024</p>
        <p class="pt-2 overflow-hidden text-sm">izin melapor bahwa di tempat kami sedang terjadi kelangkaan gas elpiji 3kg..di karenakan banyak warga yang menyalahgunakan untuk mesin pengairan sawah..sehingga kebutuhan warga untuk memasak jadi terhalang..mohon segera di tindak lanjuti..tks</p>
    </div>

    <div class="col-span-1 justify-self-end">
        <span class="px-2 py-1 text-sm rounded-full bg-cyan-100 text-cyan-600">Diverifikasi</span>
        <span class="px-2 py-1 text-sm text-gray-600 bg-gray-100 rounded-full">Publik</span>
    </div>
</div>

<!-- Script -->
<script>
    let currentIndex = 0;
    const slides = document.querySelectorAll('.carousel-item');
    const indicators = document.querySelectorAll('.absolute button');

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.transform = `translateX(${(i - index) * 100}%)`;
        });
        indicators.forEach((indicator, i) => {
            indicator.classList.toggle('bg-red-700', i === index);
            indicator.classList.toggle('bg-gray-300', i !== index);
        });
    }

    function prevSlide() {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : slides.length - 1;
        showSlide(currentIndex);
    }

    function nextSlide() {
        currentIndex = (currentIndex < slides.length - 1) ? currentIndex + 1 : 0;
        showSlide(currentIndex);
    }

    function currentSlide(index) {
        currentIndex = index;
        showSlide(currentIndex);
    }

    // Initialize the carousel
    showSlide(currentIndex);

    function openModal(image) {
        const modal = document.getElementById("imageModal");
        const modalImg = document.getElementById("modalImage");
        modal.classList.remove('hidden');
        modalImg.src = image.src;
    }

    function closeModal() {
        const modal = document.getElementById("imageModal");
        modal.classList.add('hidden');
    }
</script>