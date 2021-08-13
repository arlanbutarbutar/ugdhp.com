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
                <?php }else if(isset($_SESSION['id-user'])||isset($_SESSION['id-role'])){?>
                <li class="nav-item m-auto">
                    <a class="btn-solid-lg border-0 font-weight-bold btn-light shadow text-uppercase fa-1x" href="Auth/logout">Keluar</a>
                </li>
                <?php }}}}?>
            </ul>
        </div>
    </nav>
<!-- == end of navigation == -->