<?php

    $title = $data['title'];
    $target= $data['target'];
// $nip = $data['nip'];

?>
<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah <?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body was-validated" method="POST" enctype="multipart/form-data"
                action="<?= Routes::base($target . "/add") ?>">

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama <?= $title ?> <span class="text-danger">*</span></label>
                    <input class="form-control " name="nama" id="nama" placeholder="Abdul Jabbar" required>
                    <div class="invalid-feedback">
                        Masukan nama lengkap
                    </div>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto <?= $title ?> <span class="text-danger">*</span></label>
                    <input type="file" class="form-control " name="foto" id="foto" required>
                    <div class="invalid-feedback">Masukan foto <span class="text-primary">(png, jpg, jpeg)</span></div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email <?= $title ?> <span class="text-danger">*</span></label>
                    <input class="form-control " type="email" name="email" id="email" placeholder="example@example.com" required>
                    <div class="invalid-feedback">
                        Masukan email aktif
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <input class="form-control " type="password" min="8" name="password" id="password" placeholder="" required>
                    <div class="invalid-feedback">
                        Masukan password minimal 8 karakter
                    </div>
                </div>

                <div class="mb-3">
                    <label for="konfirmasi_password" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" min="8" name="konfirmasi_password" id="konfirmasi_password" placeholder="" required>
                    <div class="invalid-feedback">
                        Konfirmasi password
                    </div>
                </div>

                <div class="mb-3">
                    <label for="telp" class="form-label">Nomor Telepon <span class="text-info">(Opsional)</span></label>
                    <input class="form-control " type="telp" name="telp" id="telp" placeholder="08123456789">
                    <div class="was-validated">
                        Masukan no telepon
                    </div>
                </div>

                <div class="mt-3">
                    <label for="status" class="form-label">Status</label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="active" value="1" name="status" required>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                    <div class="form-check mb-3">
                        <input type="radio" class="form-check-input" id="non_active" value="0" name="status" required>
                        <label class="form-check-label" for="non_active">Non-Active</label>
                        <div class="invalid-feedback">Pilih status user</div>
                    </div>
                </div>

                <?php if ($title == "Petugas") : ?>
                    <div class="mt-3">
                    <label for="level" class="form-label">Level</label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="admin" value="Admin" name="level" required>
                        <label class="form-check-label" for="admin">Admin</label>
                    </div>
                    <div class="form-check mb-3">
                        <input type="radio" class="form-check-input" id="petugas" value="Petugas" name="level" required>
                        <label class="form-check-label" for="petugas">Petugas</label>
                        <div class="invalid-feedback">Pilih level petugas</div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" name="add" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>