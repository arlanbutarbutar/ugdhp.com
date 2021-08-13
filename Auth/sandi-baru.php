<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectNonUser.php");
$_SESSION['page-name']="Sandi Baru";$_SESSION['page-to']="sandi-baru";$_SESSION['auth']=1;
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
                                    <h2><span class="turquoise text-center">Buat Sandi Baru</span></h2>
                                    <p class="p-large text-center">Silakan masukan kata sandi baru anda.</p>
                                    <?php if(isset($message_success)){echo $message_success;}if(isset($message_danger)){echo $message_danger;} ?>
                                    <form action="" method="POST">
                                        <div class="form-group mt-5">
                                            <input type="hidden" name="email" value="<?= $_SESSION['email']?>">
                                            <input type="email" class="form-control-input border-0 shadow" value="<?= $_SESSION['email']?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control-input border-0 shadow" id="password1" name="password1" required>
                                            <label class="label-control" for="password1">Kata Sandi</label>
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control-input border-0 shadow" id="password2" name="password2" required>
                                            <label class="label-control" for="password2">ulang Kata Sandi</label>
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="sandi-baru" class="btn-solid-lg text-center page-scroll border-0 shadow">Buat</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6" data-aos="fade-down" data-aos-delay="300">
                                <div class="image-container img-header">
                                    <img class="img-fluid" src="https://i.ibb.co/c6jp3xT/Forgot-password-rafiki.png" alt="alternative">
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