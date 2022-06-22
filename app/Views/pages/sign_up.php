<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pelayanan Online FEB UPS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="<?= base_url(); ?>/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <h1 align="center"><?= esc($title) ?></h1>
    <div class="container">

        <form action='<?= base_url("pages/simpan"); ?>' method="post">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">NPM </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= ($validasi->hasError('npm') ? 'is-invalid' : ''); ?>" id="npm" name="npm" autofocus value="<?= old('npm'); ?>">
                    <?php if (!empty($validasi->getError('npm'))) { ?>
                        <button class="btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('npm');
                                                                        } ?>
                        </button>



                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validasi->hasError('nama') ? 'is-invalid' : ''); ?>" id="nama" name="nama" value="<?= old('nama'); ?>">
                    <?php if (!empty($validasi->getError('nama'))) { ?>
                        <button class=" btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('nama');
                                                                            } ?>
                        </button>
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control <?= ($validasi->hasError('email') ? 'is-invalid' : ''); ?>" id="email" name="email" value="<?= old('email'); ?>">
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
                        <?php foreach ($jurusan as $j) : ?>
                            <option value="<?= $j['id_jurusan']; ?>">
                                <?= $j["nama_jurusan"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validasi->hasError('alamat') ? 'is-invalid' : ''); ?>" id="alamat" name="alamat" value="<?= old('alamat'); ?>">
                    <?php if (!empty($validasi->getError('alamat'))) { ?>
                        <button class=" btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('alamat');
                                                                            } ?>
                        </button>
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validasi->hasError('tempatlahir') ? 'is-invalid' : ''); ?>" id="tempatlahir" name="tempatlahir" value="<?= old('tempatlahir'); ?>">
                    <?php if (!empty($validasi->getError('tempatlahir'))) { ?>
                        <button class=" btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('tempatlahir');
                                                                            } ?>
                        </button>
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control <?= ($validasi->hasError('tanggallahir') ? 'is-invalid' : ''); ?>" id="tanggallahir" name="tanggallahir" value="<?= old('tanggallahir'); ?>">
                    <?php if (!empty($validasi->getError('tanggallahir'))) { ?>
                        <button class=" btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('tanggallahir');
                                                                            } ?>
                        </button>
                </div>

            </div>

            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label"> Buat Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control <?= ($validasi->hasError('pass') ? 'is-invalid' : ''); ?>" id="pass" name="pass">
                    <?php if (!empty($validasi->getError('pass'))) { ?>
                        <button class="btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('pass');
                                                                        } ?>
                        </button>
                </div>

            </div>

            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Ulang Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control <?= ($validasi->hasError('passconf') ? 'is-invalid' : ''); ?>" id="passconf" name="passconf">
                    <?php if (!empty($validasi->getError('passconf'))) { ?>
                        <button class="btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('passconf');
                                                                        } ?>
                        </button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>

        </form>

    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>