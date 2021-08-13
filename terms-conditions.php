<?php require_once("Application/controller/script.php");
    if(isset($_SESSION['id-role'])){if($_SESSION['id-role']<=6){header("Location: Views/");exit;}}
    if(isset($_SESSION['auth'])){unset($_SESSION['auth']);}
    $_SESSION['page-name']="Terms Conditions";$_SESSION['page-to']="terms-conditions";
?>

<!DOCTYPE html>
<html lang="id">
    <head><?php require_once("Application/access/header-front.php");?></head>
    <body data-spy="scroll" data-target=".fixed-top"> 
        <!-- == Preloader == -->
            <div class="spinner-wrapper">
                <div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </div>
        <!-- == end of preloader == -->        

        <?php require_once("Application/access/navbar-front.php");?>

        <!-- == Header == -->
            <header id="header" class="ex-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1>Syarat & Ketentuan</h1>
                        </div>
                    </div>
                </div>
            </header>
        <!-- == end of header == -->


        <!-- == Breadcrumbs == -->
            <div class="ex-basic-1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumbs">
                                <a href="<?php if(isset($_SESSION['auth'])){echo ".";}?>./">Beranda</a><i class="fa fa-angle-double-right"></i><span>Syarat & Ketentuan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- == end of breadcrumbs == -->


        <!-- Terms Content -->
            <div class="ex-basic-2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1">
                            <div class="text-container">
                                <h3>Syarat & Ketentuan</h3>
                                <?php if(mysqli_num_rows($terms_conditions)>0){while($row=mysqli_fetch_assoc($terms_conditions)){echo $row['terms_conditions'];}}?>
                            </div>
                        </div>
                    </div> <!-- end of row -->
                </div> <!-- end of container -->
            </div> <!-- end of ex-basic -->
        <!-- end of terms content -->
        
        <!-- == Breadcrumbs == -->
            <div class="ex-basic-1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumbs">
                                <a href="<?php if(isset($_SESSION['auth'])){echo ".";}?>./">Beranda</a><i class="fa fa-angle-double-right"></i><span>Syarat & Ketentuan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- == end of breadcrumbs == -->

        <?php require_once("Application/access/footer-front.php");?>
    </body>
</html>