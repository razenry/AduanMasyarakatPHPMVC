
</main>

<!-- Library Bundle Script -->
<script src="<?= Routes::public('assets/js/core/libs.min.js') ?>"></script>

<!-- External Library Bundle Script -->
<script src="<?= Routes::public('assets/js/core/external.min.js') ?>"></script>

<!-- Widgetchart Script -->
<script src="<?= Routes::public('assets/js/charts/widgetcharts.js') ?>"></script>

<!-- mapchart Script -->
<script src="<?= Routes::public('assets/js/charts/vectore-chart.js') ?>"></script>
<script src="<?= Routes::public('assets/js/charts/dashboard.js') ?>"></script>

<!-- fslightbox Script -->
<script src="<?= Routes::public('assets/js/plugins/fslightbox.js') ?>"></script>

<!-- Settings Script -->
<script src="<?= Routes::public('assets/js/plugins/setting.js') ?>"></script>

<!-- Slider-tab Script -->
<script src="<?= Routes::public('assets/js/plugins/slider-tabs.js') ?>"></script>

<!-- Form Wizard Script -->
<script src="<?= Routes::public('assets/js/plugins/form-wizard.js') ?>"></script>

<!-- AOS Animation Plugin-->

<!-- App Script -->
<script src="<?= Routes::public('assets/js/hope-ui.js') ?>" defer></script>

<!-- Flatpickr Script -->
<script src="<?= Routes::public('assets/vendor/flatpickr/dist/flatpickr.min.js') ?>"></script>
<script src="<?= Routes::public('assets/js/plugins/flatpickr.js') ?>" defer></script>

<!-- Font Awsome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
  integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="<?= Routes::public('assets/js/plugins/prism.mini.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.getElementById('logoutButton').addEventListener('click', function() {
    Swal.fire({
      title: 'Yakin untuk keluar ?',
      text: "Kamu akan di kembalikan ke halaman masuk.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Keluar!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '<?= Routes::base('admin/logout') ?>';
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



</body>

</html>