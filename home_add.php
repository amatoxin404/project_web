<?php
include('auth.php');
include('src/header.php');
$fake = isset($_POST['imgFake']);
$real = isset($_POST['imgName']);
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
                <div class="row">
                    <div class="col-md-12">
                        <?php
                            if(isset($_SESSION['status'])) {
                                echo "<h5 class='alert alert-danger'>".$_SESSION['status']."</h5>";
                                unset($_SESSION['status']);
                            }
                        ?>
                        <div class="card">
                            <div class="card-header">
                            <a>Registrasi User</a>
                                <a href="home_index.php" class="btn btn-danger float-end">Kembali</a>
                            </div>
                            <div class="card-body">
                                <form action="function.php" method="POST" enctype="multipart/form-data">
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="">Nama Lengkap</label>
                                        <input placeholder="Mobs" type="text" name="nama" class="form-control">
                                    </div>
                                    </div>
                                    <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="">Email</label>
                                        <input placeholder="XXX@XXX.com" type="email" name="email" class="form-control">
                                    </div>
                                    </div>
                                    <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="">Password</label>
                                        <input placeholder="*********" type="password" name="password" class="form-control">
                                    </div>
                                    </div>
                                    <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="">Jenis Kelamin</label>
                                        <select name="jKelamin" class="form-control">
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="">Pilihan Paket</label>
                                        <select name="paket" class="form-control">
                                            <option value="R1">Paket 1</option>
                                            <option value="R2">Paket 2</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="">Nomor Telpon</label>
                                        <input placeholder="0896XXXXXXXXX" type="number" name="nomor" class="form-control">
                                    </div>
                                    </div>
                                </div>
                                    <div class="form-group mb-3">
                                        <label for="">Alamat</label>
                                        <textarea placeholder="Jln.XXXX Desa XXX Kecematan XXX" class="form-control" name="alamat" rows="10"></textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <button type="submit" name="add_user" class="btn btn-primary float-end">Simpan Data</button>
                                    </div>
                                </form>
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
  