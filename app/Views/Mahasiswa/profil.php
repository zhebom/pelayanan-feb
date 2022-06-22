<body>
    <div class="container">
        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>

        <form action='<?= base_url("pages/update/" . $id_user); ?>' method="post">
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
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control <?= ($validasi->hasError('email') ? 'is-invalid' : ''); ?>" id="email" name="email" value="<?= $profil['email_user']; ?>">
                    <?php if (!empty($validasi->getError('email'))) { ?>
                        <button class=" btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('email');
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
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validasi->hasError('alamat') ? 'is-invalid' : ''); ?>" id="alamat" name="alamat" value="<?= $profil['alamat_user']; ?>">
                    <?php if (!empty($validasi->getError('alamat'))) { ?>
                        <button class=" btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('alamat');
                                                                            } ?>
                        </button>
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validasi->hasError('tempatlahir') ? 'is-invalid' : ''); ?>" id="tempatlahir" name="tempatlahir" value="<?= $profil['tempat_user']; ?>">
                    <?php if (!empty($validasi->getError('tempatlahir'))) { ?>
                        <button class=" btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('tempatlahir');
                                                                            } ?>
                        </button>
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control <?= ($validasi->hasError('tanggallahir') ? 'is-invalid' : ''); ?>" id="tanggallahir" name="tanggallahir" value="<?= $profil['lahir_user']; ?>">
                    <?php if (!empty($validasi->getError('tanggallahir'))) { ?>
                        <button class=" btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('tanggallahir');
                                                                            } ?>
                        </button>
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Semester</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validasi->hasError('semester_user') ? 'is-invalid' : ''); ?>" id="semester_user" name="semester_user" value="<?= $profil['semester_user']; ?>">
                    <?php if (!empty($validasi->getError('semester_user'))) { ?>
                        <button class=" btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('semester_user');
                                                                            } ?>
                        </button>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Ortu</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validasi->hasError('ortu_user') ? 'is-invalid' : ''); ?>" id="ortu_user" name="ortu_user" value="<?= $profil['ortu_user']; ?>">
                    <?php if (!empty($validasi->getError('ortu_user'))) { ?>
                        <button class=" btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('ortu_user');
                                                                            } ?>
                        </button>
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Pekerjaan Ortu</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validasi->hasError('kerja_user') ? 'is-invalid' : ''); ?>" id="kerja_user" name="kerja_user" value="<?= $profil['kerja_user']; ?>">
                    <?php if (!empty($validasi->getError('kerja_user'))) { ?>
                        <button class=" btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('kerja_user');
                                                                            } ?>
                        </button>
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Golongan / Pangkat Orang Tua</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validasi->hasError('pangkat_user') ? 'is-invalid' : ''); ?>" id="pangkat_user" name="pangkat_user" value="<?= $profil['pangkat_user']; ?>">
                    <?php if (!empty($validasi->getError('pangkat_user'))) { ?>
                        <button class=" btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('pangkat_user');
                                                                            } ?>
                        </button>
                        <a class=" btn btn-success btn-sm mt-2">Contoh : Penata Muda / IV A</a>
                </div>

            </div>


    </div>
    <button type="submit" class="btn btn-primary">Update Profil</button>

    </form>

    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>