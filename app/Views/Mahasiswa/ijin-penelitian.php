<body>
    <div class="container">
        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>

        <form action='<?= base_url("pages/updateip/" . $id_user); ?>' method="post">
            <div class="row mb-3">
                <input type="text" id="id_user" name="id_user" value="<?= $profil['id_user']; ?>" hidden>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">NPM </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= ($validasi->hasError('npm') ? 'is-invalid' : ''); ?>" id="npm" name="npm" autofocus value="<?= $profil['npm_user']; ?>" aria-label="Disabled input example" disabled>
                    <?php if (!empty($validasi->getError('npm'))) { ?>
                        <button class="btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('npm');
                                                                        } ?>
                        </button>



                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validasi->hasError('nama') ? 'is-invalid' : ''); ?>" id="nama" name="nama" value="<?= $profil['nama_user']; ?>">
                    <?php if (!empty($validasi->getError('nama'))) { ?>
                        <button class=" btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('nama');
                                                                            } ?>
                        </button>
                </div>

            </div>
            
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-10">

                    <select class="form-select" aria-label="Default select example" id='jurusan' name="jurusan">

                        ?></option>
                        <?php $select = $profil['jurusan_user'];
                        foreach ($jurusan as $j) : ?>
                            <option value="<?= $j['id_jurusan']; ?> " <?php if ($select == $j['id_jurusan']) {
                                                                            echo "selected";
                                                                        } ?>>
                                <?= $j["nama_jurusan"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (!empty($validasi->getError('jurusan'))) { ?>
                        <button class=" btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('jurusan');
                                                                            } ?>
                        </button>
                </div>
            </div>
           
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Judul Skripsi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validasi->hasError('skripsi_user') ? 'is-invalid' : ''); ?>" id="skripsi" name="skripsi" value="<?= $profil['skripsi_user']; ?>">
                    <?php if (!empty($validasi->getError('skripsi_user'))) { ?>
                        <button class=" btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('skripsi_user');
                                                                            } ?>
                        </button>
                </div>
                                                                        </div>
                <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Institusi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validasi->hasError('institusi_user') ? 'is-invalid' : ''); ?>" id="institusi_user" name="institusi_user" value="<?= $profil['institusi_user']; ?>">
                    <?php if (!empty($validasi->getError('institusi_user'))) { ?>
                        <button class=" btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('institusi_user');
                                                                            } ?>
                        </button>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Alamat Institusi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validasi->hasError('alis_user') ? 'is-invalid' : ''); ?>" id="alis_user" name="alis_user" value="<?= $profil['alis_user']; ?>">
                    <?php if (!empty($validasi->getError('alis_user'))) { ?>
                        <button class=" btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('alis_user');
                                                                            } ?>
                        </button>
                </div>


    </div>
    <button type="submit" class="btn btn-primary">Update Profil</button>

    </form>

    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>