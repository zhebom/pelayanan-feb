<!-- Page Heading -->

<div class="container-fluid">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                    </div>
    <div class="container">
        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>

        <form action='<?= base_url("mahasiswa/update/" . $thakademik['id_akademik']); ?>' method="post">
            <div class="row mb-3">
                <input type="text" id="idakademik" name="idakademik" value="<?= $thakademik['id_akademik']; ?>" hidden>
            </div>
            
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tahun Akademik</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control  ?>" id="thakademik" name="thakademik" value="<?= $thakademik['tahun_akademik']; ?>">
                   
                        </button>
                        <a class=" btn btn-success btn-sm mt-2">Contoh : 2022/2023</a>
                </div>

            </div>



    <button type="submit" class="btn btn-primary">Update Profil</button>

    </form>
    </div>
    </div>
    </div>
                                                                        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>