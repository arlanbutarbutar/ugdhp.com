<?php require_once("Application/controller/script.php");
    if(!isset($_GET['authQR']) || $_GET['authQR']=""){header("Location: ./");exit;}
    if(isset($_SESSION['auth'])){unset($_SESSION['auth']);}
    $_SESSION['page-name']="Data QR Nota";$_SESSION['page-to']="qr?authQR=".$_GET['authQR'];
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
            <header id="header" class="header">
                <div class="header-content">
                    <div class="container" style="">
                        <div class="row">
                            <div class="col-lg-6" data-aos="fade-in">
                                <div class="text-container">
                                    <h1>Data QR</h1>
                                    <p class="p-large">Data perbaikan dan lainnya bisa kamu dapatkan disini.</p>
                                    <?php if(mysqli_num_rows($takeNotes)==0){?>
                                    <p class="text-danger">Data tidak ditemukan!!</p>
                                    <?php }else if(mysqli_num_rows($takeNotes)>0){while($row=mysqli_fetch_assoc($takeNotes)){?>
                                    <div class="card border-0 shadow">
                                        <div class="card-header border-bottom-0">
                                            <h5>Nomor Nota <?= "T".$row['id_nota_tinggal']."|DP".$row['id_nota_dp']."|L".$row['id_nota_lunas']?></h5>
                                        </div>
                                        <div class="card-body">
                                            <p>Perbaikan <?= $row['product'] ?> dengan kerusakan <?= $row['kerusakan'] ?> dan kondisi <?= $row['kondisi'] ?>. Kelengkapan dari <?= $row['product'] ?> <?php if (empty($row['kelengkapan']) || $row['kelengkapan'] == '-') { echo 'tidak ada'; } else { echo $row['kelengkapan']; } ?>. Perbaikan dikerjakan oleh <?php $id_tek = $row['id_pegawai']; $teknisi = mysqli_query($conn_back, "SELECT * FROM users WHERE id_user='$id_tek'"); $row_tek = mysqli_fetch_assoc($teknisi); echo $row_tek['first_name']; ?></p>
                                            <p>Sparepart: <?php $id_userQR=$row['id_user']; $takeSparepart=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_user='$id_userQR'"); if(mysqli_num_rows($takeSparepart)==0){echo "Belum ada";}else if(mysqli_num_rows($takeSparepart)>0){while($rowSP=mysqli_fetch_assoc($takeSparepart)){echo $rowSP['ket']." (".$rowSP['suplayer'].")";}}?></p>
                                        </div>
                                        <div class="card-footer border-top-0 text-center">
                                            <p>Garansi <h4 class="font-weight-bold" id="garansi"></h4></p>
                                            <script>
                                                var countDownDate = new Date("<?= $row['garansi']?>").getTime();
                                                var x = setInterval(function() {
                                                    var now = new Date().getTime();
                                                    var distance = countDownDate - now;
                                                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                    document.getElementById("garansi").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
                                                    if (distance < 0) {
                                                        clearInterval(x);
                                                        document.getElementById("garansi").innerHTML = "EXPIRED";}
                                                }, 1000);
                                            </script>
                                        </div>
                                    </div>
                                    <?php }}?>
                                </div>
                            </div>
                            <div class="col-lg-6" data-aos="fade-down" data-aos-delay="300">
                                <div class="image-container">
                                    <img class="img-fluid" src="https://i.ibb.co/7Xy35DJ/QR-Code-pana.png" alt="alternative" style="margin-top: -50px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header> 
        <!-- == end of header == -->

        <?php require_once("Application/access/footer-front.php");?>
    </body>
</html>