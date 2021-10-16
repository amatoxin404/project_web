<?php
session_start();
include('dbcon.php');

if(isset($_POST['login_btn'])) {

    $email = $_POST['email'];
    $clearTextPassword = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if ($email != "admin@admin.com") {
            $_SESSION['status'] = "Silahkan Periksa Kembali Email Anda!";
            header('Location:index.php');
            exit();
        } else {
            $_SESSION['status'] = "Silahkan Periksa Kembali Email Anda!";
            header('Location:index.php');
            exit();
        }
    } else {
        try {
            $user = $auth->getUserByEmail("$email");
    
            try{
                $signInResult = $auth->signInWithEmailAndPassword($email, $clearTextPassword);
                $idTokenString = $signInResult->idToken();
    
                try {
                    $verifiedIdToken = $auth->verifyIdToken($idTokenString);
                    $uid = $verifiedIdToken->claims()->get('sub');
    
                    $_SESSION['verified_user_id'] = $uid;
                    $_SESSION['idTokenString'] = $idTokenString;
    
                    $_SESSION['status'] = "Login Success!";
                    header('Location:home_index.php');
                    exit();
                    
                } catch (InvalidToken $e) {
                    echo 'The token is invalid: '.$e->getMessage();
                } catch (\InvalidArgumentException $e) {
                    echo 'The token could not be parsed: '.$e->getMessage();
                }
    
            } catch(Exception $e){
                $_SESSION['status'] = "Password Salah!";
                header('Location:index.php');
                exit();
            }
    
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            // echo $e->getMessage();
            $_SESSION['status'] = "User Tidak Di Temukan!";
            header('Location:index.php');
            exit();
        }
    }

} else {
    $_SESSION['status'] = "not Allowd";
    header('Location:index.php');
    exit();
}

?>