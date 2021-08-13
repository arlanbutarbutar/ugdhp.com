<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark pl-0 pr-2 pb-0 shadow">
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
            <!-- = Search form = -->
                <div class="d-flex">
                    <!-- <form class="navbar-search form-inline" id="navbar-search-main">
                        <div class="input-group input-group-merge search-bar">
                            <span class="input-group-text" id="topbar-addon"><span class="fas fa-search"></span></span>
                            <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Search" aria-label="Search" aria-describedby="topbar-addon">
                        </div>
                    </form> -->
                </div>
            <!-- = Navbar links = -->
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link pt-1 px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media d-flex align-items-center">
                            <?php if(mysqli_num_rows($user_views_profile)==0){?>
                                <p class="text-danger">Query error!</p>
                            <?php }if(mysqli_num_rows($user_views_profile)>0){while($row=mysqli_fetch_assoc($user_views_profile)){?>
                                <img class="user-avatar md-avatar rounded-circle" alt="Icon Profile" src="../Assets/img/img-users/<?= $row['img']?>">
                                <div class="media-body ml-2 text-dark align-items-center d-none d-lg-block">
                                    <span class="mb-0 font-small font-weight-bold"><?= $row['first_name'] ?></span>
                                </div>
                            </div>
                            <?php }}?>
                        </a>
                        <div class="dropdown-menu dashboard-dropdown dropdown-menu-right mt-2">
                            <a class="dropdown-item font-weight-bold" href="profile">
                                <span class="far fa-user-circle"></span>My Profile
                            </a>
                            <a class="dropdown-item font-weight-bold" href="activity">
                                <span class="fas fa-cog"></span>Activity Log
                            </a>
                            <a class="dropdown-item font-weight-bold" href="profile-settings">
                                <span class="fas fa-cog"></span>Settings
                            </a>
                            <a class="dropdown-item font-weight-bold" href="help">
                                <span class="fas fa-envelope-open-text"></span>Help
                            </a>
                            <a class="dropdown-item font-weight-bold" href="report-problem">
                                <span class="fas fa-user-shield"></span>Support
                            </a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item font-weight-bold" href="../Auth/logout">
                                <span class="fas fa-sign-out-alt text-danger"></span>Logout
                            </a>
                        </div>
                    </li>
                </ul>
        </div>
    </div>
</nav>