<?php
include('auth.php');
include('src/header.php');
?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Dashboard</h1>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                                if(isset($_SESSION['status'])) {
                                    echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                                    unset($_SESSION['status']);
                                }
                            ?>
                            <!-- buttton tambah data -->
                        <div>
                        <h4>
                            <a href="home_add.php" class="btn btn-primary" > Tambah Data </a>
                        </h4>
                        </div>
                        <!-- Akhir buttton tambah data -->
                            
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID User</th>
                                            <th>Nama Lengkap</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Nomor Hp</th>
                                            <th>Email</th>
                                            <th>Paket</th>
                                            <th>Alamat</th>
                                            <th>Meteran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        include('dbcon.php');
                                        $ref_table = "data_user";
                                        $fetchdata = $database->getReference($ref_table)->getValue();

                                        if($fetchdata > 0) {
                                            $i=1;
                                            foreach($fetchdata as $key => $row) {
                                                ?>
                                                    <tr>
                                                        <td><?=$i++?></td>
                                                        <td><?=$row['idPelanggan'];?></td>
                                                        <td><?=$row['nama'];?></td>
                                                        <td><?=$row['jKelamin'];?></td>
                                                        <td><?=$row['nomor'];?></td>
                                                        <td><?=$row['email'];?></td>
                                                        <td><?=$row['paket'];?></td>
                                                        <td><?=$row['alamat'];?></td>
                                                        <td><?=$row['meteran'];?></td>
                                                        <td class="row justify-content-center">
                                                        <div class="col-sm-12">
                                                            <button style="height: 30px; background-color: transparent;">
                                                                <a href="home_update.php?id=<?=$key;?>" class="col-lg-1">
                                                                <span class="actionCust"> <i class="far fa-edit"></i> </span></a>
                                                            </button>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <button style="height: 50px; background-color: transparent;">
                                                                <a href="home_meteran.php?id=<?=$key;?>" class="col-lg-1">
                                                                <span class="actionCust"> <i class="fas fa-tint"></i> </span></a>
                                                            </button>
                                                        </div>
                                                            <form class="col-sm-12" action="function.php" method="POST">
                                                                <input type="hidden" name="hapus_id" value="<?=$key;?>">
                                                                <input type="hidden" name="imgPath" value="<?=$row['namaKtp'];?>">
                                                                <button style="background-color: transparent;" type="submit" name="del_user">
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
  