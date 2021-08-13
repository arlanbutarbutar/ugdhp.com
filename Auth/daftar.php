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
                                    <h2><span class="turquoise text-center">Daftar</span></h2>
                                    <p class="p-large text-center">Sudah punya akun? <a href="masuk" class="text-decoration-none turquoise">Masuk</a> sekarang.</p>
                                    <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                                    <form action="" method="POST">
                                        <div class="row">
                                            <div class="col mt-3">
                                                <input type="text" name="first-name" class="form-control-input border-0 shadow" id="fname" required>
                                                <label class="label-control ml-3" for="fname">Nama Depan</label>
                                                <div class="help-block with-errors text-danger"></div>
                                            </div>
                                            <div class="col mt-3">
                                                <input type="text" name="last-name" class="form-control-input border-0 shadow" id="lname" required>
                                                <label class="label-control ml-3" for="lname">Nama Belakang</label>
                                                <div class="help-block with-errors text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <input type="email" name="email" class="form-control-input border-0 shadow" id="email" required>
                                            <label class="label-control" for="email">Email</label>
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <input type="password" name="password" class="form-control-input border-0 shadow" id="email" required>
                                            <label class="label-control" for="email">Password</label>
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                        <div class="form-group checkbox justify-content-start">
                                            <input type="checkbox" name="policy" id="rterms" value="Agreed-to-Terms" name="kebijakan" required>Saya setuju dengan <a href="../privacy-policy">Kebijakan Privasi</a> dan <a href="../terms-conditions">Ketentuan Layanan</a> yang berlaku.
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="daftar" class="btn-solid-lg page-scroll border-0 shadow">Daftar</button>
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