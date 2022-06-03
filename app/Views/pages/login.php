<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pelayanan Online FEB UPS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>
        <form action="<?= base_url('/pages/login') ?>">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label ">NPM</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= ($validasi->hasError('npm') ? 'is-invalid' : ''); ?>" id="npm" name="npm" autofocus value="<?= old('npm'); ?>">
                    <?php if (!empty($validasi->getError('npm'))) { ?>
                        <button class="btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('npm');
                                                                        } ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control <?= ($validasi->hasError('pass') ? 'is-invalid' : ''); ?>" id="pass" name="pass">
                    <?php if (!empty($validasi->getError('pass'))) { ?>
                        <button class="btn btn-danger btn-sm mt-2" disabled><?= $validasi->getError('pass');
                                                                        } ?>
                        </button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
            <a href="<?= base_url('pages/home'); ?>" type="submit" class="btn btn-secondary">Daftar</a>
        </form>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>