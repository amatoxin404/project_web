<?php
session_start();
if(isset($_SESSION['verified_user_id'])) {
    $_SESSION['status'] = "Selamat Datang";
    header('Location:home_index.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="bg-light">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 mt-5">
                        <?php
                        if(isset($_SESSION['status'])) {
                            echo "<h5 class='alert alert-danger'>".$_SESSION['status']."</h5>";
                            unset($_SESSION['status']);
                        }
                    ?>
                            <div class="card shadow-lg border-0 rounded-lg">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-1">Form Login</h3>
                                </div>
                                <div class="card-body">
                                    <form action="function_login.php" method="post">
                                        <div class="form-group">
                                            <label class="small mb-1">Email</label>
                                            <input class="form-control py-4" type="email"
                                                placeholder="Masukan Email" name="email" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1">Password</label>
                                            <input class="form-control py-4" type="password"
                                                placeholder="Masukan password" name="password" />
                                        </div>
                                        <div class="form-group d-flex align-items-center mt-4 mb-0">
                                            <button type="submit" name="login_btn" class="btn btn-primary btn-login">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
</body>

</html>