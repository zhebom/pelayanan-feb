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
                    <?= $m["jurusan_user"]; ?>
                </td>

                <td>

                    <button class="btn btn-success">Detail</button>
                    <button class="btn btn-warning">Ubah Password</button>


                </td>

            <?php endforeach;
        } else {

            ?>
            <th colspan="4">Data Tidak Ditemukan</th>
        <?php
        } ?>


    </tbody>
</table>