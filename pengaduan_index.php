<?php
include('auth.php');
include('src/header.php');
?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Pengaduan</h1>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                                if(isset($_SESSION['status'])) {
                                    echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                                    unset($_SESSION['status']);
                                }
                            ?>
                            
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Nomor Hp</th>
                                            <th>Alamat</th>
                                            <th>Keterangan</th>
                                            <th>Gambar</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        include('dbcon.php');
                                        $ref_table = "data_report";
                                        $fetchdata = $database->getReference($ref_table)->getValue();
                                        $update = 'class ="far fa-edit"';
                                        $close = 'class ="far fa-check-square"';

                                        if($fetchdata > 0) {
                                            $i=1;
                                            foreach($fetchdata as $key => $row) {
                                                ?>
                                                    <tr>
                                                        <td><?=$i++?></td>
                                                        <td><?=!$row['nama'] ? "-" : $row['nama'];?></td>
                                                        <td><?=!$row['nomor'] ? "-" : $row['nomor'];?></td>
                                                        <td><?=!$row['alamat'] ? "-" : $row['alamat'];?></td>
                                                        <td><?=!$row['keluhan'] ? "-" : $row['keluhan'];?></td>
                                                        <td><a href="<?=$row['gambar']?>">Link Gambar!</a></td>
                                                        <td><?=!$row['tanggal'] ? "-" : $row['tanggal'];?></td>
                                                        <td><?=!$row['status'] ? "-" : $row['status'];?></td>
                                                        <td class="row justify-content-center">
                                                        <form class="col-md-12" action="function.php" method="POST">
                                                                <input type="hidden" name="update_id" value="<?=$key;?>">
                                                                <input type="hidden" name="status" value="<?=$row['status'];?>">
                                                                <?php
                                                                    if($row['status'] != "Selesai") {
                                                                        echo "<button style='height: 50px; background-color: transparent;' type='submit' name='update_pengaduan'>";
                                                                        echo "<a style='color:blue'><span class='actionCust'><i class='far fa-edit'></i></span></a>";
                                                                        echo "</button>";
                                                                    } else {
                                                                        echo "<a></a>";
                                                                    };
                                                                ?>
                                                            </form>
                                                            <form class="col-md-12" action="function.php" method="POST">
                                                                <input type="hidden" name="hapus_id" value="<?=$key;?>">
                                                                <input type="hidden" name="imgPath" value="<?=$row['namaGambar'];?>">
                                                                <button style="background-color: transparent;" type="submit" name="del_report">
                                                                <a style="color:blue">
                                                                <span class="actionCust"> <i class="far fa-trash-alt"></i></span></a>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="?">Data Kosong Silahkan Tambhkan User Baru </td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
        </main>
    </div>

<?php
include('src/footer.php');
?>
  