<?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>
<?php if ($role < 3) {; ?>
    <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NPM</th>
                                            <th>Nama Lengkap</th>
                                            <th>Jurusan</th>
                                            <th>Aksi</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>NPM</th>
                                            <th>Nama Lengkap</th>
                                            <th>Jurusan</th>
                                            <th>Aksi</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <?php
                                        $i = '1';
                if (!empty($mahasiswa)) {


                    foreach ($mahasiswa as $m) :

                ?>

                        <th>
                            <?= $i++; ?>
                        </th>
                        <td>
                            <?= $m["npm_user"]; ?>
                        </td>
                        <td>
                            <?= $m["nama_user"]; ?>
                        </td>

                        <td>
                            <?php
                            $key = $m["jurusan_user"];
                            if ($key == 1) {
                                echo "Manajemen";
                            }
                            if ($key == 2) {
                                echo "Akuntansi";
                            }
                            if ($key == 3) {
                                echo "Bisnis Digital";
                            }
                            if ($key == 4) {
                                echo "Manajemen Perpajakan";
                            }




                            ?>


                        </td>

                        <td>

                            <a class="btn btn-success" href="#">Riwayat Pelayanan</a>
                           <br> <a class="btn btn-warning" href="<?= base_url('mahasiswa/reset/'.$m['id_user']); ?>">Reset Password</a>


                        </td>
            </tr>
        <?php endforeach;
                } else {

        ?>
        <th colspan="5">Data Tidak Ditemukan</th>
    <?php
                } ?>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <?php } else {
?> <button class="btn btn-danger" href="<?= base_url('profil'); ?>">
        Anda tidak punya akses
    </button>
<?php die;
} ?>

