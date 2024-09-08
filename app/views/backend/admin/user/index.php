<?php

$title = $data['title'];
$target = $data['target'];

?>

<div class="container-fluid content-inner mt-n5 py-0">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Data <?= $title ?></h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                Tambah
            </button>
        </div>
        <div class="card-body">
            <!-- <p>Images in Bootstrap are made responsive with <code>.img-fluid</code>. <code>max-width: 100%;</code> and <code>height: auto;</code> are applied to the image so that it scales with the parent element.</p> -->
            <div class="table-responsive">
                <table id="datatable" class="table table-striped" data-toggle="data-table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama</th>
                            <?php if ($title == "Petugas") :  ?>
                                <th class="">Level</th>
                            <?php else :  ?>
                                <th class="">Email</th>
                            <?php endif;  ?>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($data['pengguna'] as $pengguna): ?>
                            <tr>

                                <td class="text-center"><?= $i ?></td>
                                <td><?= $pengguna['nama'] ?></td>
                                <?php if ($title == "Petugas") :  ?>
                                    <td class=""><?= $pengguna['level'] ?></td>
                                <?php else :  ?>
                                    <td class=""><?= $pengguna['email'] ?></td>
                                <?php endif;  ?>
                                <td class="text-center">
                                    <form action="<?= Routes::base($target . "/status") ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $pengguna['id'] ?>">
                                        <?php if ($pengguna['status'] == 1): ?>

                                            <input type="hidden" name="status" value="0">
                                            <button type="submit"
                                                class="btn btn-success btn-sm rounded-pill fw-bold fs-6">
                                                <i class="fa-solid fa-toggle-on"></i>
                                            </button>
                                        <?php else: ?>

                                            <input type="hidden" name="status" value="1">
                                            <button type="submit"
                                                class="btn btn-danger btn-sm rounded-pill fw-bold fs-6">
                                                <i class="fa-solid fa-toggle-off"></i>
                                            </button>
                                        <?php endif; ?>
                                    </form>
                                </td>
                                <td class="text-center d-flex align-items-center gap-3 justify-content-center">
                                    <button type="button" class="btn btn-info btn-sm " data-bs-toggle="modal"
                                        data-bs-target="#detail<?= $i ?>"><i class="fa-solid fa-eye"></i></button>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#edit<?= $i ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <form id="delete-form<?= $pengguna['id'] ?>" method="POST" action="<?= Routes::base(($target . "/delete")); ?>">
                                        <input type="hidden" name="id" value="<?= $pengguna['id']; ?>">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('<?= $pengguna['id']; ?>')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <script>
                                function confirmDelete(id) {
                                    Swal.fire({
                                        title: 'Konfirmasi Hapus',
                                        text: "Anda yakin ingin menghapus pengguna ini?",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Hapus',
                                        cancelButtonText: 'Batal'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Jika user mengkonfirmasi hapus, submit form yang sesuai dengan ID
                                            document.getElementById('delete-form' + id).submit();
                                        }
                                    });
                                }
                            </script>


                            <!-- Modal Info -->
                            <div class="modal fade" id="detail<?= $i ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Pengguna</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form class="was-validated" method="POST"
                                            action="<?= Routes::base("") ?>">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nama <?= $title ?></label>
                                                    <input class="form-control" name="name" id="name"
                                                        value="<?= $pengguna['nama'] ?>"
                                                        disabled>
                                                </div>

                                                <div class="mb-3 d-flex align-items-center justify-content-center">
                                                    <?php if (!empty($pengguna['foto'])): ?>
                                                        <img src="<?= Routes::storage("users/" . $pengguna['foto']) ?>" alt="<?= $pengguna['nama'] ?>" width="" class="w-75">
                                                    <?php else: ?>
                                                        No Image
                                                    <?php endif; ?>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email <?= $title ?></label>
                                                    <input class="form-control" name="email" id="email"
                                                        value="<?= $pengguna['email'] ?>"
                                                        disabled>
                                                </div>

                                                <?php if ($title == "Petugas") : ?>
                                                    <div class="mb-3">
                                                        <label for="level" class="form-label">Level <?= $title ?></label>
                                                        <input class="form-control" name="level" id="level"
                                                            value="<?= $pengguna['level'] ?>"
                                                            disabled>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="mnt-3">
                                                    <label for="telp" class="form-label">Nomor Telepon</label>
                                                    <?php if ($pengguna['telp'] != null): ?>

                                                        <input class="form-control" name="telp" id="telp"
                                                            value="<?= $pengguna['telp'] ?>"
                                                            disabled>
                                                    <?php else: ?>

                                                        <input class="form-control" name="telp" id="telp"
                                                            value="-"
                                                            disabled>
                                                    <?php endif; ?>

                                                </div>

                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status <?= $title ?></label>
                                                    <input class="form-control" name="status" id="status"
                                                        value="<?php if ($pengguna['status'] == 1): echo "Aktif";
                                                                else: echo "Tidak Aktif";
                                                                endif; ?>"
                                                        disabled>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal">Ok</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="edit<?= $i++ ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit <?= $title ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form class="was-validated" method="POST" enctype="multipart/form-data"
                                            action="<?= Routes::base($target . "/update") ?>">
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?= $pengguna['id'] ?>">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama <?= $title ?> <span class="text-danger">*</span></label>
                                                    <input class="form-control" name="nama" id="nama" placeholder="Abdul Jabbar" value="<?= $pengguna['nama'] ?>" required>
                                                    <div class="invalid-feedback">
                                                        Masukan nama lengkap
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="foto" class="form-label">Foto <?= $title ?> <span class="text-danger">*</span></label>
                                                    <input type="file" class="form-control" name="foto" id="foto">
                                                    <div class="invalid-feedback">Masukan foto <span class="text-primary">(png, jpg, jpeg)</span></div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email <?= $title ?> <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="email" name="email" id="email" placeholder="example@example.com" value="<?= $pengguna['email'] ?>" required>
                                                    <div class="invalid-feedback">
                                                        Masukan email aktif
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="password" min="8" name="password" id="password" placeholder="">
                                                    <div class="invalid-feedback">
                                                        Masukan password minimal 8 karakter
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="konfirmasi_password" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="password" min="8" name="konfirmasi_password" id="konfirmasi_password" placeholder="">
                                                    <div class="invalid-feedback">
                                                        Konfirmasi password
                                                    </div>
                                                </div>

                                                <div class="mnt-3">
                                                    <label for="telp" class="form-label">Nomor Telepon</label>
                                                    <?php if (isset($pengguna['telp'])): ?>

                                                        <input class="form-control" name="telp" id="telp"
                                                            value="<?= $pengguna['telp'] ?>">
                                                    <?php else: ?>

                                                        <input class="form-control" name="telp" id="telp"
                                                            value="-"
                                                            disabled>
                                                    <?php endif; ?>

                                                </div>

                                                <div class="mnt-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <?php if ($pengguna['status'] == 1): ?>

                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="active"
                                                                value="1" name="status" checked>
                                                            <label class="form-check-label" for="active">Aktif</label>
                                                        </div>
                                                        <div class="form-check mb-3">
                                                            <input type="radio" class="form-check-input" id="non_active"
                                                                value="0" name="status">
                                                            <label class="form-check-label"
                                                                for="non_active">Tidak Aktif</label>
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                    <?php else: ?>

                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="active"
                                                                value="1" name="status" required>
                                                            <label class="form-check-label" for="active">Aktif</label>
                                                        </div>
                                                        <div class="form-check mb-3">
                                                            <input type="radio" class="form-check-input" id="non_active"
                                                                value="0" name="status" checked required>
                                                            <label class="form-check-label"
                                                                for="non_active">Tidak Aktif</label>
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                    <?php endif; ?>

                                                </div>

                                                <?php if ($title == "Petugas") : ?>
                                                    <?php if ($pengguna['level'] == "Admin") : ?>
                                                        <div class="mt-3">
                                                            <label for="level" class="form-label">Level</label>
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input" id="admin" value="Admin" name="level" checked required>
                                                                <label class="form-check-label" for="admin">Admin</label>
                                                            </div>
                                                            <div class="form-check mb-3">
                                                                <input type="radio" class="form-check-input" id="petugas" value="Petugas" name="level" required>
                                                                <label class="form-check-label" for="petugas">Petugas</label>
                                                                <div class="invalid-feedback">Pilih level petugas</div>
                                                            </div>
                                                        </div>
                                                    <?php else : ?>
                                                        <div class="mt-3">
                                                            <label for="level" class="form-label">Level</label>
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input" id="admin" value="Admin" name="level" required>
                                                                <label class="form-check-label" for="admin">Admin</label>
                                                            </div>
                                                            <div class="form-check mb-3">
                                                                <input type="radio" class="form-check-input" id="petugas" value="Petugas" name="level" checked required>
                                                                <label class="form-check-label" for="petugas">Petugas</label>
                                                                <div class="invalid-feedback">Pilih level petugas</div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" name="add" class="btn btn-primary">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama</th>
                            <?php if ($title == "Petugas") :  ?>
                                <th class="">Level</th>
                            <?php else :  ?>
                                <th class="">Email</th>
                            <?php endif;  ?>
                            <th class="">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>