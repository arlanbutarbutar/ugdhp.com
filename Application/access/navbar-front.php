<!-- == Navigation == -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top" data-aos="fade-down">
        <a class="navbar-brand logo-image text-dark text-decoration-none" style="outline: none" href="<?php if(isset($_SESSION['auth'])){echo "./";}?>./">
            <?php if(mysqli_num_rows($nav_icon)>0){while($row=mysqli_fetch_assoc($nav_icon)){?>
            <img src="<?= $row['icon']?>" alt="logo-web" style="width: 50px; height: 55px">
            <?php }}?>
        </a>
        <button class="navbar-toggler rounded small" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-awesome small fas fa-bars"></span>
            <span class="navbar-toggler-awesome small fas fa-times"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <?php if(mysqli_num_rows($navbar)>0){while($row=mysqli_fetch_assoc($navbar)){
                    if($row['id_model']==1){?>
                <li class="nav-item m-auto">
                    <a class="nav-link page-scroll" href="<?php if(isset($_SESSION['auth'])){echo "../";}?><?= $row['url']?>"><?= $row['title']?></a>
                </li>
                <?php }if($row['id_model']==2){if(!isset($_SESSION['id-user'])||!isset($_SESSION['id-role'])){?>
                <li class="nav-item m-auto">
                    <a class="btn-solid-lg border-0 font-weight-bold btn-light shadow text-uppercase fa-1x" href="<?php if(isset($_SESSION['auth'])){echo "../";}?><?= $row['url']?>"><?= $row['title']?></a>
                </li>
                <?php }else if(isset($_SESSION['id-user'])||isset($_SESSION['id-role'])){if($_SESSION['id-role']<=6){?>
                <li class="nav-item m-auto">
                    <a class="nav-link page-scroll" href="Views/">Console</a>
                </li>
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link pt-1 px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media d-flex align-items-center">
                            <?php if(mysqli_num_rows($user_views_profile)==0){?>
                                <p class="text-danger">Query error!</p>
                            <?php }if(mysqli_num_rows($user_views_profile)>0){while($row=mysqli_fetch_assoc($user_views_profile)){?>
                                <img class="user-avatar md-avatar rounded-circle" alt="Icon Profile" src="Assets/img/img-users/<?= $row['img']?>" style="width: 50px">
                            </div>
                            <?php }}?>
                        </a>
                        <div class="dropdown-menu dashboard-dropdown dropdown-menu-right">
                            <a class="dropdown-item font-weight-bold" href="profile">
                                <span class="far fa-user-circle"></span>My Profile
                            </a>
                            <a class="dropdown-item font-weight-bold mt-2" href="activity">
                                <span class="fas fa-cog"></span>Activity Log
                            </a>
                            <a class="dropdown-item font-weight-bold mt-2" href="profile-settings">
                                <span class="fas fa-cog"></span>Settings
                            </a>
                            <a class="dropdown-item font-weight-bold mt-2" href="help">
                                <span class="fas fa-envelope-open-text"></span>Help
                            </a>
                            <a class="dropdown-item font-weight-bold mt-2" href="report-problem">
                                <span class="fas fa-user-shield"></span>Support
                            </a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item font-weight-bold mt-2" href="Auth/logout">
                                <span class="fas fa-sign-out-alt text-danger"></span>Logout
                            </a>
                        </div>
                    </li>
                </ul>
                <?php }else if($_SESSION['id-role']>=7){?>
                <li class="nav-item m-auto">
                    <a class="btn-solid-lg border-0 font-weight-bold btn-light shadow text-uppercase fa-1x" href="Auth/logout">Keluar</a>
                </li>
                <?php }}}}}?>
            </ul>
        </div>
    </nav>
<!-- == end of navigation == -->