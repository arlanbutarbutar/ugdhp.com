<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectNonUser.php");
$_SESSION['page-name']="Masuk";$_SESSION['page-to']="masuk";$_SESSION['auth']=1;
?>

<!-- == Home Page UGD HP == -->
<!DOCTYPE html>
<html lang="id">
    <head><?php require_once("../Application/access/header-front.php");?></head>
    <body data-spy="scroll" data-target=".fixed-top" id="page-top">
        <!-- == Preloader == -->
            <div class="spinner-wrapper">
                <div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </div>
        <!-- == end of preloader == -->

        <?php require_once("../Application/access/navbar-front.php");?>

        <!-- == Header == -->
            <header id="header" class="header" style="height: 100vh">
                <div class="header-content">
                    <div class="container" style="margin-top: 60px">
                        <div class="row">
                            <div class="col-lg-6 mt-n5" data-aos="fade-in">
                                <div class="col-10 text-center text-container m-auto">
                                    <h2><span class="turquoise text-center">Masuk</span></h2>
                                    <p class="p-large text-center">Belum punya akun? <a href="daftar" class="text-decoration-none turquoise">Daftar</a> sekarang.</p>
                                    <?php if(isset($message_success)){echo $message_success;}if(isset($message_danger)){echo $message_danger;} ?>
                                    <form action="" method="POST">
                                        <div class="form-group mt-5">
                                            <input type="email" class="form-control-input border-0 shadow" id="email" name="email" required>
                                            <label class="label-control" for="email">Email</label>
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <input type="password" class="form-control-input border-0 shadow" id="password" name="password" required>
                                            <label class="label-control" for="password">Kata Sandi</label>
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                        <div class="row flex-nowrap">
                                            <div class="col-lg-4 m-0 p-0">
                                                <div class="form-group">
                                                    <input type="checkbox" name="remember" class="form-check-input" id="remember"> 
                                                    <label for="remember" class="text-dark cursor-pointer">Ingat saya</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 m-0 p-0">
                                                <div class="form-group mt-n2">
                                                    <a href="lupa-sandi" class="nav-link text-decoration-none text-right">Lupa Sandi</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="masuk" class="btn-solid-lg text-center page-scroll border-0 shadow">Masuk</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6" data-aos="fade-down" data-aos-delay="300">
                                <div class="image-container img-header">
                                    <img class="img-fluid" src="https://i.ibb.co/v1ntjxM/Mobile-login-pana.png" alt="alternative">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header> 
        <!-- == end of header == -->

        <?php require_once("../Application/access/footer-front.php");?>
    </body>
</html>