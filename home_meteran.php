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
                                <a>Update Meteran</a>
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
                                <div class="row">
                                    <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="">ID Pelanggan</label>
                                        <input type="text" value="<?=$getData['idPelanggan'];?>" class="form-control" disabled>
                                    </div>
                                    </div>
                                    <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="">Meteran</label>
                                        <input type="nomor" name="meteran" value="<?=$getData['meteran'];?>" class="form-control">
                                    </div>
                                    </div>
                                </div>                                  
                                    <div class="form-group mb-3">
                                        <button type="submit" name="update_meteran" class="btn btn-primary float-end">Update Data</button>
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
  