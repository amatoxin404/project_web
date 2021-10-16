<?php
include('auth.php');
include('src/header.php');
function getPelangganID($length) {
    $result = '';
    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }
    return $result;
}
?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Data Sambung Baru</h1>
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
                                            <th>Jenis Kelamin</th>
                                            <th>Nomor Hp</th>
                                            <th>Paket</th>
                                            <th>Alamat</th>
                                            <th>KTP</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        include('dbcon.php');
                                        $ref_table = "data_pelanggan";
                                        $fetchdata = $database->getReference($ref_table)->getValue();

                                        if($fetchdata > 0) {
                                            $i=1;
                                            foreach($fetchdata as $key => $row) {
                                                ?>
                                                    <tr>
                                                        <td><?=$i++?></td>
                                                        <td><?=$row['nama'];?></td>
                                                        <td><?=$row['jKelamin'];?></td>
                                                        <td><?=$row['nomor'];?></td>
                                                        <td><?=$row['paket'];?></td>
                                                        <td><?=$row['alamat'];?></td>
                                                        <td><a href="<?=$row['ktp'];?>">Link Gambar!</a></td>
                                                        <td class="row justify-content-center">
                                                        <form class="col-sm-4" action="function.php" method="POST">
                                                            <input type="hidden" name="update_id" value="<?=$key;?>">
                                                            <input type="hidden" name="id" value="<?php echo getPelangganID(10)?>">
                                                            <input type="hidden" name="jKelamin" value="<?=$row['jKelamin'];?>">
                                                            <input type="hidden" name="nomor" value="<?=$row['nomor'];?>">
                                                            <input type="hidden" name="paket" value="<?=$row['paket'];?>">
                                                            <input type="hidden" name="alamat" value="<?=$row['alamat'];?>">
                                                            <input type="hidden" name="ktp" value="<?=$row['ktp'];?>">
                                                            <input type="hidden" name="namaKtp" value="<?=$row['namaKtp'];?>">
                                                            <button style="background-color: transparent;" type="submit" name="sambung_baru">
                                                            <a class="col-lg-1">
                                                            <span class="actionCust"> <i class="far fa-edit"></i></span></a>
                                                            </button>
                                                        </form>
                                                            <form class="col-sm-6" action="function.php" method="POST">
                                                                <input type="hidden" name="hapus_id" value="<?=$key;?>">
                                                                <input type="hidden" name="imgPath" value="<?=$row['namaKtp'];?>">
                                                                <button style="background-color: transparent;" type="submit" name="del_sambung">
                                                                <a class="col-lg-1">
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
  