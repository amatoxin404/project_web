<?php
session_start();
include('dbcon.php');

if(isset($_POST['add_user'])) {

    $getId = $_POST['id'];
    $id = "01$getId";
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $jKelamin = $_POST['jKelamin'];
    $nomor = $_POST['nomor'];
    $paket = $_POST['paket'];
    $alamat = $_POST['alamat'];

    $userProperties = [
        'email' => $email,
        'emailVerified' => false,
        'password' => $password,
        'displayName' => $nama,
    ];

    $userData = [
        'idPelanggan' => $id,
        'nama' => $nama,
        'email' => $email,
        'jKelamin' => $jKelamin,
        'nomor' => $nomor,
        'paket' => $paket,
        'alamat' => $alamat
    ];

    try {
        $createdUser = $auth->createUser($userProperties);
        $user = $auth->getUserByEmail($email);
        $getuid = $user->uid;
        if ($createdUser) {
            $ref_table = "data_user/$getuid";
            $postRef_result = $database->getReference($ref_table)->set($userData);
            if($postRef_result) {
                $_SESSION['status'] = "Tambah Data Berhasil!";
                header('Location:home_index.php');
            } else {
                $_SESSION['status'] = "Tambah Data User Gagal!";
                header('Location:home_add.php');
            }
        } else {
            $_SESSION['status'] = "Tambah Data Gagal!";
            header('Location:home_add.php');
        }
    } catch (Exception $e) {
        echo 'An error has occurred while working with the SDK: '.$e->getMessage();
        $_SESSION['status'] = 'Warning! - '.$e->getMessage();
            header('Location:home_add.php');
    }

}

if(isset($_POST['update_user'])) {
    
    $key = $_POST['key'];
    $bNama = $_POST['bnama']; 
    $nama = $_POST['nama'];
    $bEmail = $_POST['bemail'];
    $email = $_POST['email'];
    $jKelamin = $_POST['jKelamin'];
    $nomor = $_POST['nomor'];
    $alamat = $_POST['alamat'];
    $paket = $_POST['paket'];
    $id = $_POST['idPelanggan'];

    if ($bNama != $nama && $bEmail != $email) {

        $properties = [
            'displayName' => $nama
        ];

        $userData = [
            'idPelanggan' => $id,
            'nama' => $nama,
            'email' => $email,
            'jKelamin' => $jKelamin,
            'nomor' => $nomor,
            'paket' => $paket,
            'alamat' => $alamat
        ];

        $updatedUser = $auth->updateUser($key, $properties);

        $updatedEmail = $auth->changeUserEmail($key, $email);

        if ($updatedUser && $updatedEmail) {
            $ref_table = 'data_user/'.$key;
            $updateRef_result = $database->getReference($ref_table)->update($userData);
        
            if($updateRef_result) {
                $_SESSION['status'] = "Update Data Nama dan Email Berhasil!";
                header('Location:home_index.php');
            } else {
                $_SESSION['status'] = "Update Data User Gagal!";
                header('Location:home_update.php');
            }
    
        } else {
            $_SESSION['status'] = "Update Data Gagal!";
            header('Location:home_update.php');
        }

    } else if ($bEmail != $email) {

        $userData = [
            'idPelanggan' => $id,
            'nama' => $nama,
            'email' => $email,
            'jKelamin' => $jKelamin,
            'nomor' => $nomor,
            'paket' => $paket,
            'alamat' => $alamat
        ];

        $updatedUser = $auth->changeUserEmail($key, $email);

        if ($updatedUser) {
            $ref_table = 'data_user/'.$key;
            $updateRef_result = $database->getReference($ref_table)->update($userData);
        
            if($updateRef_result) {
                $_SESSION['status'] = "Update Data Email Berhasil!";
                header('Location:home_index.php');
            } else {
                $_SESSION['status'] = "Update Data User Gagal!";
                header('Location:home_update.php');
            }
    
        } else {
            $_SESSION['status'] = "Update Data Gagal!";
            header('Location:home_update.php');
        }
    } else if ($bNama != $nama) {
        $properties = [
            'displayName' => $nama
        ];

        $userData = [
            'idPelanggan' => $id,
            'nama' => $nama,
            'email' => $email,
            'jKelamin' => $jKelamin,
            'nomor' => $nomor,
            'paket' => $paket,
            'alamat' => $alamat
        ];

        $updatedUser = $auth->updateUser($key, $properties);

        if ($updatedUser) {
            $ref_table = 'data_user/'.$key;
            $updateRef_result = $database->getReference($ref_table)->update($userData);
        
            if($updateRef_result) {
                $_SESSION['status'] = "Update Data Nama Berhasil!";
                header('Location:home_index.php');
            } else {
                $_SESSION['status'] = "Update Data User Gagal!";
                header('Location:home_update.php');
            }
    
        } else {
            $_SESSION['status'] = "Update Data Gagal!";
            header('Location:home_update.php');
        }
    } else {

        $userData = [
            'idPelanggan' => $id,
            'nama' => $nama,
            'email' => $email,
            'jKelamin' => $jKelamin,
            'nomor' => $nomor,
            'paket' => $paket,
            'alamat' => $alamat
        ];

        $ref_table = 'data_user/'.$key;
        $updateRef_result = $database->getReference($ref_table)->update($userData);
    
        if($updateRef_result) {
            $_SESSION['status'] = "Update Data Berhasil!";
            header('Location:home_index.php');
        } else {
            $_SESSION['status'] = "Update Data User Gagal!";
            header('Location:home_update.php');
        }
    }
    
}

if(isset($_POST['del_user'])) {

    $del_id = $_POST['hapus_id'];
    $filePath = $_POST['imgPath'];
    $ref_table = 'data_user/'.$del_id;
    $file_path = 'ktp/'.$filePath;

    try {
        $del = $storage->getBucket()->object($file_path)->delete();
        if($del == null) {
             try{
                $hapusQuery = $database->getReference($ref_table)->remove();
                if($hapusQuery) {
                    $auth->deleteUser($del_id);
                    $_SESSION['status'] = "Menghapus Data Sukses!";
                    header('Location:home_index.php');
                } else {
                    $_SESSION['status'] = "Menghapus Data Gagal!";
                    header('Location:home_index.php');
                }
            } catch (FirebaseException $e) {
                $_SESSION['status'] = $e->getMessage();
                header('Location:home_index.php');
            } catch (Throwable $e) {
                $_SESSION['status'] = 'Terjadi Kesalahan Kode Error: '.$e->getCode();
                header('Location:home_index.php');
            }
        }
    } catch (FirebaseException $e) {
        $_SESSION['status'] = $e->getMessage();
    } catch (Throwable $e) {
        $_SESSION['code'] = $e->getCode();       
        if($_SESSION['code'] == 404){
            try{
                $hapusQuery = $database->getReference($ref_table)->remove();
                if($hapusQuery) {
                    $auth->deleteUser($del_id);
                    $_SESSION['status'] = "Menghapus Data Berhasil!";
                    header('Location:home_index.php');
                } else {
                    $_SESSION['status'] = "Menghapus Data Gagal!";
                    header('Location:home_index.php');
                }
            } catch (FirebaseException $e) {
                $_SESSION['status'] = $e->getMessage();
                header('Location:home_index.php');
            } catch (Throwable $e) {
                $_SESSION['status'] = 'Terjadi Kesalahan Kode Error: '.$e->getCode();
                header('Location:home_index.php');
            }
        } else {
            $_SESSION['status'] = $e->getMessage();
            header('Location:home_index.php');
        }
    }
}

if(isset($_POST['update_pengaduan'])) {

    $key = $_POST['update_id'];
    $status = $_POST['status'];

    if($status == "Pending") {
        $userData = [
            'status' => "Proses",
        ];
        $ref_table = 'data_report/'.$key;
        $updateRef_result = $database->getReference($ref_table)->update($userData);
    
        if($updateRef_result) {
            $_SESSION['status'] = "Update Data Berhasil!";
            header('Location:pengaduan_index.php');
        } else {
            $_SESSION['status'] = "Update Data User Gagal!";
            header('Location:pengaduan_index.php');
        }
    } else if ( $status == "Proses") {
        $userData = [
            'status' => "Selesai",
        ];
        $ref_table = 'data_report/'.$key;
        $updateRef_result = $database->getReference($ref_table)->update($userData);
    
        if($updateRef_result) {
            $_SESSION['status'] = "Update Data Berhasil!";
            header('Location:pengaduan_index.php');
        } else {
            $_SESSION['status'] = "Update Data User Gagal!";
            header('Location:pengaduan_index.php');
        }
    }
}

if(isset($_POST['del_report'])) {

    $del_id = $_POST['hapus_id'];
    $filePath = $_POST['imgPath'];
    $ref_table = 'data_report/'.$del_id;
    $file_path = 'keluhan/'.$filePath;

    try {
        $storage->getBucket()->object($file_path)->delete(); 
        $hapusQuery = $database->getReference($ref_table)->remove();
        if($hapusQuery) {
            $_SESSION['status'] = "Menghapus Data Berhasil!";
            header('Location:pengaduan_index.php');
        } else {
            $_SESSION['status'] = "Menghapus Data Gagal!";
            header('Location:pengaduan_index.php');
        }
    } catch (FirebaseException $e) {
        $_SESSION['status'] = $e->getMessage();
        header('Location:pengaduan_index.php');
    } catch (Throwable $e) {
        $_SESSION['status'] = 'Terjadi Kesalahan Kode Error: '.$e->getCode();
        header('Location:pengaduan_index.php');
    }

}

if(isset($_POST['sambung_baru'])) {

    $getId = $_POST['id'];
    $id = "01$getId";
    $key = $_POST['update_id'];
    $nomor = $_POST['nomor'];
    $jKelamin = $_POST['jKelamin'];
    $paket = $_POST['paket'];
    $alamat = $_POST['alamat'];
    $ktp = $_POST['ktp'];
    $namaKtp = $_POST['namaKtp'];

    $userData = [
        'idPelanggan' => $id,
        'jKelamin' => $jKelamin,
        'nomor' => $nomor,
        'paket' => $paket,
        'alamat' => $alamat,
        'ktp' => $ktp,
        'namaKtp' => $namaKtp
    ];

    $ref_table = 'data_user/'.$key;
    $ref_del = 'data_pelanggan/'.$key;
    $updateRef_result = $database->getReference($ref_table)->update($userData);
    $database->getReference($ref_del)->remove();

    if($updateRef_result) {
        $_SESSION['status'] = "Update Data Berhasil!";
        header('Location:home_index.php');
    } else {
        $_SESSION['status'] = "Update Data User Gagal!";
        header('Location:home_index.php');
    }
}

if(isset($_POST['del_sambung'])) {

    $key = $_POST['hapus_id'];
    $imgPath = $_POST['imgPath'];
    $ref_table = 'data_pelanggan/'.$key;
    $file_path = 'ktp/'.$imgPath;

    $storage->getBucket()->object($file_path)->delete();
    $hapusQuery = $database->getReference($ref_table)->remove();
    if($hapusQuery) {
        $_SESSION['status'] = "Menghapus Data Berhasil!";
        header('Location:user_index.php');
    } else {
        $_SESSION['status'] = "Menghapus Data Gagal!";
        header('Location:user_index.php');
    }
}

if(isset($_POST['update_meteran'])) {

    $key = $_POST['key'];
    $meteran = $_POST['meteran'];

    $userData = [
        'meteran' => $meteran,
    ];

    $ref_table = 'data_user/'.$key;
    $updateRef_result = $database->getReference($ref_table)->update($userData);

    if($updateRef_result) {
        $_SESSION['status'] = "Update Data Berhasil!";
        header('Location:home_index.php');
    } else {
        $_SESSION['status'] = "Update Data User Gagal!";
        header('Location:home_index.php');
    }
}

?>

<!-- Error getMessage catcah -->
<!-- catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
        $_SESSION['status'] = $e->getMessage();
        header('Location:pengaduan_index.php');
    } catch (\Kreait\Firebase\Exception\AuthException $e) {
        $_SESSION['status'] = $e->getMessage();
        header('Location:pengaduan_index.php');
    } -->