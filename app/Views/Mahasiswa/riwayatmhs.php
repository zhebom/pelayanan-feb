<?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>
<?php if ($role = 3) {; ?>
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
                                            <th>No Surat</th>
                                            <th>Keperluan</th>
                                          
                                            <th>Aksi</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>No Surat</th>
                                            <th>Keperluan</th> 
                                            <th>Aksi</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <?php
                                        $i = '1';
                if (!empty($histori)) {


                    foreach ($histori as $m) :

                ?>

                        <th>
                            <?= $i++; ?>
                        </th>
                        <td>
                            <?= $m["no_aktifkuliah"]; ?>
                        </td>
                        <td>
                            <?= $m["keterangan_aktifkuliah"]; ?>
                        </td>

                       

                        <td>
                        <?php if ($m['confirm_aktifkuliah']>0){
                      ?>       <button class="btn btn-success" >Telah Disahkan Dapat Diambil</button>
                        <?php }else { ?>
                            <a class="btn btn-danger" >Belum Disahkan</a>
                           

                        <?php } ?>
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

