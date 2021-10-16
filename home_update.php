<?php
include('auth.php');
include('src/header.php');
?>

    <div id="layoutSidenav_content">
        <main>
        <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                            if(isset($_SESSION['status'])) {
                                echo "<h5 class='alert alert-sucess'>".$_SESSION['status']."</h5>";
                                unset($_SESSION['status']);
                            }
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <a>Update Data User</a>
                                <a href="home_index.php" class="btn btn-danger float-end">Kembali</a>
                            </div>
                            <div class="card-body">
                            <?php
                            include('dbcon.php');
                            if(isset($_GET['id'])) {
                                $key_child = $_GET['id'];

                                $ref_table = "data_user";
                                $getData = $database->getReference($ref_table)->getChild($key_child)->getValue();

                                if($getData > 0) {

                                ?>
                                <form action="function.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="key" value="<?=$key_child;?>">
                                <input type="hidden" name="bemail" value="<?=$getData['email'];?>">
                                <input type="hidden" name="bnama" value="<?=$getData['nama'];?>">
                                <div class="row">
                                    <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="">Nama Lengkap</label>
                                        <input type="text" name="nama" value="<?=$getData['nama'];?>" class="form-control">
                                    </div>
                                    </div>
                                    <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="">Email</label>
                                        <input type="email" name="email" value="<?=$getData['email'];?>" class="form-control">
                                    </div>
                                    </div>
                                    <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="">Jenis Kelamin</label>
                                        <select name="jKelamin" class="form-control" value="<?=$getData['jKelamin'];?>">
                                        <option value="<?=$getData['jKelamin'];?>"><?php echo $getData['jKelamin'];?></option>
                                            <?php
                                                if ($getData['jKelamin'] == "Laki-Laki") {
                                                echo '<option value="Perempuan">Perempuan</option>';
                                                } else {
                                                echo '<option value="Laki-Laki">Laki-Laki</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="">Nomor Hp</label>
                                        <input type="number" name="nomor" value="<?=$getData['nomor'];?>" class="form-control">
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="">Pilih Paket</label>
                                        <select name="paket" class="form-control" value="<?=$getData['paket'];?>">
                                        <option value="<?=$getData['paket'];?>"><?php echo $getData['paket'] == "R1" ? 'Paket 1' : 'Paket 2' ?></option>
                                            <?php
                                                if ($getData['paket'] == "R1") {
                                                echo '<option value="R2">Paket 2</option>';
                                                } else {
                                                echo '<option value="R1">Paket 1</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="">ID</label>
                                        <input type="number" name="idPelanggan" value="<?=$getData['idPelanggan'];?>" class="form-control">
                                    </div>
                                    </div>
                                </div>
                                    <div class="form-group mb-3">
                                        <label for="">Alamat</label>
                                        <textarea class="form-control" value="<?=$getData['alamat'];?>" name="alamat" rows="10"><?=$getData['alamat'];?></textarea>
                                    </div>                                    
                                    <div class="form-group mb-3">
                                        <button type="submit" name="update_user" class="btn btn-primary float-end">Update Data</button>
                                    </div>
                                </form>
                                <?php
                                } else {
                                    $_SESSION['status'] = "Data Tidak ditemukan";
                                    header('Location:index.php');
                                    exit();
                                }
                            } else {
                            $_SESSION['status'] = "User tidak di temukan";
                                header('Location:index.php');
                                exit();
                            }
                            ?>
                            </div>
                        </div>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </main>
    </div>

<?php
include('src/footer.php');
?>
  