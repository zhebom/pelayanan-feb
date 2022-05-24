<div class="container">
    <form action='<?= base_url("pages/simpan"); ?>' method="post">
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">NPM </label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="npm" name="npm" autofocus>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email">
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
                <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Tempat Lahir</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="tempatlahir" name="tempatlahir">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="tanggallahir" name="tanggallahir">
            </div>
        </div>

        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label"> Buat Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="pass" name="pass">
            </div>
        </div>

        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Ulang Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="pass">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Daftar</button>

    </form>
</div>
</div>