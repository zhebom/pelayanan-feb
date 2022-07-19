<div id="wrapper">

    

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

               

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                    </div>

                    <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Tahun Akademik</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= 
                                            $thakademik['tahun_akademik'];?></div>
                                           <a class="btn btn-danger btn-sm mt-2" href="/tahunakd">Set Tahun Akademik</a>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Surat Dibuat</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalsurat; ?></div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Annual) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                              Surat Dikonfirmasi</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $suratkonfirm; ?></div>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>

                         <!-- Earnings (Annual) Card Example -->
                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                             Total Akun Hingga Saat Ini</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalakun; ?></div>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->