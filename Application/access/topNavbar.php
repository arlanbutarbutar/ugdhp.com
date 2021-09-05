<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark pl-0 pr-2 pb-0 ml-n3 mr-n3 border-bottom-left-radius-0 border-bottom-right-radius-0 shadow">
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
            <!-- = Search form = -->
                <div class="d-flex">
                    <!-- <form class="navbar-search form-inline ml-3" id="navbar-search-main">
                        <div class="input-group input-group-merge search-bar">
                            <span class="input-group-text" id="topbar-addon"><span class="fas fa-search"></span></span>
                            <input type="text" class="form-control form-control-sm" id="topbarInputIconLeft" placeholder="Search" aria-label="Search" aria-describedby="topbar-addon">
                        </div>
                    </form> -->
                </div>
            <!-- == end of Search form -->

            <!-- = Navbar links = -->
                <ul class="navbar-nav align-items-center mt-n2">
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link text-dark icon-notifications mt-1" data-unread-notifications="true" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="icon icon-sm">
                                <span class="fas fa-bell bell-shake <?= $colorMode?>"></span>
                                <span class="icon-badge rounded-circle unread-notifications"></span>
                            </span>
                        </a>
                        <div class="dropdown-menu dashboard-dropdown dropdown-menu-lg dropdown-menu-center mt-2 py-0 bg-<?= $bgMode?>">
                            <div class="list-group list-group-flush">
                                <a href="#" class="text-center text-primary font-weight-bold border-bottom border-light py-3 <?= $colorMode?>">Notifications</a>
                                <a href="../../pages/calendar.html" class="list-group-item list-group-item-action border-bottom border-light bg-<?= $bgMode?> <?= $colorMode?>">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img alt="Image placeholder" src="../Assets/img/img-users/default.png" class="user-avatar lg-avatar rounded-circle">
                                        </div>
                                        <div class="col pl-0 ml--2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h4 class="h6 mb-0 text-small">Jose Leos</h4>
                                                </div>
                                                <div class="text-right">
                                                    <small class="text-danger">a few moments ago</small>
                                                </div>
                                            </div>
                                            <p class="font-small mt-1 mb-0">Added you to an event "Project stand-up" tomorrow at 12:30 AM.</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="../../pages/tasks.html" class="list-group-item list-group-item-action border-bottom border-light bg-<?= $bgMode?> <?= $colorMode?>">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img alt="Image placeholder" src="../Assets/img/img-users/default.png" class="user-avatar lg-avatar rounded-circle">
                                        </div>
                                        <div class="col pl-0 ml--2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h4 class="h6 mb-0 text-small">Neil Sims</h4>
                                                </div>
                                                <div class="text-right">
                                                    <small class="text-danger">2 hrs ago</small>
                                                </div>
                                            </div>
                                            <p class="font-small mt-1 mb-0">You've been assigned a task for "Awesome new project".</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="../../pages/tasks.html" class="list-group-item list-group-item-action border-bottom border-light bg-<?= $bgMode?> <?= $colorMode?>">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img alt="Image placeholder" src="../Assets/img/img-users/default.png" class="user-avatar lg-avatar rounded-circle">
                                        </div>
                                        <div class="col pl-0 ml--2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h4 class="h6 mb-0 text-small">Roberta Casas</h4>
                                                </div>
                                                <div class="text-right">
                                                    <small>5 hrs ago</small>
                                                </div>
                                            </div>
                                            <p class="font-small mt-1 mb-0">Tagged you in a document called "First quarter financial plans",</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="../../pages/single-message.html" class="list-group-item list-group-item-action border-bottom border-light bg-<?= $bgMode?> <?= $colorMode?>">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img alt="Image placeholder" src="../Assets/img/img-users/default.png" class="user-avatar lg-avatar rounded-circle">
                                        </div>
                                        <div class="col pl-0 ml--2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h4 class="h6 mb-0 text-small">Joseph Garth</h4>
                                                </div>
                                                <div class="text-right">
                                                    <small>1 d ago</small>
                                                </div>
                                            </div>
                                            <p class="font-small mt-1 mb-0">New message: "Hey, what's up? All set for the presentation?"</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="../../pages/single-message.html" class="list-group-item list-group-item-action border-bottom border-light bg-<?= $bgMode?> <?= $colorMode?>">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img alt="Image placeholder" src="../Assets/img/img-users/default.png" class="user-avatar lg-avatar rounded-circle">
                                        </div>
                                        <div class="col pl-0 ml--2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h4 class="h6 mb-0 text-small">Bonnie Green</h4>
                                                </div>
                                                <div class="text-right">
                                                    <small>2 hrs ago</small>
                                                </div>
                                            </div>
                                            <p class="font-small mt-1 mb-0">New message: "We need to improve the UI/UX for the landing page."</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item text-center font-weight-bold py-3">View all</a>
                            </div>
                        </div>
                    </li> -->
                    <?php if($_SESSION['id-role']<=2){?>
                    <li class="nav-item ml-n2">
                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#search-all"><i class="fas fa-search <?= $colorMode?>"></i></button>
                        <div class="modal fade bg-<?= $bgMode?>" id="search-all" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content bg-<?= $bgMode?> <?= $colorMode?>">
                                    <div class="modal-header border-bottom-0">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">Pencarian Menyeluruh</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="modal-body">
                                            <div class="form-input">
                                                <input type="text" name="keyword-user" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Cari Pelanggan">
                                            </div>
                                            <div class="form-input mt-3">
                                                <select name="keyword-teknisi" class="form-control bg-<?= $bgMode?> <?= $colorMode?>">
                                                    <option value="">Pilih Teknisi</option>
                                                    <?php foreach($users_teknisi as $row_teknisi):?>
                                                        <option value="<?= $row_teknisi['id_user']?>"><?= $row_teknisi['first_name']?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                            <div class="form-input mt-3">
                                                <input type="number" name="keyword-nota" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Cari Nota">
                                            </div>
                                            <div class="form-input mt-3">
                                                <input type="text" name="keyword-sparepart" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Cari Sparepart">
                                            </div>
                                            <div class="form-input mt-3">
                                                <input type="date" name="keyword-tgl" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Cari Tanggal">
                                            </div>
                                            <div class="form-input mt-3">
                                                <input type="month" name="keyword-bln" class="form-control bg-<?= $bgMode?> <?= $colorMode?>" placeholder="Cari Bulan">
                                            </div>
                                        </div>
                                        <div class="modal-footer text-center border-top-0">
                                            <button type="button" class="btn btn-outline-<?= $btnMode?> btn-sm shadow" data-dismiss="modal">Keluar</button>
                                            <button type="submit" name="search-all" class="btn btn-info btn-sm shadow"><i class="fas fa-search"></i> Cari</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php }?>
                    <li class="nav-item ml-n2">
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="id-darkMode" value="<?= $rowMode['id_darkMode']?>">
                                <button type="submit" name="dark-mode" class="btn btn-link"><i class="<?= $rowMode['icon']." ".$colorMode?>"></i></button>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item dropdown mr-3 ml-3">
                        <a class="nav-link px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media d-flex align-items-center">
                            <?php if(mysqli_num_rows($user_views_profile)==0){?>
                                <p class="text-danger">Query error!</p>
                            <?php }if(mysqli_num_rows($user_views_profile)>0){while($row=mysqli_fetch_assoc($user_views_profile)){?>
                                <img class="user-avatar md-avatar rounded-circle" alt="Icon Profile" src="../Assets/img/img-users/<?= $row['img']?>">
                                <div class="media-body ml-2 text-dark align-items-center d-none d-lg-block">
                                    <span class="mb-0 font-small font-weight-bold <?= $colorMode?>"><?= $row['first_name'] ?></span>
                                </div>
                            </div>
                            <?php }}?>
                        </a>
                        <div class="dropdown-menu dashboard-dropdown dropdown-menu-right mt-2 bg-<?= $bgMode?> <?= $colorMode?>">
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
            <!-- == end of Navbar links == -->

        </div>
    </div>
</nav>