<?php require_once("Application/controller/script.php");
    if(isset($_SESSION['id-role'])){if($_SESSION['id-role']<=6){header("Location: Views/");exit;}}
    if(isset($_SESSION['auth'])){unset($_SESSION['auth']);}
    $_SESSION['page-name']="Laptop";$_SESSION['page-to']="laptop";
?>

<!-- == Laptop Page UGD HP == -->
<!DOCTYPE html>
<html lang="id">
    <head><?php require_once("Application/access/header-front.php");?></head>
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

        <?php require_once("Application/access/navbar-front.php");?>

        <!-- == Header == -->
            <header id="header" class="header" style="height: 100vh">
                <div class="header-content">
                    <div class="container" style="margin-top: 60px">
                        <div class="row">
                            <div class="col-lg-6" data-aos="fade-in">
                                <div class="text-container text-header">
                                    <h1>Laptop</h1>
                                    <p class="p-large">Menyelesaikan masalah yang terjadi pada program Laptop dan memperbaiki hardware Laptop hingga tuntas.</p>
                                    <!-- <a class="btn-solid-lg page-scroll border-0 shadow" href="#services"></a> -->
                                </div>
                            </div>
                            <div class="col-lg-6" data-aos="fade-down" data-aos-delay="300">
                                <div class="image-container img-header">
                                    <img class="img-fluid" src="https://i.ibb.co/R6N3DyN/Firmware-pana.png" alt="alternative">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header> 
        <!-- == end of header == -->
        
        <!-- == Details 1 == -->
            <div class="basic-1" id="cari-laptop">
                <div class="container">
                    <div class="row flex-row-reverse">
                        <div class="col-lg-6" data-aos="fade-in" data-aos-delay="0">
                            <div class="text-container">
                                <h2>Check Perbaikan</h2>
                                <p>Perbaikan anda dapat di cek di sini, silakan isi form dan cek laptop anda.</p>
                                <form action="" method="POST">
                                    <label for="keyword-laptop">Masukan Nomor Nota</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" id="keyword-laptop" placeholder="Cari laptop" aria-label="Cari laptop" aria-describedby="button-addon2">
                                        <!-- <div class="input-group-append">
                                            <button class="btn btn-outline-info m-auto" type="button" id="button-addon2"><ion-icon name="search-outline"></ion-icon></button>
                                        </div> -->
                                    </div>
                                </form>
                                <div id="container-search-laptop"></div>
                            </div>
                        </div>
                        <div class="col-lg-6" data-aos="fade-in" data-aos-delay="300">
                            <div class="image-container">
                                <img class="img-fluid" src="https://i.ibb.co/N9HrmSq/Firmware-amico.png" alt="alternative">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- == end of details 1 == -->

        <?php require_once("Application/access/footer-front.php");?>
    </body>
</html>