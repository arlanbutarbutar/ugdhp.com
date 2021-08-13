<?php require_once("Application/controller/script.php");
    if(isset($_SESSION['id-role'])){if($_SESSION['id-role']<=6){header("Location: Views/");exit;}}
    if(isset($_SESSION['auth'])){unset($_SESSION['auth']);}
    $_SESSION['page-name']="";$_SESSION['page-to']="./";
?>

<!-- == Home Page UGD HP == -->
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
                            <?php if(mysqli_num_rows($header)>0){while($row=mysqli_fetch_assoc($header)){?>
                            <div class="col-lg-6 mt-n5" data-aos="fade-in">
                                <div class="text-container">
                                    <h1><?= $row['title']?></h1>
                                    <p class="p-large"><?= $row['deskripsi']?></p>
                                    <a class="btn-solid-lg page-scroll border-0 shadow" href="#services">Liat Layanan</a>
                                </div>
                            </div>
                            <div class="col-lg-6" data-aos="fade-down" data-aos-delay="300">
                                <div class="image-container">
                                    <img class="img-fluid" src="<?= $row['img']?>" alt="alternative">
                                </div>
                            </div>
                            <?php }}?>
                        </div>
                    </div>
                </div>
            </header> 
        <!-- == end of header == -->

        <!-- == Services == -->
            <div id="services" class="cards-1">
                <div class="container">
                    <div class="row" data-aos="fade-up">
                        <div class="col-lg-12">
                            <?php if(mysqli_num_rows($service_head)>0){while($row=mysqli_fetch_assoc($service_head)){?>
                            <h2><?= $row['title']?></h2>
                            <p class="p-heading p-large"><?= $row['deskripsi']?></p>
                            <?php }}?>
                        </div>
                    </div>
                    <div class="row justify-content-center flex-wrap">
                        <?php if(mysqli_num_rows($service_body)>0){while($row=mysqli_fetch_assoc($service_body)){?>
                        <div class="col-lg-4">
                            <div class="card border-0 shadow" data-aos="fade-in" data-aos-delay="0">
                                <img class="card-image" src="<?= $row['img']?>" alt="alternative">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $row['title']?></h4>
                                    <p><?= $row['deskripsi']?></p>
                                </div>
                            </div>
                        </div>
                        <?php }}?>
                        <div class="col-lg-4 m-auto">
                            <div class="card border-0 shadow w-100" data-aos="fade-in" data-aos-delay="100" style="height: 300px">
                                <div class="card-body m-auto">
                                    <a href="https://code.ugdhp.com/services" class="fa-3x mb-3 text-dark align-items-center"><ion-icon name="arrow-forward-outline" style="margin-top: 50px"></ion-icon></a>
                                    <p>Liat layanan lainnya</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- == end of services == -->
        
        <!-- == Details 1 == -->
            <?php if(mysqli_num_rows($about_service)>0){while($row=mysqli_fetch_assoc($about_service)){?>
            <div class="basic-1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6" data-aos="fade-in" data-aos-delay="0">
                            <div class="text-container">
                                <h2><?= $row['title_service']?></h2>
                                <p><?= $row['deskripsi_service']?></p>
                                <a class="btn-solid-reg popup-with-move-anim border-0 shadow" href="#details-lightbox-1"><?= $row['btn_service']?></a>
                            </div>
                        </div>
                        <div class="col-lg-6" data-aos="fade-in" data-aos-delay="300">
                            <div class="image-container">
                                <img class="img-fluid" src="Assets/img/img-web/<?= $row['img_service']?>" alt="alternative">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- == end of details 1 == -->

        <!-- == Details Lightboxes || Details Lightbox 1 == -->
            <div id="details-lightbox-1" class="lightbox-basic zoom-anim-dialog mfp-hide">
                <div class="container">
                    <div class="row">
                        <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
                        <div class="col-lg-8" data-aos="fade-in" data-aos-delay="0">
                            <div class="image-container">
                                <img class="img-fluid" src="<?= $row['img_spesifik']?>" alt="alternative">
                            </div>
                        </div>
                        <div class="col-lg-4" data-aos="fade-in" data-aos-delay="300">
                            <h3><?= $row['title1_spesifik']?></h3>
                            <hr>
                            <h5><?= $row['title2_spesifik']?></h5>
                            <p><?= $row['deskripsi_spesifik']?></p>
                            <ul class="list-unstyled li-space-lg">
                                <?php $id_spesifik=$row['id_spesifik'];$about_service_fitur=mysqli_query($conn_front, "SELECT * FROM about_service_fitur WHERE id_spesifik='$id_spesifik'");foreach($about_service_fitur as $row):?>
                                <li class="media">
                                    <i class="fas fa-check"></i><div class="media-body"><?= $row['fitur']?></div>
                                </li>
                                <?php endforeach;?>
                            </ul>
                            <a class="btn-outline-reg mfp-close as-button border-0 shadow" href="#screenshots">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php }}?>
        <!-- ==  end of lightbox-basic || end of details lightbox 1 == -->

        <!-- == Pricing == -->
            <?php if(mysqli_num_rows($pricing)>0){while($row=mysqli_fetch_assoc($pricing)){?>
            <div id="pricing" class="cards-2">
                <div class="container">
                    <div class="row" data-aos="fade-up" data-aos-delay="0">
                        <div class="col-lg-12">
                            <h2><?= $row['title_pricing']?></h2>
                            <p class="p-heading p-large"><?= $row['deskripsi_pricing']?></p>
                        </div>
                    </div>
                    <div class="row justify-content-center flex-wrap">
                        <?php $id_pricing=$row['id_pricing'];
                            $pricing_card=mysqli_query($conn_front, "SELECT * FROM pricing_card WHERE id_pricing='$id_pricing'");foreach($pricing_card as $row):?>
                        <div class="col-lg-4">
                            <div class="card scale border-0 shadow" data-aos="fade-in" data-aos-delay="0">
                                <div class="card-body">
                                    <div class="card-title"><?= $row['title_card']?></div>
                                    <div class="card-subtitle"><?= $row['info_card']?></div>
                                    <hr class="cell-divide-hr">
                                    <div class="price">
                                        <span class="currency">Rp. </span><span class="value"><?= number_format($row['price_card']);?></span>
                                        <div class="frequency"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
            <?php }}?>
        <!-- == end of pricing == -->

        <!-- == Video == -->
            <div class="basic-3">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12" data-aos="fade-up" data-aos-delay="0">
                            <h2>Lihat Videonya</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="image-container" data-aos="fade-in" data-aos-delay="0">
                                <div class="video-wrapper">
                                    <a class="popup-youtube" href="<?php if(mysqli_num_rows($video)>0){while($row=mysqli_fetch_assoc($video)){echo $row['link'];}}?>" data-effect="fadeIn">
                                        <img class="img-fluid shadow" src="Assets/img/img-web/video-frame.svg" alt="alternative">
                                        <span class="video-play-button">
                                            <span></span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <p>Video ini akan memperlihatkan kepada kamu bagaimana layanan kami bekerja untuk kepuasan anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        <!-- == end of video == -->

        <!-- == About == -->
            <div id="about" class="basic-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12" data-aos="fade-up" data-aos-delay="0">
                            <?php if(mysqli_num_rows($about_head)>0){while($row=mysqli_fetch_assoc($about_head)){?>
                            <h2><?= $row['title']?></h2>
                            <p class="p-heading p-large"><?= $row['deskripsi']?></p>
                            <?php }}?>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <?php if(mysqli_num_rows($about_body)>0){while($row=mysqli_fetch_assoc($about_body)){?>
                            <div class="col-lg-4 container-card" data-aos="fade-in" data-aos-delay="0">
                                <div class="card card-body border-0 view-card mb-3">
                                    <div class="team-member m-auto">
                                        <div class="image-wrapper">
                                            <img class="img-fluid shadow" src="Assets/img/img-users/<?= $row['img']?>" alt="alternative">
                                        </div>
                                        <div class="text-card">
                                            <p class="p-large"><strong><?= $row['name']?></strong></p>
                                            <p class="job-title"><?= $row['info']?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }}?>
                    </div>
                </div>
            </div>
        <!-- == end of about == -->

        <!-- == Testimonials == -->
            <?php if(mysqli_num_rows($testimonial)>0){while($row=mysqli_fetch_assoc($testimonial)){?>
            <div class="slider-2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6" data-aos="fade-in" data-aos-delay="0">
                            <div class="image-container">
                                <img class="img-fluid" src="Assets/img/img-web/<?= $row['img_testi']?>" alt="alternative">
                            </div>
                        </div>
                        <div class="col-lg-6" data-aos="fade-in" data-aos-delay="300">
                            <h2><?= $row['title_testi']?></h2>
                            <div class="slider-container">
                                <div class="swiper-container card-slider">
                                    <div class="swiper-wrapper">
                                        <?php $id_testimonial=$row['id_testimonial'];
                                            $testimonial_comment=mysqli_query($conn_front, "SELECT * FROM testimonial_comment WHERE id_testimonial='$id_testimonial'");foreach($testimonial_comment as $row):?>
                                        <div class="swiper-slide">
                                            <div class="card">
                                                <div class="card-body">
                                                    <img class="card-image shadow" src="Assets/img/img-users/<?= $row['img_comment']?>" alt="alternative">
                                                    <p class="testimonial-text"><?= $row['comment']?></p>
                                                    <p class="testimonial-author"><a href="<?= $row['author']?>" class="text-decoration-none font-weight-bold" target="_blank"><?= $row['name']?></a></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach;?>
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }}?>
        <!-- == end of testimonials == -->

        <!-- == Contact == -->
            <?php if(mysqli_num_rows($contact)>0){while($row=mysqli_fetch_assoc($contact)){?>
            <div id="contact" class="form-2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12" data-aos="fade-up" data-aos-delay="0">
                            <h2><?= $row['title']?></h2>
                            <ul class="list-unstyled li-space-lg">
                                <li class="address"><?= $row['deskripsi']?></li>
                                <li><i class="fas fa-map-marker-alt"></i>Jln. W.J Lalamentik no.95 (UGD HP), Kota Kupang, NTT, ID</li>
                                <li><i class="fas fa-envelope"></i><a class="turquoise" href="mailto:ugdhpmediatalk@ugdhp.com">ugdhpmediatalk@ugdhp.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" data-aos="fade-in" data-aos-delay="100">
                            <div class="map-responsive shadow">
                                <?= $row['maps']?>
                            </div>
                        </div>
                        <div class="col-lg-6" data-aos="fade-in" data-aos-delay="300">
                            <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                            <form method="POST" data-toggle="validator" data-focus="false">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control-input border-0 shadow" id="cname" required>
                                    <label class="label-control" for="cname">Nama Panggil</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control-input border-0 shadow" id="cemail" required>
                                    <label class="label-control" for="cemail">Email</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <textarea name="pesan" class="form-control-textarea border-0 shadow" id="cmessage" required></textarea>
                                    <label class="label-control" for="cmessage">Pesan Kamu</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="kirim-pesan" class="form-control-submit-button shadow border-0">Kirim Pesan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php }}?>
        <!-- == end of contact == -->
        
        <?php require_once("Application/access/footer-front.php");?>
    </body>
</html>