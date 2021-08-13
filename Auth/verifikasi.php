<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectNonUser.php");
$_SESSION['page-name']="Verifikasi";$_SESSION['page-to']="verifikasi";$_SESSION['auth']=1;
if(isset($_GET['auth'])){
    $auth=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_GET['auth']))));
    $crypt=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_GET['crypt']))));
    $account=mysqli_query($conn_back, "SELECT * FROM users WHERE data_encrypt='$crypt'");
    if(mysqli_num_rows($account)>0){
        $row=mysqli_fetch_assoc($account);
        $id_user=$row['id_user'];
        $email=$row['email'];
        if(password_verify($email, $auth)){
            $verified=mysqli_query($conn_back, "UPDATE users SET is_active='1' WHERE id_user='$id_user'");
        }else{
            header("Location: verifikasi");exit;}
    }else{
        header("Location: verifikasi");exit;}}
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
                            <div class="col-lg-6" data-aos="fade-in">
                                <div class="col-10 m-auto text-center text-container mt-n1">
                                    <?php if(empty($auth)){?>
                                        <h2><span class="text-center">Verifikasi Akun</span></h2>
                                        <p class="p-large text-center">Silakan mengecek akun email anda untuk memverifikasi akun anda dan mengaktifkannya.</p>
                                    <?php }else if(!empty($auth)){?>
                                        <h2><span class="text-center">Akun Terverifikasi</span></h2>
                                        <p class="p-large text-center">Terima kasih akun anda telah terverifikasi, silakan login untuk melanjutkan ke layanan anda kepada UGD HP.</p>
                                        <a class="btn-solid-lg page-scroll border-0 shadow" href="masuk">Masuk</a>
                                    <?php }?>
                                </div>
                            </div>
                            <div class="col-lg-6" data-aos="fade-down" data-aos-delay="300">
                                <div class="image-container img-header">
                                    <img class="img-fluid" src="https://i.ibb.co/0CBvMNY/Emails-amico.png" alt="alternative">
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