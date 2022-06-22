<div class="text-left">

    <hr>
    <p>Dengan hormat, salah satu syarat untuk menyelesaikan program sarjana (S1)
        Fakultas Ekonomi dan Bisnis mahasiswa di wajibkan mengadakan penelitian
        sebagai bahan menyusun skripsi.
        Berkenaan dengan hal itu, mohon perkenaan Bapak membantu memberi data
        yang diperlukan dalam penelitian tersebut kepada mahasiswa :</p>


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
            <td>Judul Skripsi</td>
            <td>:</td>
            <td><?= $profil['alamat_user']; ?></td>
        </tr>


    </table>
    <br>

    <p>Atas bantuan dan kerja sama yang baik kami ucapkan terima kasih,</p>
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