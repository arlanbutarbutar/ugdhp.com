<?php require_once("Application/controller/script.php");
    if(isset($_SESSION['id-role'])){if($_SESSION['id-role']<=6){header("Location: Views/");exit;}}
    if(isset($_SESSION['auth'])){unset($_SESSION['auth']);}
    $_SESSION['page-name']="Privacy Policy";$_SESSION['page-to']="privacy-policy";
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
                        <div class="col-md-12">
                            <h1>Kebijakan Privasi</h1>
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
                                <a href="<?php if(isset($_SESSION['auth'])){echo ".";}?>./">Beranda</a><i class="fa fa-angle-double-right"></i><span>Kebijakan Privasi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- == end of breadcrumbs == -->

        <!-- Privacy Content -->
            <div class="ex-basic-2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1">
                            <div class="text-container">
                                <h3>Data Pribadi Kami Terima Dan Kumpulkan</h3>
                                <?php if(mysqli_num_rows($privacy_policy)>0){while($row=mysqli_fetch_assoc($privacy_policy)){echo $row['privacy_policy'];}}?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- end of privacy content -->


        <!-- == Breadcrumbs == -->
            <div class="ex-basic-1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumbs">
                                <a href="<?php if(isset($_SESSION['auth'])){echo ".";}?>./">Beranda</a><i class="fa fa-angle-double-right"></i><span>Kebijakan Privasi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- == end of breadcrumbs == -->

        <?php require_once("Application/access/footer-front.php");?>
    </body>
</html>