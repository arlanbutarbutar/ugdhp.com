<?php require_once("Application/controller/script.php");
    if(isset($_SESSION['id-role'])){if($_SESSION['id-role']<=6){header("Location: Views/");exit;}}
    if(isset($_SESSION['auth'])){unset($_SESSION['auth']);}
    $_SESSION['page-name']="Handphone";$_SESSION['page-to']="hp";
?>

<!-- == Handphone Page UGD HP == -->
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
                                    <h1>Handphone</h1>
                                    <p class="p-large">Memperbaiki Handphone dari kerusakan yang ringan sampai berat dengan berbagai jenis merek Handphone.</p>
                                    <!-- <a class="btn-solid-lg page-scroll border-0 shadow" href="#services"></a> -->
                                </div>
                            </div>
                            <div class="col-lg-6" data-aos="fade-down" data-aos-delay="300">
                                <div class="image-container img-header">
                                    <img class="img-fluid" src="https://i.ibb.co/1qC1tQv/Product-teardown-pana.png" alt="alternative">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header> 
        <!-- == end of header == -->
        
        <!-- == Apa ajah yang didapat? == -->
            <div class="slider-2" id="handphone">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6" data-aos="fade-in" data-aos-delay="0">
                            <div class="image-container">
                                <img class="img-fluid" src="https://i.ibb.co/K7wj74y/Product-teardown-bro.png" alt="alternative">
                            </div>
                        </div>
                        <div class="col-lg-6" data-aos="fade-in" data-aos-delay="300">
                            <h2>Apa ajah sih yang bisa didapat?</h2>
                            <p class="p-large text-justify">Dengan memperbaiki handphone anda disini, anda akan mendapat pelayanan yang baik dan juga mendapat garansi atas perbaikan yang anda ajukan loh. UGD HP memberikan kemudahan juga buat pengguna yang sudah terdaftar untuk mengecek handphone apakah sudah selesai atau belum.</p>
                            <div class="row mt-3">
                                <div class="col-lg-5">
                                    <ul class="list-unstyled li-space-lg">
                                        <li class="media">
                                            <i class="fas fa-check turquoise m-auto"></i>
                                            <div class="media-body ml-2">Garansi</div>
                                        </li>
                                        <li class="media">
                                            <i class="fas fa-check turquoise m-auto"></i>
                                            <div class="media-body ml-2">Konsultasi Perbaikan</div>
                                        </li>
                                        <li class="media">
                                            <i class="fas fa-check turquoise m-auto"></i>
                                            <div class="media-body ml-2">Check Online Perbaikan</div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-7">
                                    <h5>Saran?</h5>
                                    <p>Silakan masukan saran anda untuk kelanjutan UGD HP, kami sangat berharap anda dapat berpartisipasi di lingkungan UGD HP.</p>
                                    <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <textarea name="saran" placeholder="Saran Anda" class="form-control" cols="30" rows="5"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="id-role" value="<?php if(!isset($_SESSION['id-role'])){echo 8;}else if(isset($_SESSION['id-role'])){echo 7;}?>">
                                            <button type="submit" name="send-saran" class="btn-solid-lg page-scroll border-0 shadow">Kirim</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- == end of Apa ajah yang didapat? == -->

        
        <!-- == Details 1 == -->
            <div class="basic-1" id="cari-hp">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6" data-aos="fade-in" data-aos-delay="0">
                            <div class="text-container">
                                <h2>Check Perbaikan</h2>
                                <p>Perbaikan anda dapat di cek di sini, silakan isi form dan cek handphone anda.</p>
                                <form action="" method="POST">
                                    <label for="keyword-hp">Masukan Nomor Nota</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" id="keyword-hp" placeholder="Cari handphone" aria-label="Cari handphone" aria-describedby="button-addon2">
                                        <!-- <div class="input-group-append">
                                            <button class="btn btn-outline-info m-auto" type="button" id="button-addon2"><ion-icon name="search-outline"></ion-icon></button>
                                        </div> -->
                                    </div>
                                </form>
                                <div id="container-search-handphone"></div>
                            </div>
                        </div>
                        <div class="col-lg-6" data-aos="fade-in" data-aos-delay="300">
                            <div class="image-container">
                                <img class="img-fluid" src="https://i.ibb.co/8M5GxSv/Product-teardown-amico.png" alt="alternative">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- == end of details 1 == -->

        <?php require_once("Application/access/footer-front.php");?>
    </body>
</html>