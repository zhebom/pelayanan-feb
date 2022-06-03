<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">NPM</th>
            <th scope="col">Nama Lengkap</th>
            <th scope="col">Jurusan</th>
            <th scope="col">Aksi</th>

        </tr>
    </thead>
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

                        <button class="btn btn-success" href="#">Detail</button>
                        <button class="btn btn-warning" href="#">Reset</button>


                    </td>
        </tr>
    <?php endforeach;
            } else {

    ?>
    <th colspan="5">Data Tidak Ditemukan</th>
<?php
            } ?>


    </tbody>
</table>