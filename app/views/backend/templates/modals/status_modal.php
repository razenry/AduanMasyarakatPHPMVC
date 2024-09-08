<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?= Routes::base('dataLaporan/status') ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Edit Status Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="statusSelect" class="form-label">Pilih Status Baru</label>
                        <select class="form-select" id="statusSelect" name="status" required>
                            <option value="" disabled selected>-- Pilih Status --</option>
                            <option value="Menunggu Tanggapan">Menunggu Tanggapan</option>
                            <option value="Diverifikasi">Verifikasi</option>
                            <option value="Dalam Tindakan">Dalam Tindakan</option>
                            <option value="Tuntas">Tuntas</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                        <div class="invalid-feedback">
                            Silakan pilih status laporan.
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $laporan['id'] ?>">
                    <input type="hidden" name="slug" value="<?= $laporan['slug'] ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
