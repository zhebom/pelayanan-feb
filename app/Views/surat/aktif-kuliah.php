<div class="container-fluid">
<div class="card-body">

    <hr>
    <p>Dekan Fakultas Ekonomi dan Bisnis Universitas Pancasakti Tegal menerangkan dengan
        sebenarnya bahwa :</p>


    <table>
        <?php
        ?>

        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?= $profil['nama_user']; ?></td>
        </tr>
        <tr>
            <td>NPM</td>
            <td>:</td>
            <td><?= $profil['npm_user']; ?></td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>:</td>
            <td><?php $jur = $profil['jurusan_user'];
                switch ($jur) {
                    case 1:
                        echo "Manajemen";
                        $jur1 = "Manajemen";
                        break;
                    case 2:
                        echo "Akuntansi";
                        $jur1 = "Akuntansi";
                        break;
                    case 3:
                        echo "Bisnis Digital";
                        $jur1 = "Bisnis Digital";
                        break;
                    case 4:
                        echo "D3 - Manajemen Perpajakan";
                        $jur1 = "D3 - Manajemen Perpajakan";
                        break;
                    default:
                        echo "anda belum memilih jurusan";
                        break;
                }
                ?></td>
        </tr>
        <tr>
            <td>Tempat, Tanggal Lahir</td>
            <td>:</td>
            <td><?= $profil['tempat_user']; ?>, <?php $day = explode("-", $profil['lahir_user']);
                                                echo $day[2];
                                                echo "-";
                                                echo $day[1];
                                                echo "-";
                                                echo $day[0];
                                                ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?= $profil['alamat_user']; ?></td>
        </tr>
        <tr>
            <td>Semester</td>
            <td>:</td>
            <td><?= $profil['semester_user']; ?></td>
        </tr>

    </table>
    <br>

    <p>Mahasiswa tersebut di atas adalah anak dari orang tua :</p>
    <table>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?= $profil['ortu_user']; ?></td>
        </tr>
        <tr>
            <td>Instansi</td>
            <td>:</td>
            <td><?= $profil['kerja_user']; ?></td>
        </tr>
        <tr>
            <td>Pangkat/Golongan</td>
            <td>:</td>
            <td><?= $profil['pangkat_user']; ?></td>
        </tr>
    </table>

    <a class="btn btn-success" href="<?= base_url('profil'); ?>">
        Ubah Data
    </a>
    <a class="btn btn-danger" href="<?= base_url('pages/aktifkuliah/'); ?>">
        Cetak Surat
    </a>
</div>
</div>