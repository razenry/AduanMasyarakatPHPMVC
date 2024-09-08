<!-- views/backend/templates/modals/verify_modal.php -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="verifyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verifyModalLabel">Tolak Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= Routes::base('dataLaporan/status') ?>" method="post">
                <div class="modal-body">
                    <!-- Form to verify the report -->
                    <input type="hidden" name="slug" value="<?= htmlspecialchars($laporan['slug'], ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($laporan['id'], ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="status" value="Ditolak">
                    <p>Apakah anda ingin menolak laporan? </p>
                    <!-- Additional form fields or details can go here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>