<?php if(!isset($_SESSION[''])){session_start();}
require_once("connect.php");require_once("functions.php");require_once("time.php");

// => Front End
    $header=mysqli_query($conn_front, "SELECT * FROM header");
    $service_head=mysqli_query($conn_front, "SELECT * FROM service_head");
    $service_body=mysqli_query($conn_front, "SELECT * FROM service_body");
    $about_head=mysqli_query($conn_front, "SELECT * FROM about_head");
    $about_body=mysqli_query($conn_front, "SELECT * FROM about_body");
    $nav_icon=mysqli_query($conn_front, "SELECT * FROM nav_icon");
    $navbar=mysqli_query($conn_front, "SELECT * FROM navbar JOIN navbar_model ON navbar.id_model=navbar_model.id_model");
    $about_service=mysqli_query($conn_front, "SELECT * FROM about_service JOIN about_service_spesifik ON about_service.id_service=about_service_spesifik.id_service");
    $pricing=mysqli_query($conn_front, "SELECT * FROM pricing");
    $video=mysqli_query($conn_front, "SELECT * FROM video");
    $testimonial=mysqli_query($conn_front, "SELECT * FROM testimonial");
    $contact=mysqli_query($conn_front, "SELECT * FROM contact");
    $terms_conditions=mysqli_query($conn_front, "SELECT * FROM terms_conditions");
    $privacy_policy=mysqli_query($conn_front, "SELECT * FROM privacy_policy");
    if(isset($_POST['kirim-pesan'])){if(kontak($_POST)>0){
        $_SESSION['message-success']="Terima kasih pesan anda sudah terkirim, akan kami jawab secepat mungkin.";$_SESSION['time-message']=time();header("Location: #contact");exit;}}
    if(isset($_POST['send-saran'])){if(saran($_POST)>0){
        $_SESSION['message-success']="Terima kasih sudah memberikan saran anda yang sangat berguna bagi perkembangan UGD HP";$_SESSION['time-message']=time();header("Location: hp#handphone");exit;}}
// => end of Front End

if(!isset($_SESSION['id-user'])&&!isset($_SESSION['id-role'])){

    // => Alert
        if (isset($_SESSION['message-success'])) {
            $message_success = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <div class=''>".$_SESSION['message-success']."</div>
            <form action='' method='POST'>
                <button type='submit' name='message-success' class='close mt-2 mr-2'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </form>
        </div>";
        }
        if (isset($_SESSION['message-warning'])) {
            $message_warning = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <div class=''>".$_SESSION['message-warning']."</div>
            <form action='' method='POST'>
                <button type='submit' name='message-warning' class='close mt-2 mr-2'>>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </form>
        </div>";
        }
        if (isset($_SESSION['message-danger'])) {
            $message_danger = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <div class=''>".$_SESSION['message-danger']."</div>
            <form action='' method='POST' class=''>
                <button type='submit' name='message-danger' class='close mt-2 mr-2'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </form>
        </div>";
        }
        if (isset($_SESSION['message-info'])) {
            $message_info = "<div class='alert alert-info alert-dismissible fade show' role='alert'>
            <div class=''>".$_SESSION['message-info']."</div>
            <form action='' method='POST'>
                <button type='submit' name='message-info' class='close mt-2 mr-2'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </form>
        </div>";
        }
        if (isset($_SESSION['message-dark'])) {
            $message_dark = "<div class='alert alert-dark alert-dismissible fade show' role='alert'>
                    " . $_SESSION['message-dark'] . "
                        <form action='' method='POST'>
                            <button type='submit' name='message-dark' class='close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </form>
                    </div>";
        }
        if (isset($_POST['message-success'])) {
            unset($_SESSION['message-success']);
            if(!isset($_SESSION['page-to'])){
                header("Location: ./");exit;
            }if(isset($_SESSION['page-to'])){
                header("Location: ".$_SESSION['page-to']);exit;
            }
        }
        if (isset($_POST['message-warning'])) {
            unset($_SESSION['message-warning']);
            if(!isset($_SESSION['page-to'])){
                header("Location: ./");exit;
            }if(isset($_SESSION['page-to'])){
                header("Location: ".$_SESSION['page-to']);exit;
            }
        }
        if (isset($_POST['message-danger'])) {
            unset($_SESSION['message-danger']);
            if(!isset($_SESSION['page-to'])){
                header("Location: ./");exit;
            }if(isset($_SESSION['page-to'])){
                header("Location: ".$_SESSION['page-to']);exit;
            }
        }
        if (isset($_POST['message-info'])) {
            unset($_SESSION['message-info']);
            if(!isset($_SESSION['page-to'])){
                header("Location: ./");exit;
            }if(isset($_SESSION['page-to'])){
                header("Location: ".$_SESSION['page-to']);exit;
            }
        }
        if (isset($_POST['message-dark'])) {
            unset($_SESSION['message-dark']);
            if(!isset($_SESSION['page-to'])){
                header("Location: ./");exit;
            }if(isset($_SESSION['page-to'])){
                header("Location: ".$_SESSION['page-to']);exit;
            }
        }
        if(isset($_SESSION['message-success'])||isset($_SESSION['message-info'])||isset($_SESSION['message-warning'])||isset($_SESSION['message-danger'])||isset($_SESSION['message-dark'])){
        if(isset($_SESSION['time-message'])){
            if((time()-$_SESSION['time-message'])>10){
                if(isset($_SESSION['message-success'])){unset($_SESSION['message-success']);}
                if(isset($_SESSION['message-info'])){unset($_SESSION['message-info']);}
                if(isset($_SESSION['message-warning'])){unset($_SESSION['message-warning']);}
                if(isset($_SESSION['message-danger'])){unset($_SESSION['message-danger']);}
                if(isset($_SESSION['message-dark'])){unset($_SESSION['message-dark']);}
                unset($_SESSION['time-alert']);
            }}}
    // => end of Alert

    // => Front End   
        if(isset($_POST['lupa-sandi'])){
            if(forgot_password($_POST)>0){
                header("Location: sandi-baru");exit;
            }
        }
        if(isset($_POST['sandi-baru'])){
            if(new_password($_POST)>0){
                header("Location: masuk");exit;
            }
        }
    // => end of Front End
    
    // => Back End
        if(isset($_POST['daftar'])){if(daftar($_POST)>0){
            header("Location: verifikasi");exit;}}
        if(isset($_POST['masuk'])){if(masuk($_POST)>0){
            header("Location: redirect");exit;}}
    // => end of Back End

}
if(isset($_SESSION['id-user'])&&isset($_SESSION['id-role'])){
    
    // => Alert
        if (isset($_SESSION['message-success'])) {
            $message_success = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <div class='text-white'>".$_SESSION['message-success']."</div>
            <form action='' method='POST'>
                <button type='submit' name='message-success' class='close mt-2 mr-2'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </form>
        </div>";
        }
        if (isset($_SESSION['message-warning'])) {
            $message_warning = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <div class='text-white'>".$_SESSION['message-warning']."</div>
            <form action='' method='POST'>
                <button type='submit' name='message-warning' class='close mt-2 mr-2'>>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </form>
        </div>";
        }
        if (isset($_SESSION['message-danger'])) {
            $message_danger = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <div class='text-white'>".$_SESSION['message-danger']."</div>
            <form action='' method='POST' class=''>
                <button type='submit' name='message-danger' class='close mt-2 mr-2'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </form>
        </div>";
        }
        if (isset($_SESSION['message-info'])) {
            $message_info = "<div class='alert alert-info alert-dismissible fade show' role='alert'>
            <div class='text-white'>".$_SESSION['message-info']."</div>
            <form action='' method='POST'>
                <button type='submit' name='message-info' class='close mt-2 mr-2'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </form>
        </div>";
        }
        if (isset($_SESSION['message-dark'])) {
            $message_dark = "<div class='alert alert-dark alert-dismissible fade show' role='alert'>
                    " . $_SESSION['message-dark'] . "
                        <form action='' method='POST'>
                            <button type='submit' name='message-dark' class='close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </form>
                    </div>";
        }
        if (isset($_POST['message-success'])) {
            unset($_SESSION['message-success']);
            if(!isset($_SESSION['page-to'])){
                header("Location: ./");exit;
            }if(isset($_SESSION['page-to'])){
                header("Location: ".$_SESSION['page-to']);exit;
            }
        }
        if (isset($_POST['message-warning'])) {
            unset($_SESSION['message-warning']);
            if(!isset($_SESSION['page-to'])){
                header("Location: ./");exit;
            }if(isset($_SESSION['page-to'])){
                header("Location: ".$_SESSION['page-to']);exit;
            }
        }
        if (isset($_POST['message-danger'])) {
            unset($_SESSION['message-danger']);
            if(!isset($_SESSION['page-to'])){
                header("Location: ./");exit;
            }if(isset($_SESSION['page-to'])){
                header("Location: ".$_SESSION['page-to']);exit;
            }
        }
        if (isset($_POST['message-info'])) {
            unset($_SESSION['message-info']);
            if(!isset($_SESSION['page-to'])){
                header("Location: ./");exit;
            }if(isset($_SESSION['page-to'])){
                header("Location: ".$_SESSION['page-to']);exit;
            }
        }
        if (isset($_POST['message-dark'])) {
            unset($_SESSION['message-dark']);
            if(!isset($_SESSION['page-to'])){
                header("Location: ./");exit;
            }if(isset($_SESSION['page-to'])){
                header("Location: ".$_SESSION['page-to']);exit;
            }
        }
        if(isset($_SESSION['message-success'])||isset($_SESSION['message-info'])||isset($_SESSION['message-warning'])||isset($_SESSION['message-danger'])||isset($_SESSION['message-dark'])){
        if(isset($_SESSION['time-message'])){
            if((time()-$_SESSION['time-message'])>10){
                if(isset($_SESSION['message-success'])){unset($_SESSION['message-success']);}
                if(isset($_SESSION['message-info'])){unset($_SESSION['message-info']);}
                if(isset($_SESSION['message-warning'])){unset($_SESSION['message-warning']);}
                if(isset($_SESSION['message-danger'])){unset($_SESSION['message-danger']);}
                if(isset($_SESSION['message-dark'])){unset($_SESSION['message-dark']);}
                unset($_SESSION['time-alert']);
            }}}
    // => end of Alert

    $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_SESSION['id-user']))));
    $id_role=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_SESSION['id-role']))));
    $id_log=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_SESSION['id-log']))));
    $is_active=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_SESSION['is-active']))));
    $id_access=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_SESSION['id-access']))));
    $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_SESSION['username']))));
    $id_tools=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_SESSION['id-tools']))));
    $ui=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_SESSION['id-ui']))));
    $id_keyConsole=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_SESSION['id-keyConsole']))));
    $today=date('Y-m-d');
    $dateMonth=date('m');
    $dateMon=date('m');
    if($dateMon>=01){
        $dateMonthYe=$dateMon-01;
    }else if($dateMon==01){
        $dateMonthYe=01;}
    $dateYear=date("Y");
    // => Admin & Founder
    if($_SESSION['id-role']<=2){
        // ==> Date Yesterday
        $notesValueDPYe=mysqli_query($conn_back, "SELECT SUM(dp) as totalDP FROM notes WHERE month(tgl_cari)='$dateMonthYe' AND year(tgl_cari)='$dateYear' AND id_nota=1");
        $rowInDPYe=mysqli_fetch_assoc($notesValueDPYe);
        $incomeDPYe=$rowInDPYe['totalDP'];
        $notesValueBiayaYe=mysqli_query($conn_back, "SELECT SUM(biaya) as totalBiaya FROM notes WHERE month(tgl_cari)='$dateMonthYe' AND year(tgl_cari)='$dateYear' AND id_nota=5");
        $rowInBiayaYe=mysqli_fetch_assoc($notesValueBiayaYe);
        $incomeBiayaYe=$rowInBiayaYe['totalBiaya'];
        $incomeYe=$incomeBiayaYe+$incomeDPYe;
        // ==> Date Now
        $notesValueDP=mysqli_query($conn_back, "SELECT SUM(dp) as totalDP FROM notes WHERE month(tgl_cari)='$dateMonth' AND year(tgl_cari)='$dateYear' AND id_nota=1");
        $rowInDP=mysqli_fetch_assoc($notesValueDP);
        $incomeDP=$rowInDP['totalDP'];
        $notesValueBiaya=mysqli_query($conn_back, "SELECT SUM(biaya) as totalBiaya FROM notes WHERE month(tgl_cari)='$dateMonth' AND year(tgl_cari)='$dateYear' AND id_nota=5");
        $rowInBiaya=mysqli_fetch_assoc($notesValueBiaya);
        $incomeBiaya=$rowInBiaya['totalBiaya'];
        $income=$incomeBiaya+$incomeDP;
        // ==> Income Value
        if($incomeYe>0){
            $incomePer=round((($income-$incomeYe)/$incomeYe)*100,2);
        }else{
            $incomePer="0";
        }
        if($incomeYe>$income){
            $iconPer="down";
            $colorPer="danger";
        }else if($incomeYe<$income){
            $iconPer="up";
            $colorPer="success";}
        // ==> Chart Income
        $chartIncome=mysqli_query($conn_back, "SELECT * FROM cal_grafik");
        // ==> Help
        $help_message_admin=mysqli_query($conn_back, "SELECT * FROM users_help ORDER BY id_help DESC");
        if(isset($_POST['help-admin'])){
            if(help_answer_message($_POST)>0){
                $_SESSION['message-success']="Pesan berhasil di balas.";
                $_SESSION['time-message']=time();
                header("Location: help");exit;
            }
        }
        // ==> Menu
        $data1=25;
        $result1=mysqli_query($conn_back, "SELECT * FROM menu");
        $total1=mysqli_num_rows($result1);
        $total_page1=ceil($total1/$data1);
        $page1=(isset($_GET['page']))?$_GET['page']:1;
        $awal_data1=($data1*$page1)-$data1;
        $menus=mysqli_query($conn_back, "SELECT * FROM menu LIMIT $awal_data1, $data1");
        $menus_edit=mysqli_query($conn_back, "SELECT * FROM menu");
        if(isset($_POST['submit-menu'])){
            if(menu($_POST)>0){
                $_SESSION['message-success']="Menu baru telah ditambahkan.";
                $_SESSION['time-message']=time();
                header("Location: menu");exit;
            }
        }
        if(isset($_POST['ubah-menu'])){
            if(edit_menu($_POST)>0){
                $_SESSION['message-success']="Menu telah berhasil diubah.";
                $_SESSION['time-message']=time();
                header("Location: menu");exit;
            }
        }
        if(isset($_POST['hapus-menu'])){
            if(delete_menu($_POST)>0){
                $_SESSION['message-success']="Yah menunya udah dihapus, semoga ada menu yang lebih baik :).";
                $_SESSION['time-message']=time();
                header("Location: menu");exit;
            }
        }
        // ==> Sub Menu
        $menu_status_insert=mysqli_query($conn_back, "SELECT * FROM menu_status");
        $menu_status_edit=mysqli_query($conn_back, "SELECT * FROM menu_status");
        $data2=25;
        $result2=mysqli_query($conn_back, "SELECT * FROM menu_sub");
        $total2=mysqli_num_rows($result2);
        $total_page2=ceil($total2/$data2);
        $page2=(isset($_GET['page']))?$_GET['page']:1;
        $awal_data2=($data2*$page2)-$data2;
        $menu_sub=mysqli_query($conn_back, "SELECT * FROM menu_sub JOIN menu ON menu_sub.id_menu=menu.id_menu JOIN menu_status ON menu_sub.is_active=menu_status.id_status LIMIT $awal_data2, $data2");
        $menu_sub_select=mysqli_query($conn_back, "SELECT * FROM menu_sub WHERE is_active=1");
        if(isset($_POST['submit-sub-menu'])){
            if(sub_menu($_POST)>0){
                $_SESSION['message-success']="Sub Menu baru telah ditambahkan.";
                $_SESSION['time-message']=time();
                header("Location: sub-menu");exit;
            }
        }
        if(isset($_POST['edit-sub-menu'])){
            if(edit_sub_menu($_POST)>0){
                $_SESSION['message-success']="Sub Menu berhasil diubah.";
                $_SESSION['time-message']=time();
                header("Location: sub-menu");exit;
            }
        }
        if(isset($_POST['delete-sub-menu'])){
            if(delete_sub_menu($_POST)>0){
                $_SESSION['message-success']="Yah sub menunya hilang, mungkin ada sub menu yang lebih menarik lainnya :).";
                $_SESSION['time-message']=time();
                header("Location: sub-menu");exit;
            }
        }
        // ==> Access Menu
        $data3=25;
        $result3=mysqli_query($conn_back, "SELECT * FROM menu_access");
        $total3=mysqli_num_rows($result3);
        $total_page3=ceil($total3/$data3);
        $page3=(isset($_GET['page']))?$_GET['page']:1;
        $awal_data3=($data3*$page3)-$data3;
        $menu_access=mysqli_query($conn_back, "SELECT * FROM menu_access JOIN users_role ON menu_access.role_id=users_role.id_role JOIN menu ON menu_access.id_menu=menu.id_menu LIMIT $awal_data3, $data3");
        $users_roles=mysqli_query($conn_back, "SELECT * FROM users_role WHERE id_role<=6");
        if(isset($_POST['submit-access-menu'])){
            if(access_menu($_POST)>0){
                $_SESSION['message-success']="Berhasil menambahkan hak akses menu.";
                $_SESSION['time-message']=time();
                header("Location: access-menu");exit;
            }
        }
        if(isset($_POST['hapus-access-menu'])){
            if(delete_access_menu($_POST)>0){
                $_SESSION['message-success']="Yah hak akses menunya hilang, mungkin ada kesempatan hak akses untuk role lainnya :).";
                $_SESSION['time-message']=time();
                header("Location: access-menu");exit;
            }
        }
        // ==> Access Sub Menu
        $data4=25;
        $result4=mysqli_query($conn_back, "SELECT * FROM menu_sub_access");
        $total4=mysqli_num_rows($result4);
        $total_page4=ceil($total4/$data4);
        $page4=(isset($_GET['page']))?$_GET['page']:1;
        $awal_data4=($data4*$page4)-$data4;
        $menu_sub_access=mysqli_query($conn_back, "SELECT * FROM menu_sub_access JOIN users_role ON menu_sub_access.role_id=users_role.id_role JOIN menu_sub ON menu_sub_access.id_sub_menu=menu_sub.id_sub_menu LIMIT $awal_data4, $data4");
        if(isset($_POST['submit-access-sub-menu'])){
            if(access_sub_menu($_POST)>0){
                $_SESSION['message-success']="Berhasil menambahkan hak akses sub menu.";
                $_SESSION['time-message']=time();
                header("Location: access-sub-menu");exit;
            }
        }
        if(isset($_POST['hapus-access-sub-menu'])){
            if(delete_access_sub_menu($_POST)>0){
                $_SESSION['message-success']="Yah hak akses sub menunya hilang, mungkin ada kesempatan hak akses untuk role lainnya :).";
                $_SESSION['time-message']=time();
                header("Location: access-sub-menu");exit;
            }
        }
        // ==> Privacy Policy
        $privacy_policy=mysqli_query($conn_front, "SELECT * FROM privacy_policy");
        if(isset($_POST['submit-privacy'])){
            if(privacy_policy($_POST)>0){
                $_SESSION['message-success']="Kebikajan privasi telah anda tambahkan.";
                $_SESSION['time-message']=time();
                header("Location: privacy-policy");exit;
            }
        }
        if(isset($_POST['edit-privacy'])){
            if(edit_privacy_policy($_POST)>0){
                $_SESSION['message-success']="Kebikajan privasi telah anda edit.";
                $_SESSION['time-message']=time();
                header("Location: privacy-policy");exit;
            }
        }
        if(isset($_POST['delete-privacy'])){
            if(delete_privacy_policy($_POST)>0){
                $_SESSION['message-success']="Yah... kebikajan privasi sudah dihapus, silakan masukan kebijakan yang baru ya :).";
                $_SESSION['time-message']=time();
                header("Location: privacy-policy");exit;
            }
        }
        // ==> Term of Services
        $term_of_service=mysqli_query($conn_front, "SELECT * FROM terms_conditions");
        if(isset($_POST['submit-term'])){
            if(term_of_service($_POST)>0){
                $_SESSION['message-success']="Persyaratan layanan telah anda tambahkan.";
                $_SESSION['time-message']=time();
                header("Location: term-of-service");exit;
            }
        }
        if(isset($_POST['edit-term'])){
            if(edit_term_of_service($_POST)>0){
                $_SESSION['message-success']="Persyaratan layanan telah anda edit.";
                $_SESSION['time-message']=time();
                header("Location: term-of-service");exit;
            }
        }
        if(isset($_POST['delete-term'])){
            if(delete_term_of_service($_POST)>0){
                $_SESSION['message-success']="Yah... persyaratan layanan sudah dihapus, silakan masukan kebijakan yang baru ya :).";
                $_SESSION['time-message']=time();
                header("Location: term-of-service");exit;
            }
        }
    }
    // => Employee
    if($_SESSION['id-role']<=3){
        $newTask=mysqli_query($conn_back, "SELECT * FROM menu_sub JOIN menu ON menu_sub.id_menu=menu.id_menu JOIN menu_access ON menu.id_menu=menu_access.id_menu WHERE menu_access.role_id='$id_role'");
        // ==> Users/Repair
        $usersView=mysqli_query($conn_back, "SELECT * FROM users WHERE id_role>=7");
        $userView=mysqli_num_rows($usersView);
        $usersRepair=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_status<=6");
        $userRepair=mysqli_num_rows($usersRepair);
        $startUsers=mysqli_query($conn_back, "SELECT * FROM users WHERE id_role='7' ORDER BY id_user ASC LIMIT 1");
        if(mysqli_num_rows($startUsers)>0){
            $rStartUsers=mysqli_fetch_assoc($startUsers);
            $rowStartUsers=$rStartUsers['date_created'];
        }else if(mysqli_num_rows($startUsers)==0){
            $rowStartUsers=date('M d');}
        // ==> Income/Expense
        $notesIncome_ValueDP=mysqli_query($conn_back, "SELECT SUM(dp) as total FROM notes WHERE month(tgl_cari)='$dateMonth' AND year(tgl_cari)='$dateYear' AND id_nota=1");
        $incomeValueDP=mysqli_fetch_assoc($notesIncome_ValueDP);
        $notesIncome_ValueBiaya=mysqli_query($conn_back, "SELECT SUM(biaya) as total FROM notes WHERE month(tgl_cari)='$dateMonth' AND year(tgl_cari)='$dateYear' AND id_nota=5");
        $incomeValueBiaya=mysqli_fetch_assoc($notesIncome_ValueBiaya);
        $incomeValue=$incomeValueBiaya['total']+$incomeValueDP['total'];
        $valueIncomeInfo=number_format($incomeValue);
        $expenseInfo=mysqli_query($conn_back, "SELECT SUM(biaya_pengeluaran) as total FROM laporan_pengeluaran WHERE month(tgl_cari)='$dateMonth' AND year(tgl_cari)='$dateYear'");
        $expenseValues=mysqli_fetch_assoc($expenseInfo);
        $sparepartInfo=mysqli_query($conn_back, "SELECT SUM(harga) as total FROM laporan_spareparts WHERE month(tgl_cari)='$dateMonth' AND year(tgl_cari)='$dateYear' AND status_sparepart=1");
        $sparepartValue=mysqli_fetch_assoc($sparepartInfo);
        $expenseValue=$expenseValues['total']+$sparepartValue['total'];
        $valueExpenseInfo=number_format($expenseValue);
        $startInEx=mysqli_query($conn_back, "SELECT * FROM notes WHERE month(tgl_cari)='$dateMonth' AND year(tgl_cari)='$dateYear' ORDER BY id_data ASC LIMIT 1");
        if(mysqli_num_rows($startInEx)>0){
            $rStartInEx=mysqli_fetch_assoc($startInEx);
            $rowStartInEx=$rStartInEx['tgl_cari'];
        }else{
            $rowStartInEx=date('M d');}
        // ==> Total Repair
        $totalRepairHP=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_layanan=1");
        $countTotalRepairHP=mysqli_num_rows($totalRepairHP);
        $totalRepairLaptop=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_layanan=2");
        $countTotalRepairLaptop=mysqli_num_rows($totalRepairLaptop);
        // ==> Total Spareparts
        $sparepartsTotalNow=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE month(tgl_cari)='$dateMonth' AND year(tgl_cari)='$dateYear'");
        $countTotalSparepartsNow=mysqli_num_rows($sparepartsTotalNow);
        $sparepartsTotal=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE month(tgl_cari)='$dateMonthYe' AND year(tgl_cari)='$dateYear'");
        $countTotalSpareparts=mysqli_num_rows($sparepartsTotal);
        // ==> Tanggal awal presentase sampai akir
        $dateSparepartNow=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE month(tgl_cari)='$dateMonth' ORDER BY id_sparepart DESC LIMIT 1"); // ===> Query
        if(mysqli_num_rows($dateSparepartNow)>0){
            $rowSparepartDateNow=mysqli_fetch_assoc($dateSparepartNow); // ===> Value
            $dateSparepart=$rowSparepartDateNow['tgl_masuk'];
        }else if(mysqli_num_rows($dateSparepartNow)==0){
            $dateSparepart=date('M');}
        $dateSparepartYe=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE month(tgl_cari)='$dateMonthYe' ORDER BY id_sparepart ASC LIMIT 1"); // ===> Query
        if(mysqli_num_rows($dateSparepartYe)>0){
            $rowSparepartDate=mysqli_fetch_assoc($dateSparepartYe); // ===> Value
            $dateSparepartLn=$rowSparepartDate['tgl_masuk'];
        }else if(mysqli_num_rows($dateSparepartYe)==0){
            $dateSparepartLn=date('M');}
        // ==> Presentase harga selisih bulan ini dan bulan lalu pengeluaran Spareparts
        $sparepartTotalNow=mysqli_query($conn_back, "SELECT SUM(total) as total FROM laporan_spareparts WHERE month(tgl_cari)='$dateMonth' AND year(tgl_cari)='$dateYear'"); // ===> Query
        $rowTotalSparepartsNow=mysqli_fetch_assoc($sparepartTotalNow); // ===> Value
        $sparepartTotal=mysqli_query($conn_back, "SELECT SUM(total) as total FROM laporan_spareparts WHERE month(tgl_cari)='$dateMonthYe' AND year(tgl_cari)='$dateYear'"); // ===> Query
        if(mysqli_num_rows($sparepartTotalNow)>0){
            if(mysqli_num_rows($sparepartTotal)>0){
                $rowTotalSpareparts=mysqli_fetch_assoc($sparepartTotal); // ===> Value
                if($rowTotalSpareparts['total']>0){
                    $totalSparepartValue=$rowTotalSparepartsNow['total']-$rowTotalSpareparts['total'];
                    $sparepartsTotalPer=round(($totalSparepartValue/$rowTotalSpareparts['total'])*100,2);
                    if($rowTotalSpareparts['total']>$rowTotalSparepartsNow){
                        $iconPerSparepart="up";
                        $colorPerSparepart="success";
                    }else if($rowTotalSpareparts['total']<$rowTotalSparepartsNow){
                        $iconPerSparepart="down";
                        $colorPerSparepart="danger";}
                }else{
                    $iconPerSparepart="up";
                    $colorPerSparepart="success";
                    $sparepartsTotalPer=0;}
            }else{
                $iconPerSparepart="up";
                $colorPerSparepart="success";
                $sparepartsTotalPer=0;}}else{
                    $iconPerSparepart="up";
                    $colorPerSparepart="success";
                    $sparepartsTotalPer=0;}
        // ==> Report Problem
        if(isset($_POST['submit-report-problem'])){
            if(report_problem($_POST)>0){
                $_SESSION['message-success']="Report telah di tambahkan.";
                $_SESSION['time-message']=time();
                header("Location: report-problem");exit;}}
        // ==> Users Management
        $data5=25;
        $result5=mysqli_query($conn_back, "SELECT * FROM users");
        $total5=mysqli_num_rows($result5);
        $total_page5=ceil($total5/$data5);
        $page5=(isset($_GET['page']))?$_GET['page']:1;
        $awal_data5=($data5*$page5)-$data5;
        $users_data=mysqli_query($conn_back, "SELECT * FROM users 
            JOIN category_services ON users.id_category=category_services.id_category 
            JOIN users_role ON users.id_role=users_role.id_role
            JOIN users_status ON users.is_active=users_status.is_active
            JOIN users_access ON users.id_access=users_access.id_access 
            WHERE users.id_user!='$id_user' LIMIT $awal_data5, $data5");
        if(isset($_POST['search-users'])&&$_POST['keyword-users']!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['keyword-users']))));
            $users_data=mysqli_query($conn_back, "SELECT * FROM users 
                JOIN category_services ON users.id_category=category_services.id_category 
                JOIN users_role ON users.id_role=users_role.id_role
                JOIN users_status ON users.is_active=users_status.is_active
                JOIN users_access ON users.id_access=users_access.id_access 
                WHERE users.id_user!='$id_user' AND users.first_name LIKE '%$keyword%' OR users.last_name LIKE '%$keyword%' OR users.email LIKE '%$keyword%' LIMIT $awal_data5, $data5");}
        $users_data_role=mysqli_query($conn_back, "SELECT * FROM users_role");
        $users_data_status=mysqli_query($conn_back, "SELECT * FROM users_status");
        $users_data_access=mysqli_query($conn_back, "SELECT * FROM users_access");
        if(isset($_POST['edit-users'])){
            if(users_edit($_POST)>0){
                $_SESSION['message-success']="Akun users berhasil diubah.";
                $_SESSION['time-message']=time();
                header("Location: users");exit;}}
        if(isset($_POST['delete-user'])){
            if(delete_users($_POST)>0){
                $_SESSION['message-success']="Akun users berhasil dihapus.";
                $_SESSION['time-message']=time();
                header("Location: users");exit;}}
        // ==> Setting Nota
        $data6=25;
        $result6=mysqli_query($conn_back, "SELECT * FROM notes_type");
        $total6=mysqli_num_rows($result6);
        $total_page6=ceil($total6/$data6);
        $page6=(isset($_GET['page']))?$_GET['page']:1;
        $awal_data6=($data6*$page6)-$data6;
        $notes_type=mysqli_query($conn_back, "SELECT * FROM notes_type LIMIT $awal_data6, $data6");
        if(isset($_POST['submit-notes-type'])){
            if(notes_type($_POST)>0){
                $_SESSION['message-success']="Berhasil menambahkan nota baru.";
                $_SESSION['time-message']=time();
                header("Location: setting-nota");exit;}}
        if(isset($_POST['edit-notes-type'])){
            if(edit_notes_type($_POST)>0){
                $_SESSION['message-success']="Berhasil mengubah nota.".$_POST['name'].".";
                $_SESSION['time-message']=time();
                header("Location: setting-nota");exit;}}
        if(isset($_POST['delete-notes-type'])){
            if(delete_notes_type($_POST)>0){
                $_SESSION['message-success']="Berhasil menghapus nota ".$_POST['name'].".";
                $_SESSION['time-message']=time();
                header("Location: setting-nota");exit;}}
        // ==> Nota Tinggal
        $category_services=mysqli_query($conn_back, "SELECT * FROM category_services WHERE id_category<=2");
        $users_teknisi=mysqli_query($conn_back, "SELECT * FROM users WHERE id_role=4");
        if(isset($_POST['submit-notes'])){
            if(notes($_POST)>0){
                $_SESSION['message-success']="Berhasil memasukan nota";
                $_SESSION['time-message']=time();
                header("Location: nota-tinggal");exit;}}
        if(isset($_POST['remake-barcode'])){
            if(remake_barcode($_POST)>0){
                $_SESSION['message-success']="Berhasil membuat ulang barcode";
                $_SESSION['time-message']=time();
                header("Location: nota-tinggal");exit;}}
        if(isset($_POST['edit-notes-lunas'])){
            if(edit_notesLunas($_POST)>0){
                $_SESSION['message-success']="Nota tinggal yang kamu ubah berhasil.";
                $_SESSION['time-message']=time();
                header("Location: nota-tinggal");exit;}}
        if(isset($_POST['delete-notes'])){
            if(delete_notes($_POST)>0){
                $_SESSION['message-success']="Berhasil menghapus nota";
                $_SESSION['time-message']=time();
                header("Location: nota-tinggal");exit;}}
        $notesStatus=mysqli_query($conn_back, "SELECT * FROM notes_status WHERE id_status<=5");
        if(isset($_POST['ubah-status-NT'])){
            if(editStatusNT($_POST)>0){
                $_SESSION['message-success']="Berhasil mengubah status nota tinggal";
                $_SESSION['time-message']=time();
                header("Location: nota-tinggal");exit;}}
        // ==> Nota Lunas
        if(isset($_POST['submit-notes-lunas'])){
            if(notes_lunas($_POST)>0){
                $_SESSION['message-success']="Berhasil memasukan nota lunas, silakan cek kembali untuk selanjutnya dimasukan ke laporan harian.";
                $_SESSION['time-message']=time();
                header("Location: nota-lunas");exit;}}
        if(isset($_POST['notes-report'])){
            if(notes_report($_POST)>0){
                $_SESSION['message-success']="Berhasil memasukan nota lunas ke laporan harian.";
                $_SESSION['time-message']=time();
                header("Location: nota-lunas");exit;}}
        // ==> Repair Reviews
        if(isset($_POST['ubah-cepat-status'])){
            if(quickStatus($_POST)>0){
                $_SESSION['message-success']="Kemu telah mengubah status nota dengan menggunakan Quick Status";
                $_SESSION['time-message']=time();
                header("Location: ./#repair-reviews");exit;}}
        // ==> Nota Cancel
        if(isset($_POST['notes-recovery'])){
            if(notesRecovery($_POST)>0){
                $_SESSION['message-success']="Recovery data nota batal berhasil, silakan cek data di nota tinggal.";
                $_SESSION['time-message']=time();
                header("Location: nota-cancel");exit;}}
        // ==> Report Down Payment
        $data10=25;
        $result10=mysqli_query($conn_back, "SELECT * FROM notes WHERE notes.id_nota=5 AND notes.id_nota_dp>0");
        $total10=mysqli_num_rows($result10);
        $total_page10=ceil($total10/$data10);
        $page10=(isset($_GET['page']))?$_GET['page']:1;
        $awal_data10=($data10*$page10)-$data10;
        $report_dp=mysqli_query($conn_back, "SELECT * FROM notes 
            JOIN notes_type ON notes.id_nota=notes_type.id_nota
            JOIN users ON notes.id_user=users.id_user 
            JOIN category_services ON notes.id_layanan=category_services.id_category
            JOIN notes_status ON notes.id_status=notes_status.id_status 
            WHERE notes.id_nota='5' AND notes.id_nota_dp>0 ORDER BY notes.id_nota_dp DESC
            LIMIT $awal_data10, $data10");
        if(isset($_POST['search-nota-dp'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['note']))));
            $report_dp=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN notes_type ON notes.id_nota=notes_type.id_nota
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                WHERE notes.id_nota_dp='$keyword' AND notes.id_nota='5' AND notes.id_nota_dp>0 ORDER BY notes.id_nota_dp DESC
                LIMIT $awal_data10, $data10");}
        if(isset($_POST['search-hp-dp'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['hp']))));
            $report_dp=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN notes_type ON notes.id_nota=notes_type.id_nota
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                JOIN handphone ON notes.id_barang=handphone.id_hp
                WHERE handphone.type='$keyword' OR handphone.seri='$keyword' OR handphone.imei='$keyword' AND notes.id_nota='5' AND notes.id_nota_dp>0 ORDER BY notes.id_nota_dp DESC
                LIMIT $awal_data10, $data10");}
        if(isset($_POST['search-laptop-dp'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['laptop']))));
            $report_dp=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN notes_type ON notes.id_nota=notes_type.id_nota
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                JOIN laptop ON notes.id_barang=laptop.id_laptop
                WHERE laptop.merek='$keyword' OR laptop.seri='$keyword' AND notes.id_nota='5' AND notes.id_nota_dp>0 ORDER BY notes.id_nota_dp DESC
                LIMIT $awal_data10, $data10");}
        if(isset($_POST['search-date-dp'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['tgl']))));
            $report_dp=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN notes_type ON notes.id_nota=notes_type.id_nota
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                WHERE notes.tgl_cari='$keyword' AND notes.id_nota='5' AND notes.id_nota_dp>0 ORDER BY notes.id_nota_dp DESC
                LIMIT $awal_data10, $data10");}
        if(isset($_POST['search-date-dp'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['tgl']))));
            $report_dp=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN notes_type ON notes.id_nota=notes_type.id_nota
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                WHERE notes.tgl_cari='$keyword' AND notes.id_nota='5' AND notes.id_nota_dp>0 ORDER BY notes.id_nota_dp DESC
                LIMIT $awal_data10, $data10");}
        // ==> Report Days
        $data11=25;
        $result11=mysqli_query($conn_back, "SELECT * FROM notes WHERE notes.id_nota=5");
        $total11=mysqli_num_rows($result11);
        $total_page11=ceil($total11/$data11);
        $page11=(isset($_GET['page']))?$_GET['page']:1;
        $awal_data11=($data11*$page11)-$data11;
        $report_days=mysqli_query($conn_back, "SELECT * FROM notes 
            JOIN notes_type ON notes.id_nota=notes_type.id_nota
            JOIN users ON notes.id_user=users.id_user 
            JOIN category_services ON notes.id_layanan=category_services.id_category
            JOIN notes_status ON notes.id_status=notes_status.id_status 
            WHERE notes.id_nota=5 ORDER BY notes.id_data DESC
            LIMIT $awal_data11, $data11
        ");
        $selectTech=mysqli_query($conn_back, "SELECT * FROM users WHERE id_role='4' AND is_active='1'");
        if(isset($_POST['search-nota-report'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['note']))));
            $report_days=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN notes_type ON notes.id_nota=notes_type.id_nota
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                WHERE notes.id_nota_tinggal='$keyword' OR notes.id_nota_dp='$keyword' OR notes.id_nota_lunas='$keyword' AND notes.id_nota='5' ORDER BY notes.id_data DESC
                LIMIT $awal_data11, $data11");}
        if(isset($_POST['search-hp-report'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['hp']))));
            $report_days=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN notes_type ON notes.id_nota=notes_type.id_nota
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                JOIN handphone ON notes.id_barang=handphone.id_hp
                WHERE handphone.type='$keyword' OR handphone.seri='$keyword' OR handphone.imei='$keyword' AND notes.id_nota='5' ORDER BY notes.id_data DESC
                LIMIT $awal_data11, $data11");}
        if(isset($_POST['search-laptop-report'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['laptop']))));
            $report_days=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN notes_type ON notes.id_nota=notes_type.id_nota
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                JOIN laptop ON notes.id_barang=laptop.id_laptop
                WHERE laptop.merek='$keyword' OR laptop.seri='$keyword' AND notes.id_nota='5' ORDER BY notes.id_data DESC
                LIMIT $awal_data11, $data11");}
        if(isset($_POST['search-date-report'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['tgl']))));
            $report_days=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN notes_type ON notes.id_nota=notes_type.id_nota
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                WHERE notes.tgl_cari='$keyword' AND notes.id_nota='5' ORDER BY notes.id_data DESC
                LIMIT $awal_data11, $data11");}
        if(isset($_POST['search-month-report'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['bulan']))));
            $report_days=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN notes_type ON notes.id_nota=notes_type.id_nota
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                WHERE date_format(notes.tgl_cari, '%Y-%m')='$keyword' AND notes.id_nota='5' ORDER BY notes.id_data DESC
                LIMIT $awal_data11, $data11");}
        if(isset($_POST['search-tech-report'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['id-teknisi']))));
            $report_days=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN notes_type ON notes.id_nota=notes_type.id_nota
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                WHERE notes.id_pegawai='$keyword' AND notes.id_nota='5' ORDER BY notes.id_data DESC
                LIMIT $awal_data11, $data11");}
        $data12=25;
        $result12=mysqli_query($conn_back, "SELECT * FROM laporan_pengeluaran");
        $total12=mysqli_num_rows($result12);
        $total_page12=ceil($total12/$data12);
        $page12=(isset($_GET['page']))?$_GET['page']:1;
        $awal_data12=($data12*$page12)-$data12;
        $report_expense=mysqli_query($conn_back, "SELECT * FROM laporan_pengeluaran ORDER BY id_pengeluaran DESC LIMIT $awal_data12, $data12");
        if(isset($_POST['submit-expense'])){
            if(report_expense($_POST)>0){
                $_SESSION['message-success']="Berhasil memasukan pengeluaran";
                $_SESSION['time-message']=time();
                header("Location: report-expense");exit;}}
        if(isset($_POST['edit-expense'])){
            if(edit_report_expense($_POST)>0){
                $_SESSION['message-success']="Berhasil mengedit pengeluaran";
                $_SESSION['time-message']=time();
                header("Location: report-expense");exit;}}
        if(isset($_POST['delete-expense'])){
            if(delete_report_expense($_POST)>0){
                $_SESSION['message-success']="Berhasil menghapus pengeluaran";
                $_SESSION['time-message']=time();
                header("Location: report-expense");exit;}}
        if(isset($_POST['search-expense'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['expense']))));
            $report_expense=mysqli_query($conn_back, "SELECT * FROM laporan_pengeluaran WHERE jenis_pengeluaran='$keyword' OR ket='$keyword' ORDER BY id_pengeluaran DESC LIMIT $awal_data12, $data12");}
        if(isset($_POST['search-date-expense'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['date']))));
            $report_expense=mysqli_query($conn_back, "SELECT * FROM laporan_pengeluaran WHERE tgl_cari='$keyword' ORDER BY id_pengeluaran DESC LIMIT $awal_data12, $data12");}
        // ==> Report Spareparts
        $supplier=mysqli_query($conn_back, "SELECT * FROM supplier");
        if(isset($_POST['submit-sparepart'])){
            if(report_sparepart($_POST)>0){
                $_SESSION['message-success']="Berhasil memasukan sparepart";
                $_SESSION['time-message']=time();
                header("Location: report-spareparts");exit;}}
        $data13=25;
        $result13=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts");
        $total13=mysqli_num_rows($result13);
        $total_page13=ceil($total13/$data13);
        $page13=(isset($_GET['page']))?$_GET['page']:1;
        $awal_data13=($data13*$page13)-$data13;
        $reportSpareparts=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts JOIN status_spareparts ON laporan_spareparts.status_sparepart=status_spareparts.id_status  ORDER BY laporan_spareparts.id_sparepart DESC LIMIT $awal_data13, $data13");
        if(isset($_POST['remake-qrcode'])){
            if(remake_qrcode($_POST)>0){
                $_SESSION['message-success']="Berhasil membuat ulang qrcode sparepart";
                $_SESSION['time-message']=time();
                header("Location: report-spareparts");exit;}}
        if(isset($_POST['edit-sparepart'])){
            if(editSparepart($_POST)>0){
                $_SESSION['message-success']="Berhasil mengedit sparepart";
                $_SESSION['time-message']=time();
                header("Location: report-spareparts");exit;}}
        if(isset($_POST['delete-sparepart'])){
            if(deleteSparepart($_POST)>0){
                $_SESSION['message-success']="Berhasil menghapus sparepart";
                $_SESSION['time-message']=time();
                header("Location: report-spareparts");exit;
            }
        }
        $notaSparepart=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_nota<=3 ORDER BY id_data DESC");
        if(isset($_POST['sparepartTerpakai'])){
            if(sparepartTerpakai($_POST)>0){
                $_SESSION['message-success']="Berhasil mengubah status sparepart menjadi terpakai.";
                $_SESSION['time-message']=time();
                header("Location: report-spareparts");exit;}}
        if(isset($_POST['sparepartBatal'])){
            if(sparepartBatal($_POST)>0){
                $_SESSION['message-success']="Berhasil mengubah status sparepart menjadi batal.";
                $_SESSION['time-message']=time();
                header("Location: report-spareparts");exit;}}
        if(isset($_POST['sparepartDipakai'])){
            if(sparepartDipakai($_POST)>0){
                $_SESSION['message-success']="Berhasil mengubah status sparepart menjadi dipakai.";
                $_SESSION['time-message']=time();
                header("Location: report-spareparts");exit;}}
        $statusSparepart=mysqli_query($conn_back, "SELECT * FROM status_spareparts WHERE id_status<=3");
        if(isset($_POST['stok-sparepart'])){
            $reportSpareparts=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts JOIN status_spareparts ON laporan_spareparts.status_sparepart=status_spareparts.id_status WHERE laporan_spareparts.status_sparepart=1 ORDER BY laporan_spareparts.id_sparepart DESC LIMIT $awal_data13, $data13");}
        if(isset($_POST['pakai-sparepart'])){
            $reportSpareparts=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts JOIN status_spareparts ON laporan_spareparts.status_sparepart=status_spareparts.id_status WHERE laporan_spareparts.status_sparepart=2 ORDER BY laporan_spareparts.id_sparepart DESC LIMIT $awal_data13, $data13");}
        if(isset($_POST['search-status-sparepart'])){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['id-status']))));
            $reportSpareparts=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts JOIN status_spareparts ON laporan_spareparts.status_sparepart=status_spareparts.id_status WHERE laporan_spareparts.status_sparepart='$keyword' ORDER BY laporan_spareparts.id_sparepart DESC LIMIT $awal_data13, $data13");}
        if(isset($_POST['search-sparepart'])){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['sparepart']))));
            $reportSpareparts=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts JOIN status_spareparts ON laporan_spareparts.status_sparepart=status_spareparts.id_status WHERE laporan_spareparts.ket='$keyword' OR laporan_spareparts.suplayer='$keyword' ORDER BY laporan_spareparts.id_sparepart DESC LIMIT $awal_data13, $data13");}
        if(isset($_POST['search-date-sparepart'])){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['date']))));
            $reportSpareparts=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts JOIN status_spareparts ON laporan_spareparts.status_sparepart=status_spareparts.id_status WHERE laporan_spareparts.tgl_beli='$keyword' ORDER BY laporan_spareparts.id_sparepart DESC LIMIT $awal_data13, $data13");}
        if(isset($_POST['search-dateLn-sparepart'])){
            $keyword1=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['date1']))));
            $keyword2=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['date2']))));
            $reportSpareparts=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts JOIN status_spareparts ON laporan_spareparts.status_sparepart=status_spareparts.id_status WHERE laporan_spareparts.tgl_beli BETWEEN '$keyword1' AND '$keyword2' ORDER BY laporan_spareparts.id_sparepart DESC LIMIT $awal_data13, $data13");}
        if(isset($_POST['search-temonth-sparepart'])){
            $keyword1=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['id-pegawai']))));
            $keyword2=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['month']))));
            $reportSpareparts=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts JOIN status_spareparts ON laporan_spareparts.status_sparepart=status_spareparts.id_status WHERE laporan_spareparts.id_pegawai='$keyword1' AND date_format(laporan_spareparts.tgl_beli, '%Y-%m')='$keyword2' ORDER BY laporan_spareparts.id_sparepart DESC LIMIT $awal_data13, $data13");}
    }
    // => Technician
    if($_SESSION['id-role']<=4){
        // ==> Repair Reviews
        $news_reviews=mysqli_query($conn_back, "SELECT * FROM notes 
        JOIN notes_type ON notes.id_nota=notes_type.id_nota 
        JOIN users ON notes.id_user=users.id_user 
        JOIN category_services ON notes.id_layanan=category_services.id_category 
        JOIN notes_status ON notes.id_status=notes_status.id_status 
        WHERE tgl_cari='$today' ORDER BY id_data DESC");
        // ==> Nota Tinggal or DP
        $data7=25;
        $result7=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_nota='1' OR id_nota='2'");
        $total7=mysqli_num_rows($result7);
        $total_page7=ceil($total7/$data7);
        $page7=(isset($_GET['page']))?$_GET['page']:1;
        $awal_data7=($data7*$page7)-$data7;
        $notes_views_all=mysqli_query($conn_back, "SELECT * FROM notes 
            JOIN users ON notes.id_user=users.id_user 
            JOIN category_services ON notes.id_layanan=category_services.id_category
            JOIN notes_status ON notes.id_status=notes_status.id_status 
            WHERE notes.id_nota='1' OR notes.id_nota='2' ORDER BY notes.id_nota_tinggal DESC
            LIMIT $awal_data7, $data7");
        if(isset($_POST['search-nota-tinggal'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['note']))));
            $notes_views_all=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                WHERE notes.id_nota_tinggal='$keyword' OR notes.id_nota_dp='$keyword' AND notes.id_nota='1' OR notes.id_nota='2' ORDER BY notes.id_nota_tinggal DESC
                LIMIT $awal_data7, $data7");}
        if(isset($_POST['search-hp-tinggal'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['hp']))));
            $notes_views_all=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                JOIN handphone ON notes.id_barang=handphone.id_hp
                WHERE handphone.type='$keyword' OR handphone.seri='$keyword' OR handphone.imei='$keyword' AND notes.id_nota='1' OR notes.id_nota='2' ORDER BY notes.id_nota_tinggal DESC
                LIMIT $awal_data7, $data7");}
        if(isset($_POST['search-laptop-tinggal'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['laptop']))));
            $notes_views_all=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                JOIN laptop ON notes.id_barang=laptop.id_laptop
                WHERE laptop.merek='$keyword' OR laptop.seri='$keyword' AND notes.id_nota='1' OR notes.id_nota='2' ORDER BY notes.id_nota_tinggal DESC
                LIMIT $awal_data7, $data7");}
        if(isset($_POST['search-date-tinggal'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['tgl']))));
            $notes_views_all=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                WHERE notes.tgl_cari='$keyword' AND notes.id_nota='1' OR notes.id_nota='2' ORDER BY notes.id_nota_tinggal DESC
                LIMIT $awal_data7, $data7");
        }
        // ==> Nota Lunas
        $data8=25;
        $result8=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_nota='3'");
        $total8=mysqli_num_rows($result8);
        $total_page8=ceil($total8/$data8);
        $page8=(isset($_GET['page']))?$_GET['page']:1;
        $awal_data8=($data8*$page8)-$data8;
        $notes_lunas_views_all=mysqli_query($conn_back, "SELECT * FROM notes 
            JOIN users ON notes.id_user=users.id_user 
            JOIN category_services ON notes.id_layanan=category_services.id_category
            JOIN notes_status ON notes.id_status=notes_status.id_status 
            WHERE notes.id_nota='3' ORDER BY notes.id_data DESC
            LIMIT $awal_data8, $data8");
        if(isset($_POST['search-nota-lunas'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['note']))));
            $notes_lunas_views_all=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                WHERE notes.id_nota_lunas='$keyword' AND notes.id_nota='3' ORDER BY notes.id_nota_lunas DESC
                LIMIT $awal_data8, $data8");}
        if(isset($_POST['search-hp-lunas'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['hp']))));
            $notes_lunas_views_all=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                JOIN handphone ON notes.id_barang=handphone.id_hp
                WHERE handphone.type='$keyword' OR handphone.seri='$keyword' OR handphone.imei='$keyword' AND notes.id_nota='3' ORDER BY notes.id_nota_lunas DESC
                LIMIT $awal_data8, $data8");}
        if(isset($_POST['search-laptop-lunas'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['laptop']))));
            $notes_lunas_views_all=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                JOIN laptop ON notes.id_barang=laptop.id_laptop
                WHERE laptop.merek='$keyword' OR laptop.seri='$keyword' AND notes.id_nota='3' ORDER BY notes.id_nota_lunas DESC
                LIMIT $awal_data8, $data8");}
        if(isset($_POST['search-date-lunas'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['tgl']))));
            $notes_lunas_views_all=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                WHERE notes.tgl_cari='$keyword' AND notes.id_nota='3' ORDER BY notes.id_nota_lunas DESC
                LIMIT $awal_data8, $data8");}
        // ==> Nota Cancel
        $data9=25;
        $result9=mysqli_query($conn_back, "SELECT * FROM notes WHERE notes.id_nota=4");
        $total9=mysqli_num_rows($result9);
        $total_page9=ceil($total9/$data9);
        $page9=(isset($_GET['page']))?$_GET['page']:1;
        $awal_data9=($data9*$page9)-$data9;
        $notes_cancel=mysqli_query($conn_back, "SELECT * FROM notes 
            JOIN users ON notes.id_user=users.id_user 
            JOIN category_services ON notes.id_layanan=category_services.id_category
            JOIN notes_status ON notes.id_status=notes_status.id_status 
            WHERE notes.id_nota=4 ORDER BY notes.id_data DESC
            LIMIT $awal_data9, $data9");
        if(isset($_POST['search-nota-batal'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['note']))));
            $notes_cancel=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                WHERE notes.id_nota_tinggal='$keyword' OR notes.id_nota_dp='$keyword' OR notes.id_nota_lunas='$keyword' AND notes.id_nota='4' ORDER BY notes.id_data DESC
                LIMIT $awal_data9, $data9");}
        if(isset($_POST['search-hp-batal'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['hp']))));
            $notes_cancel=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                JOIN handphone ON notes.id_barang=handphone.id_hp
                WHERE handphone.type='$keyword' OR handphone.seri='$keyword' OR handphone.imei='$keyword' AND notes.id_nota='4' ORDER BY notes.id_data DESC
                LIMIT $awal_data9, $data9");}
        if(isset($_POST['search-laptop-batal'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['laptop']))));
            $notes_cancel=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                JOIN laptop ON notes.id_barang=laptop.id_laptop
                WHERE laptop.merek='$keyword' OR laptop.seri='$keyword' AND notes.id_nota='4' ORDER BY notes.id_data DESC
                LIMIT $awal_data9, $data9");}
        if(isset($_POST['search-date-batal'])!=""){
            $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['tgl']))));
            $notes_cancel=mysqli_query($conn_back, "SELECT * FROM notes 
                JOIN users ON notes.id_user=users.id_user 
                JOIN category_services ON notes.id_layanan=category_services.id_category
                JOIN notes_status ON notes.id_status=notes_status.id_status 
                WHERE notes.tgl_cari='$keyword' AND notes.id_nota='4' ORDER BY notes.id_data DESC
                LIMIT $awal_data9, $data9");}
    }
    // => Web Dev/Des
    if($_SESSION['id-role']<=5){}
    // => Web Client Services
    if($_SESSION['id-role']<=6){
        $user_views_profile=mysqli_query($conn_back, "SELECT * FROM users WHERE id_user='$id_user'");
        $userIcon=mysqli_query($conn_back, "SELECT * FROM users WHERE id_user=$id_user");
        $myProfile=mysqli_query($conn_back, "SELECT * FROM users JOIN users_role ON users.id_role=users_role.id_role WHERE users.id_user='$id_user'");
        if(isset($_POST['edit-profile-employee'])){
            if(photo_profile($_POST)>0){
                $_SESSION['message-success']="Foto profile kamu berhasil diubah.";
                $_SESSION['time-message']=time();
                header("Location: profile");exit;
            }
        }
        if(isset($_POST['edit-email-user'])){
            if(email_profile($_POST)>0){
                $_SESSION['message-success']="Email kamu berhasil diubah.";
                $_SESSION['time-message']=time();
                header("Location: ../Auth/logout");exit;
            }
        }
        if(isset($_POST['edit-biodata-user'])){
            if(biodata_profile($_POST)>0){
                $_SESSION['message-success']="Biodata kamu berhasil diubah.";
                $_SESSION['time-message']=time();
                header("Location: profile");exit;
            }
        }
        $activity=mysqli_query($conn_back, "SELECT * FROM users_log WHERE id_log='$id_log' ORDER BY id DESC");
        $countActivity=mysqli_num_rows($activity);
        $settings=mysqli_query($conn_back, "SELECT * FROM users WHERE id_user='$id_user'");
        if(isset($_POST['ubah-sandi-user'])){
            if(password_profile($_POST)>0){
                header("Location: ../Auth/logout");exit;
            }
        }
        $help_message=mysqli_query($conn_back, "SELECT * FROM users_help WHERE id_user='$id_user' ORDER BY id_help DESC");
        if(isset($_POST['submit-help'])){
            if(help_message($_POST)>0){
                $_SESSION['message-success']="Pesan bantuan kamu berhasil dikirim.";
                $_SESSION['time-message']=time();
                header("Location: help");exit;
            }
        }
        $report_problem=mysqli_query($conn_back, "SELECT * FROM report_problem");
        $runTextNotes=mysqli_query($conn_back, "SELECT * FROM notes WHERE tgl_cari='$today'");
        $runTextSpareparts=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE status_sparepart=1");
    }
    // => Users
    if($_SESSION['id-role']<=7){
        
    }
}