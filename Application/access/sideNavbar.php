<nav id="sidebarMenu" class="sidebar d-md-block bg-primary text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <?php foreach($userIcon as $row):?>
                <div class="user-avatar lg-avatar mr-4">
                    <img src="../Assets/img/img-users/<?= $row['img']?>" class="card-img-top rounded-circle border-white" alt="Bonnie Green">
                </div>
                <div class="d-block">
                    <h2 class="h6">Hi, <?= $username?></h2>
                    <a href="../Auth/logout" class="btn btn-secondary text-dark btn-xs"><span class="mr-2"><span class="fas fa-sign-out-alt"></span></span>Sign Out</a>
                </div>
                <?php endforeach;?>
            </div>
            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" class="fas fa-times" data-toggle="collapse"data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true"aria-label="Toggle navigation"></a>
            </div>
        </div>
        <ul class="nav flex-column">
            <h6 id="timestamp">Waktu Indonesia Tengah <?php require_once("../Application/controller/ajax_timestamp.php")?> <button type="submit" name="reload-page" onClick="window.location.reload();" class="btn btn-link btn-sm text-white text-decoration-none"><i class="fas fa-undo-alt"></i></button></h3>
            <li class="nav-item  active ">
                <a href="./" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                    <span>Console</span>
                </a>
            </li>
            <?php $role_id = addslashes(trim($_SESSION['id-role']));
                $menuValue = "SELECT `menu`.`id_menu`, `menu` FROM `menu` JOIN `menu_access` ON `menu`.`id_menu` = `menu_access`.`id_menu` WHERE `menu_access`.`role_id` = $role_id ORDER BY `menu_access`.`id_menu` ASC";
                $menu = mysqli_query($conn_back, $menuValue); foreach ($menu as $m) : ?>
            <li class="nav-item">
                <span class="nav-link  collapsed  d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#submenu-components<?= $m['id_menu']?>">
                    <span> <?= $m['menu']; ?></span>
                    <span class="link-arrow"><span class="fas fa-chevron-right"></span></span> 
                </span>
                <div class="collapse " role="list" id="submenu-components<?= $m['id_menu']?>" aria-expanded="false">
                    <ul class="flex-column nav">
                        <?php $menuId = $m['id_menu'];
                            $querySubMenu = "SELECT * FROM `menu_sub` JOIN `menu` ON `menu_sub`.`id_menu` = `menu`.`id_menu` JOIN `menu_sub_access` ON `menu_sub`.`id_sub_menu` = `menu_sub_access`.`id_sub_menu` WHERE `menu_sub`.`id_menu`=$menuId AND `menu_sub`.`is_active`=1 AND `menu_sub_access`.`role_id` = $role_id";
                            $subMenu = mysqli_query($conn_back, $querySubMenu); foreach ($subMenu as $sm) : ?>
                        <li class="nav-item ">
                            <a class="nav-link" href="<?= $sm['url']; ?>">
                                <span><span class="sidebar-icon"><i class="<?= $sm['icon']; ?>"></i></span> <?= $sm['title']; ?></span>
                            </a>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </li>
            <?php endforeach; ?>
            <li role="separator" class="dropdown-divider mt-4 mb-3 border-black"></li>
            <li class="nav-item">
                <a href="apps-store" class="nav-link d-flex align-items-center">
                    <span class="sidebar-icon">
                        <img src="../Assets/console/img/brand/light.svg" height="20" width="20" alt="Volt Logo">
                    </span>
                    <span class="mt-1">UGD HP Store</span>
                </a>
            </li>
        </ul>
    </div>
</nav>