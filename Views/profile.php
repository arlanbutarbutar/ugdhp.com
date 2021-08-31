<?php require_once("../Application/controller/script.php");
require_once("../Application/controller/redirectUser.php");
$_SESSION['page-name']="My Profile";$_SESSION['page-to']="profile";
?>
<!DOCTYPE html>
<html lang="id">
    <head><?php require_once("../Application/access/header-back.php")?></head>
    <body id="page-top">
        <?php require_once("../Application/access/topNav.php");?>
        <div class="container-fluid bg-<?= $bgMode?>">
            <div class="row">
                <div class="col-12">
                    <?php require_once("../Application/access/sideNavbar.php")?>
                    <main class="content">
                        <?php require_once("../Application/access/topNavbar.php");if($_SESSION['id-role']<=3){?>
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
                            <div class="btn-toolbar dropdown">
                                <button class="btn btn-<?= $btnMode?> btn-sm mr-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-plus mr-2"></span>New Task
                                </button>
                                <div class="dropdown-menu dashboard-dropdown dropdown-menu-left mt-2 bg-<?= $bgMode?>">
                                    <?php foreach($newTask as $row):?>
                                    <a class="dropdown-item font-weight-bold <?= $colorMode?>" href="<?= $row['url']?>"><i class="<?= $row['icon']?> <?= $colorMode?>"></i></span> <?= $row['title']?></a>
                                    <?php endforeach;?>
                                </div>
                            </div>
                            <?php if($_SESSION['id-role']<=2){?>
                            <div class="btn-group">
                                <button type="submit" name="use-procedure" class="btn btn-sm btn-outline-<?= $btnMode?> <?= $colorMode?>">Usage Procedure</button>
                                <button type="submit" name="report-generate" class="btn btn-sm btn-outline-<?= $btnMode?> <?= $colorMode?>">Report</button>
                            </div>
                            <?php }?>
                        </div>
                        <?php }?>
                        
                        <!-- == Header == -->
                            <div class="row">
                                <div class="col-md-12 mb-n3">
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4 <?= $colorMode?>">
                                        <h2 class="h3 mb-0">Hello, <?= $_SESSION['username']?></h2>
                                        <small class="mb-0"><?= $_SESSION['page-name']?> <i class="fas fa-angle-left"></i> <a href="./" class="text-decoration-none">Console</a> <i class="fas fa-angle-left"></i></small>
                                    </div>
                                </div>
                            </div>
                        <!-- == end of Header == -->
                        
                        <?php if(isset($message_success)){echo$message_success;}if(isset($message_danger)){echo$message_danger;}if(isset($message_warning)){echo$message_warning;}if(isset($message_info)){echo$message_info;}if(isset($message_dark)){echo$message_dark;}?>
                        
                        <?php if(mysqli_num_rows($myProfile)>0){while($row=mysqli_fetch_assoc($myProfile)){?>
                        <!-- == Card Profile == -->
                            <div class="row flex-row-reverse">

                                <!-- === Photo === -->
                                    <div class="col-lg-4 mt-3" id="register">
                                        <div class="card shadow border-light bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="card-body text-center">
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="id-user" value="<?= $row['id_user'];?>">
                                                    <input type="hidden" name="img-old" value="<?= $row['img']?>">
                                                    <div class="upload-profile-image d-flex justify-content-center" style="width: 200px; height: 200px">
                                                        <div class="text-center">
                                                            <div class="d-flex justify-content-center">
                                                                <img class="camera-icon" src="../Assets/img/img-web/camera-solid.svg" alt="camera">
                                                            </div>
                                                            <img src="../Assets/img/img-users/<?= $row['img'];?>" class="img rounded-circle" alt="profile">
                                                            <small class="form-text text-black-50">Choise Your Photo</small>
                                                            <input type="file" class="form-control-file" name="profile" style="margin-left: -100px" id="upload-profile">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="edit-profile-employee" class="btn btn-<?= $btnMode?> btn-sm shadow mt-5">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <!-- === end of Photo === -->

                                <!-- === Biodata === -->
                                    <div class="col-lg-8 mt-3">
                                        <div class="card shadow border-light bg-<?= $bgMode?>" style="overflow-x: auto">
                                            <div class="card-body">
                                                <table class="table table-borderless table-sm">
                                                    <h5>Biodata</h5>
                                                    <tbody class="<?= $colorMode?>">
                                                        <tr>
                                                            <th scope="row">Nama Depan</th>
                                                            <td>: <?= $row['first_name']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Nama Belakang</th>
                                                            <td>: <?= $row['last_name']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Email</th>
                                                            <td>: <?= $row['email']?> <a class="btn btn-outline-<?= $btnMode?> btn-sm" data-toggle="collapse" href="#edit-email-user" role="button" aria-expanded="false" aria-controls="edit-email-user">Edit</a>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Phone Number</th>
                                                            <td>: <?= $row['phone'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Address</th>
                                                            <td>: <?= $row['address'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Postal</th>
                                                            <td>: <?= $row['postal'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Role</th>
                                                            <td>: <?= $row['role']?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Date Created</th>
                                                            <td>: <?= $row['date_created']?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <p class="text-center">
                                                    <button class="btn btn-<?= $btnMode?> btn-sm shadow" type="button" data-toggle="collapse" data-target="#edit-biodata-user" aria-expanded="false" aria-controls="edit-biodata-user">Edit</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <!-- === end of Biodata === -->

                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="collapse" id="edit-email-user">
                                        <div class="card card-body shadow mt-3 text-center border-light bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="row">
                                                <div class="col-lg-6 m-auto">
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                        <input type="hidden" name="email-old" value="<?= $row['email']?>">
                                                        <div class="form-group">
                                                            <label for="email-lama">Email lama</label>
                                                            <input type="email" value="<?= $row['email']?>" id="email-lama" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Email lama" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email-baru">Email baru</label>
                                                            <input type="email" name="email" id="email-baru" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Email baru" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="password1">Password yang kamu gunakan</label>
                                                            <input type="password" name="password1" id="password" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Password" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="password2">Ulangi Password</label>
                                                            <input type="password" name="password2" id="password2" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Ulangi Password" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" name="edit-email-user" class="btn btn-<?= $btnMode?> btn-sm shadow mt-3">Apply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapse" id="edit-biodata-user">
                                        <div class="card card-body shadow mt-3 text-center border-light bg-<?= $bgMode?> <?= $colorMode?>">
                                            <div class="col-lg-6 m-auto">
                                                <h6 class="font-weight-bold text-center">Silakan masukan data baru anda dan pastikan sesuai fakta(KTP/Tanda pengenal lainnya).</h6>
                                                <form action="" method="POST">
                                                    <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                                    <div class="form-group">
                                                        <label class=" font-weight-bold" for="first-name">First Name</label>
                                                        <input type="text" name="first-name" value="<?= $row['first_name']?>" placeholder="First Name" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class=" font-weight-bold" for="last-name">Last Name</label>
                                                        <input type="text" name="last-name" value="<?= $row['last_name']?>" placeholder="Last Name" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class=" font-weight-bold" for="email">Email</label>
                                                        <input type="email" name="email" value="<?= $row['email']?>" placeholder="email" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class=" font-weight-bold" for="phone">Phone Number</label>
                                                        <input type="number" name="phone" value="<?= $row['phone']?>" placeholder="Phone Number" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class=" font-weight-bold" for="address">Address</label>
                                                        <input type="text" name="address" value="<?= $row['address']?>" placeholder="Address" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class=" font-weight-bold" for="postal">Postal</label>
                                                        <input type="number" name="postal" value="<?= $row['postal']?>" placeholder="Postal" class="form-control text-center bg-<?= $bgMode?> <?= $colorMode?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="edit-biodata-user" class="btn btn-<?= $btnMode?> btn-sm mt-3">Apply</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4"></div>
                            </div>
                        <!-- == end of Card Profile == -->
                        <?php }}?>

        <?php require_once("../Application/access/footer_back.php")?>
    </body>
</html>