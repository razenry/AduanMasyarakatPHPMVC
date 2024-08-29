<!-- Library Bundle Script -->
<script src="<?= baseUrl('assets/js/core/libs.min.js') ?>"></script>

<!-- External Library Bundle Script -->
<script src="<?= baseUrl('assets/js/core/external.min.js') ?>"></script>

<!-- Widgetchart Script -->
<script src="<?= baseUrl('assets/js/charts/widgetcharts.js') ?>"></script>

<!-- mapchart Script -->
<script src="<?= baseUrl('assets/js/charts/vectore-chart.js') ?>"></script>
<script src="<?= baseUrl('assets/js/charts/dashboard.js') ?>"></script>

<!-- fslightbox Script -->
<script src="<?= baseUrl('assets/js/plugins/fslightbox.js') ?>"></script>

<!-- Settings Script -->
<script src="<?= baseUrl('assets/js/plugins/setting.js') ?>"></script>

<!-- Slider-tab Script -->
<script src="<?= baseUrl('assets/js/plugins/slider-tabs.js') ?>"></script>

<!-- Form Wizard Script -->
<script src="<?= baseUrl('assets/js/plugins/form-wizard.js') ?>"></script>

<!-- AOS Animation Plugin-->

<!-- App Script -->
<script src="<?= baseUrl('assets/js/hope-ui.js') ?>" defer></script>

<!-- Flatpickr Script -->
<script src="<?= baseUrl('assets/vendor/flatpickr/dist/flatpickr.min.js') ?>"></script>
<script src="<?= baseUrl('assets/js/plugins/flatpickr.js') ?>" defer></script>

<!-- Font Awsome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
  integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="<?= baseUrl('assets/js/plugins/prism.mini.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.getElementById('logoutButton').addEventListener('click', function () {
    Swal.fire({
      title: 'Sure to logout ?',
      text: "You will directed to login.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, logout!',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        // Ganti URL dengan halaman logout yang sesuai
        window.location.href = '<?= baseUrl('admin/logout') ?>';
      }
    });
  });
</script>


<?php if (isset($_SESSION['berhasil_login'])): ?>
  <script>
    Swal.fire({
      icon: "success",
      title: "Login Success",
      text: "<?= $_SESSION['berhasil_login'] ?>"
    });
  </script>

  <?php unset($_SESSION['berhasil_login']); ?>

<?php endif; ?>

<?php if (isset($_SESSION['gagal'])): ?>
  <script>
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "<?= $_SESSION['gagal'] ?>"
    });
  </script>

  <?php unset($_SESSION['gagal']); ?>

<?php endif; ?>

<?php if (isset($_SESSION['berhasil'])): ?>
  <script>
    Swal.fire({
      icon: "success",
      title: "Success",
      text: "<?= $_SESSION['berhasil'] ?>"
    });
  </script>

  <?php unset($_SESSION['berhasil']); ?>

<?php endif; ?>

<script>
  function confirmDelete() {
    Swal.fire({
      title: 'Konfirmasi Hapus',
      text: "Anda yakin ingin menghapus category ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        // Jika user mengkonfirmasi hapus, submit form
        document.getElementById('delete-form').submit();
      }
    });
  }
</script>

</body>

</html>