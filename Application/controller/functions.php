<?php 
if(!isset($_SESSION['id-user'])&&!isset($_SESSION['id-role'])){
    // => Front End
        function kontak($data){global $conn_back;
            $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['name']))));
            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['email']))));
            $pesan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['pesan']))));
            require "mail-send.php";
            $to       = 'ugdhpmediatalk@ugdhp.com';
            $subject  = 'Pesan dari pengunjung '.$name;
            $message  = '
                <div style="margin: 0; padding: 0;">
                    <h4>Pesan ini dikirim oleh pengunjung melalui fitur kontak situs.</h4>
                    <p>'.$email.' kirim pesan berikut: <br>"'.$pesan.'"</p>
                    <p>Jika anda telah membaca pesan ini segera balas pesan melalui email yang tertera.</p>
                    <br><br><br>
                    <p>Salam Hormat,</p>
                    <p>UGD HP</p>
                    <p>Account Comunication</p>
                    <br><br>
                    <p>Area Kerja</p>
                    <p>Jl. W.J Lalamentik No.95 (UGD HP), Kota Kupang, NTT, Indonesia</p>
                    <p>Email: ugdhpmediatalk@ugdhp.com</p>
                </div>
            ';
            smtp_mail($to, $subject, $message, '', '', 0, 0, true);
            return mysqli_affected_rows($conn_back);}
        function saran($data){global $conn_front;
            $id_role=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_front, $data['id-role']))));
            $saran=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_front, $data['saran']))));
            mysqli_query($conn_front, "INSERT INTO saran(id_role,saran) VALUES('$id_role','$saran')");
            return mysqli_affected_rows($conn_front);}
        function daftar($data){global $conn_back;
            $first_name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['first-name']))));
            $last_name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['last-name']))));
            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['email']))));
            $pass=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['password']))));
            $checkLog=mysqli_query($conn_back, "SELECT * FROM users ORDER BY id_log DESC LIMIT 1");
            if(mysqli_num_rows($checkLog)>0){
                $rowLog=mysqli_fetch_assoc($checkLog);
                $id_log=$rowLog['id_log']+1;
            }else if(mysqli_num_rows($checkLog)==0){
                $id_log=1;
            }
            $check_lenght_pass=strlen($pass);
            if($check_lenght_pass<8){
                $_SESSION['message-danger']="Maaf, kata sandi Anda terlalu pendek (Min: 8)!";
                $_SESSION['time-message']=time();
                header("Location: daftar");return false;
            }
            $date_created=date("l, d M Y");
            $check_users=mysqli_query($conn_back, "SELECT * FROM users WHERE email='$email'");
            if(mysqli_num_rows($check_users)>0){
                $_SESSION['message-danger']="Maaf, akun yang Anda daftarkan sudah ada!";
                $_SESSION['time-message']=time();
                header("Location: daftar");return false;
            }
            $encrypt_email=password_hash($email, PASSWORD_DEFAULT);
            $data_encrypt=crc32($email);
            $password=password_hash($pass, PASSWORD_DEFAULT);
            require "mail-send.php";
            $to       = $email;
            $subject  = 'Verifikasi Akun UGD HP';
            $message  = '
                <div style="margin: 0; padding: 0;">
                    <p>Selamat kamu sudah terdaftar di UGD HP tempat kamu bisa memperbaiki HP dan laptop serta jasa pembuatan website. Silakan klik tautan di bawah ini untuk memverifikasi akun Anda:</p><br>
                    <a href="https://www.ugdhp.com/Auth/verifikasi?auth='.$encrypt_email.'&crypt='.$data_encrypt.'" style="font-weight: bold">'.$encrypt_email.'</a>
                    <p>Kode ini bersifat rahasia, jangan berikan kepada siapa pun. Baca juga kebijakan persyaratan layanan kami di
                        <a href="https://www.ugdhp.com/terms-conditions" style="text-decoration: none;">sini.</a>
                    </p><br><br>
                    <p>Salam Hormat,</p>
                    <p>UGD HP</p>
                    <p>Account Comunication</p>
                    <br><br>
                    <p>Area Kerja</p>
                    <p>Jl. W.J Lalamentik No.95 (UGD HP), Kota Kupang, NTT, Indonesia</p>
                    <p>Email: ugdhpmediatalk@ugdhp.com</p>
                </div>
            ';
            smtp_mail($to, $subject, $message, '', '', 0, 0, true);
            mysqli_query($conn_back, "INSERT INTO users(data_encrypt,first_name,last_name,email,password,id_log,date_created) VALUES('$data_encrypt','$first_name','$last_name','$email','$password','$id_log','$date_created')");
            return mysqli_affected_rows($conn_back);}
        function masuk($data){global $conn_back;
            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['email']))));
            $password=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['password']))));
            $users=mysqli_query($conn_back, "SELECT * FROM users WHERE email='$email'");
            if(mysqli_num_rows($users)>0){
                while($row=mysqli_fetch_assoc($users)){
                    $pass=$row['password'];
                    if(password_verify($password, $pass)){
                        if(isset($_SESSION['auth'])){unset($_SESSION['auth']);}
                        $_SESSION['id-user']=$row['id_user'];
                        $_SESSION['id-log']=$row['id_log'];
                        $_SESSION['is-active']=$row['is_active'];
                        $_SESSION['id-access']=$row['id_access'];
                        $_SESSION['id-category']=$row['id_category'];
                        $_SESSION['id-role']=$row['id_role'];
                        $_SESSION['username']=$row['first_name'];
                        $_SESSION['id-tools']=$row['id_tools'];
                        $_SESSION['id-ui']=$row['id_ui'];
                        $_SESSION['id-keyConsole']=$row['id_keyConsole'];
                        if(isset($data['remember-me'])||!empty($data['remember-me'])){
                            setcookie('mobileAR',$row['id_user'],time());
                            setcookie('keyAR',hash('sha256', $row['email']),time());
                        }
                    }else{
                        $_SESSION['message-danger']="Maaf, kata sandi yang Anda masukkan salah, silakan coba lagi.";
                        $_SESSION['time-message']=time();
                        header("Location: masuk");return false;
                    }
                }
            }else if(mysqli_num_rows($users)==0){
                $_SESSION['message-danger']="Maaf akun Anda belum terdaftar! silahkan daftar dulu.";
                $_SESSION['time-message']=time();
                header("Location: masuk");return false;
            }
            return mysqli_affected_rows($conn_back);}
        function forgot_password($data){global $conn_back;
            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['email']))));
            $check_users=mysqli_query($conn_back, "SELECT * FROM users WHERE email='$email'");
            if(mysqli_num_rows($check_users)==0){
                $_SESSION['message-danger']="Maaf akun Anda belum terdaftar! silahkan daftar dulu.";
                $_SESSION['time-message']=time();
                header("Location: lupa-sandi");return false;
            }else if(mysqli_num_rows($check_users)>0){
                $_SESSION['email']=$email;
                return mysqli_affected_rows($conn_back);}}
        function new_password($data){global $conn_back;
            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['email']))));
            $pass1=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['password1']))));
            $pass2=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['password1']))));
            if($pass1!=$pass2){
                $_SESSION['message-danger']="Password yang anda masukan tidak sama.";
                $_SESSION['time-message']=time();
                header("Location: sandi-baru");return false;
            }
            $check_lenght_pass=strlen($pass1);
            if($check_lenght_pass<8){
                $_SESSION['message-danger']="Maaf, kata sandi Anda terlalu pendek (Min: 8)!";
                $_SESSION['time-message']=time();
                header("Location: sandi-baru");return false;
            }
            $check_users=mysqli_query($conn_back, "SELECT * FROM users WHERE email='$email'");
            $row=mysqli_fetch_assoc($check_users);
            $password_hash=$row['password'];
            if(password_verify($pass1, $password_hash)){
                $_SESSION['message-danger']="Maaf, kata sandi Anda masih sama dengan yang lama, kami sarankan Anda hanya menggunakan kata sandi yang Anda ingat atau kata sandi lama anda.";
                header("Location: sandi-baru");return false;
            }else{
                $password=password_hash($pass1, PASSWORD_DEFAULT);
                mysqli_query($conn_back, "UPDATE users SET password='$password' WHERE email='$email'");
                return mysqli_affected_rows($conn_back);}}
        // function __($data){global $conn_front,$conn_back;}
}
if(isset($_SESSION['id-user'])&&isset($_SESSION['id-role'])){
    $date=date('l, d M Y'); $date_search=date('Y-m-d'); $datetime=time();
    $link_qr="https://www.ugdhp.com/qr?authQR=";
    $link_qrs="https://www.ugdhp.com/qrs?authQR=";
    if($_SESSION['id-role']<=2){
        function help_answer_message($data){global $conn_back;
            $id_help=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-help']))));
            $answer=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['answer']))));
            mysqli_query($conn_back, "UPDATE users_help SET answer='$answer' WHERE id_help='$id_help'");
            return mysqli_affected_rows($conn_back);}
        function menu($data){global $conn_back,$time,$date;
            $menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['menu']))));
            $check_menu=mysqli_query($conn_back, "SELECT * FROM menu WHERE menu LIKE '%$menu%'");
            if(mysqli_num_rows($check_menu)>0){
                $id_log=$_SESSION['id-log'];
                $log="Kesalahan Menu! Menu yang dimasukan sudah ada.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Menu yang kamu masukan sudah ada, silakan masukan nama menu yang lain.";
                header("Location: menu");return false;
            }
            mysqli_query($conn_back, "INSERT INTO menu(menu) VALUES('$menu')");
            return mysqli_affected_rows($conn_back);}
        function edit_menu($data){global $conn_back,$time,$date;
            $id_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-menu']))));
            $menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['menu']))));
            $check_menu=mysqli_query($conn_back, "SELECT * FROM menu WHERE menu='$menu'");
            if(mysqli_num_rows($check_menu)>0){
                $id_log=$_SESSION['id-log'];
                $log="Kesalahan Edit Menu! Menu yang dimasukan sudah ada.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Menu yang kamu masukan sudah ada, silakan masukan nama menu yang lain.";
                header("Location: menu");return false;
            }else if(mysqli_num_rows($check_menu)==0){
                mysqli_query($conn_back, "UPDATE menu SET menu='$menu' WHERE id_menu='$id_menu'");
                return mysqli_affected_rows($conn_back);}}
        function delete_menu($data){global $conn_back;
            $id_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-menu']))));
            mysqli_query($conn_back, "DELETE FROM menu WHERE id_menu='$id_menu'");
            return mysqli_affected_rows($conn_back);}
        function sub_menu($data){global $conn_back,$time,$date;
            $id_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-menu']))));
            $title=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['title']))));
            $check_title=mysqli_query($conn_back, "SELECT * FROM menu_sub WHERE title LIKE '%$title%'");
            if(mysqli_num_rows($check_title)>0){
                $id_log=$_SESSION['id-log'];
                $log="Kesalahan Edit Menu! Sub Menu yang dimasukan sudah ada.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Sub Menu yang kamu masukan sudah ada, silakan masukan nama sub menu yang lain.";
                header("Location: sub-menu");return false;
            }
            $url=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['url']))));
            $icon=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['icon']))));
            $is_active=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['is-active']))));
            mysqli_query($conn_back, "INSERT INTO menu_sub(id_menu,title,url,icon,is_active) VALUES('$id_menu','$title','$url','$icon','$is_active')");
            return mysqli_affected_rows($conn_back);}
        function edit_sub_menu($data){global $conn_back;
            $id_sub_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-sub-menu']))));
            $id_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-menu']))));
            $title=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['title']))));
            $url=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['url']))));
            $icon=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['icon']))));
            $is_active=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['is-active']))));
            mysqli_query($conn_back, "UPDATE menu_sub SET id_menu='$id_menu', title='$title', url='$url', icon='$icon', is_active='$is_active' WHERE id_sub_menu='$id_sub_menu'");
            return mysqli_affected_rows($conn_back);}
        function delete_sub_menu($data){global $conn_back;
            $id_sub_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-sub-menu']))));
            mysqli_query($conn_back, "DELETE FROM menu_sub WHERE id_sub_menu='$id_sub_menu'");
            return mysqli_affected_rows($conn_back);}
        function access_menu($data){global $conn_back;
            $id_role=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-role']))));
            $id_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-menu']))));
            mysqli_query($conn_back, "INSERT INTO menu_access(role_id,id_menu) VALUES('$id_role','$id_menu')");
            return mysqli_affected_rows($conn_back);}
        function delete_access_menu($data){global $conn_back;
            $id_access_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-access-menu']))));
            mysqli_query($conn_back, "DELETE FROM menu_access WHERE id_access_menu='$id_access_menu'");
            return mysqli_affected_rows($conn_back);}
        function access_sub_menu($data){global $conn_back;
            $id_role=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-role']))));
            $id_sub_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-sub-menu']))));
            mysqli_query($conn_back, "INSERT INTO menu_sub_access(role_id,id_sub_menu) VALUES('$id_role','$id_sub_menu')");
            return mysqli_affected_rows($conn_back);}
        function delete_access_sub_menu($data){global $conn_back;
            $id_access_sub_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-access-sub-menu']))));
            mysqli_query($conn_back, "DELETE FROM menu_sub_access WHERE id_access_sub_menu='$id_access_sub_menu'");
            return mysqli_affected_rows($conn_back);}
        function privacy_policy($data){global $conn_front;
            $privacy_policy=$data['privacy-policy'];
            mysqli_query($conn_front, "INSERT INTO privacy_policy(privacy_policy) VALUES('$privacy_policy')");
            return mysqli_affected_rows($conn_front);}
        function edit_privacy_policy($data){global $conn_front;
            $id_pp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_front, $data['id-pp']))));
            $privacy_policy=$data['privacy-policy'];
            mysqli_query($conn_front, "UPDATE privacy_policy SET privacy_policy='$privacy_policy' WHERE id_pp='$id_pp'");
            return mysqli_affected_rows($conn_front);}
        function delete_privacy_policy($data){global $conn_front;
            $id_pp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_front, $data['id-pp']))));
            mysqli_query($conn_front, "DELETE FROM privacy_policy WHERE id_pp='$id_pp'");
            return mysqli_affected_rows($conn_front);}
        function term_of_service($edit){global $conn_front;
            $term_of_service=$edit['term-of-service'];
            mysqli_query($conn_front, "INSERT INTO terms_conditions(terms_conditions) VALUES('$term_of_service')");
            return mysqli_affected_rows($conn_front);}
        function edit_term_of_service($data){global $conn_front;
            $id_term=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_front, $data['id-term']))));
            $term_of_service=$data['term-of-service'];
            mysqli_query($conn_front, "UPDATE terms_conditions SET terms_conditions='$term_of_service' WHERE id_term='$id_term'");
            return mysqli_affected_rows($conn_front);}
        function delete_term_of_service($data){global $conn_front;
            $id_term=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_front, $data['id-term']))));
            mysqli_query($conn_front, "DELETE FROM terms_conditions WHERE id_term='$id_term'");
            return mysqli_affected_rows($conn_front);}
        function users_edit($data){global $conn_back;
            $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-user']))));
            $id_role=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-role']))));
            $is_active=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['is-active']))));
            $id_access=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-access']))));
            $id_tools=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-tools']))));
            $id_category=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-category']))));
            $id_keyConsole=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-keyConsole']))));
            mysqli_query($conn_back, "UPDATE users SET id_role='$id_role', is_active='$is_active', id_access='$id_access', id_tools='$id_tools', id_category='$id_category', id_keyConsole='$id_keyConsole' WHERE id_user='$id_user'");
            return mysqli_affected_rows($conn_back);}
        function delete_users($data){global $conn_back;
            $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-user']))));
            mysqli_query($conn_back, "DELETE FROM users WHERE id_user='$id_user'");
            return mysqli_affected_rows($conn_back);}
        function cal_days($data){global $conn,$time,$date;
            $income=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['income']))));
            $expense=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['expense']))));
            $total=$income-$expense;
            $tgl_cari=$data['tgl-cari'];
            $id_log=$_SESSION['id-log'];
            $log="Melaporkan kalkulasi harian pada tanggal ";
            mysqli_query($conn, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
            mysqli_query($conn, "INSERT INTO cal_days(income,expense,total,date,tgl_cari,time) VALUES('$income','$expense','$total','$tgl_cari','$tgl_cari','$time')");
            return mysqli_affected_rows($conn);
        }
        // function __($data){global $conn_front,$conn_back;}
    }
    if($_SESSION['id-role']<=3){
        function report_problem($data){global $conn_back,$date;
            $problem_message=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['problem-message']))));
            $tgl_cari=date('Y-m-d');
            mysqli_query($conn_back, "INSERT INTO report_problem(problem_message,date,tgl_cari) VALUES('$problem_message','$date','$tgl_cari')");
            return mysqli_affected_rows($conn_back);}
        function notes_type($data){global $conn_back,$time,$date;
            $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['name']))));
            $check_name=mysqli_query($conn_back, "SELECT * FROM notes_type WHERE name LIKE '%$name%'");
            if(mysqli_num_rows($check_name)>0){
                $id_log=$_SESSION['id-log'];
                $log="Kesalahan Input Seting Nota! Nama nota yang dimasukan sudah ada.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Nama nota yang kamu masukan sudah ada, silakan masukan nama nota yang lain.";
                header("Location: setting-nota");return false;
            }
            $no_nota=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['no-nota']))));
            $kombinasi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['kombinasi']))));
            mysqli_query($conn_back, "INSERT INTO notes_type(name,no_nota,kombinasi,date) VALUES('$name','$no_nota','$kombinasi','$date')");
            return mysqli_affected_rows($conn_back);}
        function edit_notes_type($data){global $conn_back;
            $id_nota=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-nota']))));
            $no_nota=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['no-nota']))));
            $kombinasi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['kombinasi']))));
            mysqli_query($conn_back, "UPDATE notes_type SET no_nota='$no_nota', kombinasi='$kombinasi' WHERE id_nota='$id_nota'");
            return mysqli_affected_rows($conn_back);}
        function delete_notes_type($data){global $conn_back;
            $id_nota=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-nota']))));
            mysqli_query($conn_back, "DELETE FROM notes_type WHERE id_nota='$id_nota'");
            return mysqli_affected_rows($conn_back);}
        function notes($data){global $conn_back,$time,$date,$date_search,$id_log;
            // ==> Value from Form
            $nota_tinggal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['nota-tinggal']))));
            $nota_dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['nota-dp']))));
            $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['username']))));
            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['email']))));
            $tlpn=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['tlpn']))));
            $alamat=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['alamat']))));
            $id_layanan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-layanan']))));
            if(empty($id_layanan)){
                $log="Kesalahan Input Nota Tinggal! Belum memilih layanan perbaikan.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Kamu belum memilih layanan perbaikan!";
                header("Location: nota-tinggal"); return false;
            }else if($id_layanan==1){
                $type=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['type']))));
                $seri_hp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['seri-hp']))));
                $imei=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['imei']))));
            }else if($id_layanan==2){
                $merek=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['merek']))));
                $seri_laptop=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['seri-laptop']))));}
            $kerusakan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['kerusakan']))));
            $kondisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['kondisi']))));
            $kelengkapan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['kelengkapan']))));
            $id_teknisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-teknisi']))));
            $tgl_ambil=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['tgl-ambil']))));
            $dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['dp']))));
            $biaya=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['biaya']))));
            // ==> Logic Database
            $check_users=mysqli_query($conn_back, "SELECT * FROM users ORDER BY id_user DESC LIMIT 1");
            if(mysqli_num_rows($check_users)>0){
                $row=mysqli_fetch_assoc($check_users);
                $id_user=$row['id_user']+1;
            }else if(mysqli_num_rows($check_users)==0){
                $id_user=1;}
            $id_barang=$id_user;
            $data_encrypt=crc32($id_user);
            // ==> Jika ada nomor nota tinggal
            if(!empty($nota_tinggal)){
                // ==> Jika nomor urut nota tinggal tidak urut
                $check_urut_nota=mysqli_query($conn_back, "SELECT * FROM notes ORDER BY id_nota_tinggal DESC LIMIT 1");
                if(mysqli_num_rows($check_urut_nota)>0){
                    $row_urut=mysqli_fetch_assoc($check_urut_nota);
                    $id_nota_urut=$row_urut['id_nota_tinggal']+1;
                    if($id_nota_urut!=$nota_tinggal){
                        $log="Kesalahan Input Nota Tinggal! Nomor nota tinggal yang kamu masukan tidak urut, Nota Tinggal akhir saat ini ".$row_urut['id_nota_tinggal'].".";
                        mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $_SESSION['time-message']=time();
                        $_SESSION['message-danger']="Nomor nota tinggal yang kamu masukan tidak urut, Nota Tinggal akhir saat ini ".$row_urut['id_nota_tinggal'].". cek kembali!";
                        header("Location: nota-tinggal"); return false;}}
                // ==> Jika nomor nota tinggal telah mencapai batas maksimum nota fisik yang ada
                $notes_type_tinggal=mysqli_query($conn_back, "SELECT * FROM notes_type WHERE name LIKE '%Nota Tinggal%'");
                $row_notes_type_tinggal=mysqli_fetch_assoc($notes_type_tinggal);
                $no_nota_tinggal=$row_notes_type_tinggal['no_nota'];
                if($nota_tinggal==$no_nota_tinggal || $nota_tinggal>$no_nota_tinggal){
                    $log="Kesalahan Input Nota Tinggal! Nomor nota tinggal yang dimasukan telah mencapai batas maksimum cetak.";
                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                    $_SESSION['time-message']=time();
                    $_SESSION['message-danger']="Nomor nota tinggal saat ini telah mencapai batas maksimum cetak, silakan cetak nota dan jika sudah segera setting ulang nomor nota tinggal!";
                    header("Location: nota-tinggal");return false;}
                // ==> Jika nomor nota tinggal sudah ada
                $check_tinggal=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_nota_tinggal='$nota_tinggal'");
                if(mysqli_num_rows($check_tinggal)>0){
                    $log="Kesalahan Input Nota Tinggal! Nomor nota tinggal yang dimasukan sudah ada dengan nomor ".$nota_tinggal.".";
                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                    $_SESSION['time-message']=time();
                    $_SESSION['message-danger']="Nomor nota tinggal yang kamu masukan sudah ada, cek kembali!";
                    header("Location: nota-tinggal");return false;}}
            if(!empty($data['nota-dp'])){
                // ==> Jika nomor urut nota dp tidak urut
                $check_urut_notaDP=mysqli_query($conn_back, "SELECT * FROM notes ORDER BY id_nota_dp DESC LIMIT 1");
                if(mysqli_num_rows($check_urut_notaDP)>0){
                    $row_urutDP=mysqli_fetch_assoc($check_urut_notaDP);
                    $id_nota_urutDP=$row_urutDP['id_nota_dp']+1;
                    if($id_nota_urutDP!=$nota_dp){
                        $log="Kesalahan Input Nota DP! Nomor nota dp yang kamu masukan tidak urut, Nota DP akhir saat ini ".$row_urutDP['id_nota_dp'].".";
                        mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $_SESSION['time-message']=time();
                        $_SESSION['message-danger']="Nomor nota dp yang kamu masukan tidak urut, Nota DP akhir saat ini ".$row_urutDP['id_nota_dp'].". cek kembali!";
                        header("Location: nota-tinggal"); return false;}}
                // ==> 
                $check_dp=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_nota_dp='$nota_dp'");
                $notes_type_dp=mysqli_query($conn_back, "SELECT * FROM notes_type WHERE name LIKE '%Nota DP%'");
                $row_notes_type_dp=mysqli_fetch_assoc($notes_type_dp);
                $no_nota_dp=$row_notes_type_dp['no_nota'];
                if(mysqli_num_rows($check_dp)>0){
                    if($nota_dp==$no_nota_dp || $nota_dp>$no_nota_dp){
                        $log="Kesalahan Input Nota DP! Nomor nota dp yang dimasukan telah mencapai batas maksimum cetak dengan nomor ".$nota_dp.".";
                        mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $_SESSION['time-message']=time();
                        $_SESSION['message-danger']="Nomor nota dp yang kamu masukan saat ini telah mencapai batas maksimum cetak, silakan cetak nota dan jika sudah segera setting ulang nomor nota dp!";
                        header("Location: nota-tinggal");return false;
                    }else{
                        $log="Kesalahan Input Nota DP! Nomor nota dp yang dimasukan sudah ada dengan nomor ".$nota_dp.".";
                        mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $_SESSION['time-message']=time();
                        $_SESSION['message-danger']="Nomor nota dp yang kamu masukan sudah ada, cek kembali!";
                        header("Location: nota-tinggal");return false;}
                }else if(mysqli_num_rows($check_dp)==0){
                    if($nota_dp==$no_nota_dp || $nota_dp>$no_nota_dp){
                        $log="Kesalahan Input Nota DP! Nomor nota dp yang dimasukan telah mencapai batas maksimum cetak dengan nomor ".$nota_dp.".";
                        mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $_SESSION['time-message']=time();
                        $_SESSION['message-danger']="Nomor nota dp yang kamu masukan saat ini telah mencapai batas maksimum cetak, silakan cetak nota dan jika sudah segera setting ulang nomor nota dp!";
                        header("Location: nota-tinggal");return false;}}
            }else if(empty($data['nota-dp'])){
                $nota_dp=0;}
            $barcode=barcode_notes($data_encrypt);
            if(empty($email)){$email=$nota_tinggal;$password=$nota_tinggal;}
            else if(!empty($email)){
                $checkEmail=mysqli_query($conn_back, "SELECT * FROM users WHERE email='$email'");
                if(mysqli_num_rows($checkEmail)>0){
                    $log="Kesalahan Input Email Nota! Memasukan email nota yang sudah ada dengan email ".$email.".";
                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                    $_SESSION['time-message']=time();
                    $_SESSION['message-danger']="Email yang dimasukan sudah ada!";
                    header("Location: nota-tinggal");return false;}}
            if(!empty($data['nota-garansi'])){
                $id_userGaransi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-user-garansi']))));
                $nota_garansi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['nota-garansi']))));
                $garansi=date('M d, Y h:i:s');
                $dp=0;
                $biaya=0;
                mysqli_query($conn_back, "UPDATE notes SET garansi='$garansi' WHERE id_user='$id_userGaransi'");
            }else if(empty($data['nota-garansi'])){
                $nota_garansi='DP0';
                if(!empty($nota_dp)){
                    if(empty($dp) || $dp==0){
                        $log="Kesalahan Input Nota DP! Nomor nota dp ".$nota_dp." sudah ada tetapi biaya dp belum dimasukan.";
                        mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $_SESSION['time-message']=time();
                        $_SESSION['message-danger']="Kamu belum memasukan uang muka atau DP sementara nomor DP ada, sialakan cek lagi!";
                        header("Location: nota-tinggal");return false;}
                }else if(empty($nota_dp) && $dp>=10000){
                    $log="Kesalahan Input Nota DP! Belum memasukan nomor nota dp sementara dp ada.";
                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                    $_SESSION['time-message']=time();
                    $_SESSION['message-danger']="Kamu belum memasukan nomor nota dp sementara dp sudah, silakan coba lagi!";
                    header("Location: nota-tinggal");return false;}
                if($biaya<=10000){
                    $log="Kesalahan Input Biaya Perbaikan! Memasukan biaya kurang dari Rp. 10.000,00.";
                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                    $_SESSION['time-message']=time();
                    $_SESSION['message-danger']="Pastikan anda memasukan biaya dengan benar (Min: Rp. 10.000,00)!";
                    header("Location: nota-tinggal");return false;}
            }
            mysqli_query($conn_back, "INSERT INTO users(id_user,data_encrypt,first_name,email,password,phone,address,id_log,date_created) VALUES('$id_user','$data_encrypt','$username','$email','$password','$tlpn','$alamat','1','$date')");
            if($id_layanan==1){
                mysqli_query($conn_back, "INSERT INTO handphone(id_hp,type,seri,imei) VALUES('$id_user','$type','$seri_hp','$imei')");
            }else if($id_layanan==2){
                mysqli_query($conn_back, "INSERT INTO laptop(id_laptop,merek,seri) VALUES('$id_user','$merek','$seri_laptop')");}
            mysqli_query($conn_back, "INSERT INTO notes(id_nota_tinggal,id_nota_dp,id_user,id_layanan,id_barang,id_pegawai,tgl_cari,tgl_masuk,tgl_status,tgl_ambil,time,kerusakan,kondisi,kelengkapan,nota_garansi,dp,biaya,barcode) VALUES('$nota_tinggal','$nota_dp','$id_user','$id_layanan','$id_barang','$id_teknisi','$date_search','$date','$date','$tgl_ambil','$time','$kerusakan','$kondisi','$kelengkapan','$nota_garansi','$dp','$biaya','$barcode')");
            return mysqli_affected_rows($conn_back);}
        function barcode_notes($data_encrypt){global $link_qr;
            require_once('../Assets/phpqrcode/qrlib.php');
            $qrvalue = $link_qr.$data_encrypt;
            $tempDir = "../Assets/img/img-qrcode-notes/";
            $codeContents = $qrvalue;
            $fileName = $data_encrypt.".jpg";
            $pngAbsoluteFilePath = $tempDir.$fileName;
            if(!file_exists($pngAbsoluteFilePath)){
                QRcode::png($codeContents, $pngAbsoluteFilePath);}
            return $fileName;}
        function remake_barcode($data){global $conn_back,$link_qr;
            require_once('../Assets/phpqrcode/qrlib.php');
            $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-user']))));
            $barcode_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['barcode-old']))));
            $files=glob("../Assets/img/img-qrcode-notes/".$barcode_old);
            foreach ($files as $file) {
                if (is_file($file))
                unlink($file);
            }
            $data_encrypt=crc32($id_user);
            $qrvalue = $link_qr.$data_encrypt;
            $tempDir = "../Assets/img/img-qrcode-notes/";
            $codeContents = $qrvalue;
            $barcode = $data_encrypt.".png";
            $pngAbsoluteFilePath = $tempDir.$barcode;
            if(!file_exists($pngAbsoluteFilePath)){
                QRcode::png($codeContents, $pngAbsoluteFilePath);
            }
            mysqli_query($conn_back, "UPDATE users SET data_encrypt='$data_encrypt' WHERE id_user='$id_user'");
            mysqli_query($conn_back, "UPDATE notes SET barcode='$barcode' WHERE id_user='$id_user'");
            return mysqli_affected_rows($conn_back);}
        function edit_notesTinggal($data){global $conn_back,$id_log,$date,$time;
            // ==> Value from Form
            $id_data=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-data']))));
            $id_barang=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-barang']))));
            $nota_tinggal_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-nota-tinggal-old']))));
            $nota_dp_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-nota-dp-old']))));
            $nota_tinggal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['nota-tinggal']))));
            $nota_dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['nota-dp']))));
            $id_layanan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-layanan']))));
            if(empty($id_layanan)){
                $log="Kesalahan Ubah Nota Tinggal! Belum memilih layanan perbaikan.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Kamu belum memilih layanan perbaikan!";
                header("Location: nota-tinggal"); return false;
            }else if($id_layanan==1){
                $type=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['type']))));
                $seri_hp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['seri-hp']))));
                $imei=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['imei']))));
            }else if($id_layanan==2){
                $merek=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['merek']))));
                $seri_laptop=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['seri-laptop']))));}
            $kerusakan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['kerusakan']))));
            $kondisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['kondisi']))));
            $kelengkapan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['kelengkapan']))));
            $id_teknisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-teknisi']))));
            $tgl_ambil=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['tgl-ambil']))));
            $dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['dp']))));
            $biaya=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['biaya']))));
            // ==> Cek nota tinggal
            $checkNotaTinggal=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_nota_tinggal='$nota_tinggal'");
            if($nota_tinggal!=$nota_tinggal_old){
                if(mysqli_num_rows($checkNotaTinggal)>0){
                    $log="Kesalahan Ubah Nota Tinggal! Nota Tinggal yang dimasukan sudah ada dengan nomor ".$nota_tinggal.".";
                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                    $_SESSION['time-message']=time();
                    $_SESSION['message-danger']="Nota Tinggal yang kamu masukan sudah ada!";
                    header("Location: nota-tinggal"); return false;}}
            $checkNotaDp=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_nota_dp='$nota_dp'");
            if($nota_dp!=$nota_dp_old){
                if(mysqli_num_rows($checkNotaDp)>0){
                    $log="Kesalahan Ubah Nota Dp! Nota Dp yang dimasukan sudah ada dengan nomor ".$nota_dp.".";
                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                    $_SESSION['time-message']=time();
                    $_SESSION['message-danger']="Nota Dp yang kamu masukan sudah ada!";
                    header("Location: nota-tinggal"); return false;}}
            if(!empty($nota_dp)){
                if(empty($dp) || $dp==0){
                    $log="Kesalahan Ubah Nota DP! Nomor nota dp ".$nota_dp." sudah ada tetapi biaya dp belum dimasukan.";
                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                    $_SESSION['time-message']=time();
                    $_SESSION['message-danger']="Kamu belum memasukan uang muka atau DP sementara nomor DP ada, sialakan cek lagi!";
                    header("Location: nota-tinggal");return false;}
            }else if(empty($nota_dp) && $dp>=10000){
                $log="Kesalahan Input Nota DP! Belum memasukan nomor nota dp sementara dp ada.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Kamu belum memasukan nomor nota dp sementara dp sudah, silakan coba lagi!";
                header("Location: nota-tinggal");return false;}
            if($biaya<=10000){
                $log="Kesalahan Ubah Biaya Perbaikan! Memasukan biaya kurang dari Rp. 10.000,00.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Pastikan anda memasukan biaya dengan benar (Min: Rp. 10.000,00)!";
                header("Location: nota-tinggal");return false;}
            if($id_layanan==1){
                mysqli_query($conn_back, "UPDATE handphone SET type='$type', seri='$seri_hp', imei='$imei' WHERE id_hp='$id_barang'");
            }else if($id_layanan==2){
                mysqli_query($conn_back, "UPDATE laptop SET merek='$merek', seri='$seri_laptop' WHERE id_laptop='$id_barang'");}
            mysqli_query($conn_back, "UPDATE notes SET id_nota_tinggal='$nota_tinggal', id_nota_dp='$nota_dp', kerusakan='$kerusakan', kondisi='$kondisi', kelengkapan='$kelengkapan', id_pegawai='$id_teknisi', tgl_ambil='$tgl_ambil', dp='$dp', biaya='$biaya' WHERE id_data='$id_data'");
            return mysqli_affected_rows($conn_back);}
        function delete_notes($data){global $conn_back;
            $id_data=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-data']))));
            $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-user']))));
            $id_barang=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-barang']))));
            $id_layanan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-layanan']))));
            $barcode=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['barcode']))));
            $files=glob("../Assets/img/img-qrcode-notes/".$barcode);
            foreach ($files as $file) {
                if (is_file($file))
                unlink($file);}
            if($id_layanan==1){
                mysqli_query($conn_back, "DELETE FROM handphone WHERE id_hp='$id_barang'");
            }else if($id_layanan==2){
                mysqli_query($conn_back, "DELETE FROM laptop WHERE id_laptop='$id_barang'");}
            mysqli_query($conn_back, "DELETE FROM users WHERE id_user='$id_user'");
            mysqli_query($conn_back, "DELETE FROM notes WHERE id_data='$id_data'");
            return mysqli_affected_rows($conn_back);}
        function editStatusNT($data){global $conn_back,$date;
            $id_data=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-data']))));
            $id_status=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-status']))));
            if($id_status==1){
                mysqli_query($conn_back, "UPDATE notes SET id_nota='1', id_status='1', tgl_status='$date', progress='10' WHERE id_data='$id_data'");
                return mysqli_affected_rows($conn_back);
            }else if($id_status==2){
                mysqli_query($conn_back, "UPDATE notes SET id_nota='4', id_status='2', tgl_status='$date', tgl_cancel='$date', progress='0' WHERE id_data='$id_data'");
                return mysqli_affected_rows($conn_back);
            }else if($id_status==3){
                mysqli_query($conn_back, "UPDATE notes SET id_nota='1', id_status='3', tgl_status='$date', progress='50' WHERE id_data='$id_data'");
                return mysqli_affected_rows($conn_back);
            }else if($id_status==4){
                mysqli_query($conn_back, "UPDATE notes SET id_nota='1', id_status='4', tgl_status='$date', progress='75' WHERE id_data='$id_data'");
                return mysqli_affected_rows($conn_back);
            }else if($id_status==5){
                mysqli_query($conn_back, "UPDATE notes SET id_nota='3', id_status='5', tgl_status='$date', progress='95' WHERE id_data='$id_data'");
                return mysqli_affected_rows($conn_back);
            }else if($id_status==6){
                mysqli_query($conn_back, "UPDATE notes SET id_nota='5', id_status='6', tgl_lunas='$date', progress='100' tgl_status='$date' WHERE id_data='$id_data'");
                return mysqli_affected_rows($conn_back);
            }else if($id_status==7){
                mysqli_query($conn_back, "UPDATE notes SET id_nota='4', id_status='7', tgl_status='$date', progress='5' WHERE id_data='$id_data'");
                return mysqli_affected_rows($conn_back);}}
        function notes_lunas($data){global $conn_back,$id_log,$time,$date,$date_search;
            // ==> Value from Form
            $nota_tinggal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['nota-tinggal']))));
            $nota_dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['nota-dp']))));
            $nota_lunas=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['nota-lunas']))));
            $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['username']))));
            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['email']))));
            $tlpn=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['tlpn']))));
            $alamat=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['alamat']))));
            $id_layanan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-layanan']))));
            if(empty($id_layanan)){
                $log="Kesalahan Input Nota Tinggal! Belum memilih layanan perbaikan.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Kamu belum memilih layanan perbaikan!";
                header("Location: nota-tinggal"); return false;
            }else if($id_layanan==1){
                $type=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['type']))));
                $seri_hp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['seri-hp']))));
                $imei=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['imei']))));
            }else if($id_layanan==2){
                $merek=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['merek']))));
                $seri_laptop=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['seri-laptop']))));}
            $kerusakan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['kerusakan']))));
            $kondisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['kondisi']))));
            $kelengkapan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['kelengkapan']))));
            $id_teknisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-teknisi']))));
            $dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['dp']))));
            $biaya=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['biaya']))));
            $keterangan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['keterangan']))));
            // ==> Logic Database
            $check_users=mysqli_query($conn_back, "SELECT * FROM users ORDER BY id_user DESC LIMIT 1");
            if(mysqli_num_rows($check_users)>0){
                $row=mysqli_fetch_assoc($check_users);
                $id_user=$row['id_user']+1;
            }else if(mysqli_num_rows($check_users)==0){
                $id_user=1;}
            $id_barang=$id_user;
            $data_encrypt=crc32($id_user);
            // ==> Jika ada nomor nota tinggal
            if(!empty($nota_tinggal)){
                // ==> Jika nomor urut nota tinggal tidak urut
                $check_urut_nota=mysqli_query($conn_back, "SELECT * FROM notes ORDER BY id_nota_tinggal DESC LIMIT 1");
                if(mysqli_num_rows($check_urut_nota)>0){
                    $row_urut=mysqli_fetch_assoc($check_urut_nota);
                    $id_nota_urut=$row_urut['id_nota_tinggal']+1;
                    if($id_nota_urut!=$nota_tinggal){
                        $log="Kesalahan Input Nota Tinggal! Nomor nota tinggal yang kamu masukan tidak urut, Nota Tinggal akhir saat ini ".$row_urut['id_nota_tinggal'].".";
                        mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $_SESSION['time-message']=time();
                        $_SESSION['message-danger']="Nomor nota tinggal yang kamu masukan tidak urut, Nota Tinggal akhir saat ini ".$row_urut['id_nota_tinggal'].". cek kembali!";
                        header("Location: nota-lunas"); return false;}}
                // ==> Jika nomor nota tinggal telah mencapai batas maksimum nota fisik yang ada
                $notes_type_tinggal=mysqli_query($conn_back, "SELECT * FROM notes_type WHERE name LIKE '%Nota Tinggal%'");
                $row_notes_type_tinggal=mysqli_fetch_assoc($notes_type_tinggal);
                $no_nota_tinggal=$row_notes_type_tinggal['no_nota'];
                if($nota_tinggal==$no_nota_tinggal || $nota_tinggal>$no_nota_tinggal){
                    $log="Kesalahan Input Nota Tinggal! Nomor nota tinggal yang dimasukan telah mencapai batas maksimum cetak.";
                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                    $_SESSION['time-message']=time();
                    $_SESSION['message-danger']="Nomor nota tinggal saat ini telah mencapai batas maksimum cetak, silakan cetak nota dan jika sudah segera setting ulang nomor nota tinggal!";
                    header("Location: nota-lunas");return false;}
                // ==> Jika nomor nota tinggal sudah ada
                $check_tinggal=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_nota_tinggal='$nota_tinggal'");
                if(mysqli_num_rows($check_tinggal)>0){
                    $log="Kesalahan Input Nota Tinggal! Nomor nota tinggal yang dimasukan sudah ada dengan nomor ".$nota_tinggal.".";
                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                    $_SESSION['time-message']=time();
                    $_SESSION['message-danger']="Nomor nota tinggal yang kamu masukan sudah ada, cek kembali!";
                    header("Location: nota-lunas");return false;}}
            if(!empty($data['nota-dp'])){
                // ==> Jika nomor urut nota dp tidak urut
                $check_urut_notaDP=mysqli_query($conn_back, "SELECT * FROM notes ORDER BY id_nota_dp DESC LIMIT 1");
                if(mysqli_num_rows($check_urut_notaDP)>0){
                    $row_urutDP=mysqli_fetch_assoc($check_urut_notaDP);
                    $id_nota_urutDP=$row_urutDP['id_nota_dp']+1;
                    if($id_nota_urutDP!=$nota_dp){
                        $log="Kesalahan Input Nota DP! Nomor nota dp yang kamu masukan tidak urut, Nota DP akhir saat ini ".$row_urutDP['id_nota_dp'].".";
                        mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $_SESSION['time-message']=time();
                        $_SESSION['message-danger']="Nomor nota dp yang kamu masukan tidak urut, Nota DP akhir saat ini ".$row_urutDP['id_nota_dp'].". cek kembali!";
                        header("Location: nota-lunas"); return false;}}
                // ==> 
                $check_dp=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_nota_dp='$nota_dp'");
                $notes_type_dp=mysqli_query($conn_back, "SELECT * FROM notes_type WHERE name LIKE '%Nota DP%'");
                $row_notes_type_dp=mysqli_fetch_assoc($notes_type_dp);
                $no_nota_dp=$row_notes_type_dp['no_nota'];
                if(mysqli_num_rows($check_dp)>0){
                    if($nota_dp==$no_nota_dp || $nota_dp>$no_nota_dp){
                        $log="Kesalahan Input Nota DP! Nomor nota dp yang dimasukan telah mencapai batas maksimum cetak dengan nomor ".$nota_dp.".";
                        mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $_SESSION['time-message']=time();
                        $_SESSION['message-danger']="Nomor nota dp yang kamu masukan saat ini telah mencapai batas maksimum cetak, silakan cetak nota dan jika sudah segera setting ulang nomor nota dp!";
                        header("Location: nota-lunas");return false;
                    }else{
                        $log="Kesalahan Input Nota DP! Nomor nota dp yang dimasukan sudah ada dengan nomor ".$nota_dp.".";
                        mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $_SESSION['time-message']=time();
                        $_SESSION['message-danger']="Nomor nota dp yang kamu masukan sudah ada, cek kembali!";
                        header("Location: nota-lunas");return false;}
                }else if(mysqli_num_rows($check_dp)==0){
                    if($nota_dp==$no_nota_dp || $nota_dp>$no_nota_dp){
                        $log="Kesalahan Input Nota DP! Nomor nota dp yang dimasukan telah mencapai batas maksimum cetak dengan nomor ".$nota_dp.".";
                        mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $_SESSION['time-message']=time();
                        $_SESSION['message-danger']="Nomor nota dp yang kamu masukan saat ini telah mencapai batas maksimum cetak, silakan cetak nota dan jika sudah segera setting ulang nomor nota dp!";
                        header("Location: nota-lunas");return false;}}
            }else if(empty($data['nota-dp'])){
                $nota_dp=0;}
            // ==> Jika ada nomor nota lunas
            if(!empty($nota_lunas)){
                // ==> Jika nomor nota lunas masih kosong di database
                $checkValueLunas=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_nota='3' AND id_nota_lunas>0");
                if(mysqli_num_rows($checkValueLunas)>0){
                    // ==> Jika nomor urut nota lunas tidak urut
                    $check_urut_nota=mysqli_query($conn_back, "SELECT * FROM notes ORDER BY id_nota_lunas DESC LIMIT 1");
                    if(mysqli_num_rows($check_urut_nota)>0){
                        $row_urut=mysqli_fetch_assoc($check_urut_nota);
                        $id_nota_urut=$row_urut['id_nota_lunas']+1;
                        if($id_nota_urut!=$nota_lunas){
                            $log="Kesalahan Input Nota Lunas! Nomor nota lunas yang kamu masukan tidak urut, Nota Lunas akhir saat ini ".$row_urut['id_nota_lunas'].".";
                            mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                            $_SESSION['time-message']=time();
                            $_SESSION['message-danger']="Nomor nota lunas yang kamu masukan tidak urut, Nota lunas akhir saat ini ".$row_urut['id_nota_lunas'].". cek kembali!";
                            header("Location: nota-lunas"); return false;}}
                    // ==> Jika nomor nota lunas telah mencapai batas maksimum nota fisik yang ada
                    $notes_type_lunas=mysqli_query($conn_back, "SELECT * FROM notes_type WHERE name LIKE '%Nota Lunas%'");
                    $row_notes_type_lunas=mysqli_fetch_assoc($notes_type_lunas);
                    $no_nota_lunas=$row_notes_type_lunas['no_nota'];
                    if($nota_lunas==$no_nota_lunas || $nota_lunas>$no_nota_lunas){
                        $log="Kesalahan Input Nota Lunas! Nomor nota lunas yang dimasukan telah mencapai batas maksimum cetak.";
                        mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $_SESSION['time-message']=time();
                        $_SESSION['message-danger']="Nomor nota lunas saat ini telah mencapai batas maksimum cetak, silakan cetak nota dan jika sudah segera setting ulang nomor nota lunas!";
                        header("Location: nota-lunas");return false;}
                    // ==> Jika nomor nota lunas sudah ada
                    $check_lunas=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_nota_lunas='$nota_lunas'");
                    if(mysqli_num_rows($check_lunas)>0){
                        $log="Kesalahan Input Nota Lunas! Nomor nota lunas yang dimasukan sudah ada dengan nomor ".$nota_lunas.".";
                        mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $_SESSION['time-message']=time();
                        $_SESSION['message-danger']="Nomor nota lunas yang kamu masukan sudah ada, cek kembali!";
                        header("Location: nota-lunas");return false;}}}
            if(!empty($nota_dp)){
                if(empty($dp) || $dp==0){
                    $log="Kesalahan Input Nota DP! Nomor nota dp ".$nota_dp." sudah ada tetapi biaya dp belum dimasukan.";
                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                    $_SESSION['time-message']=time();
                    $_SESSION['message-danger']="Kamu belum memasukan uang muka atau DP sementara nomor DP ada, sialakan cek lagi!";
                    header("Location: nota-lunas");return false;}
            }else if(empty($nota_dp) && $dp>=10000){
                $log="Kesalahan Input Nota DP! Belum memasukan nomor nota dp sementara dp ada.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Kamu belum memasukan nomor nota dp sementara dp sudah, silakan coba lagi!";
                header("Location: nota-lunas");return false;}
            if($biaya<=10000){
                $log="Kesalahan Input Biaya Perbaikan! Memasukan biaya kurang dari Rp. 10.000,00.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Pastikan anda memasukan biaya dengan benar (Min: Rp. 10.000,00)!";
                header("Location: nota-lunas");return false;}
            $barcode=barcode_notes_lunas($data_encrypt);
            if(empty($email)){$email=$nota_tinggal;$password=$nota_tinggal;}
            else if(!empty($email)){
                $checkEmail=mysqli_query($conn_back, "SELECT * FROM users WHERE email='$email'");
                if(mysqli_num_rows($checkEmail)>0){
                    $log="Kesalahan Input Email Nota! Memasukan email nota yang sudah ada dengan email ".$email.".";
                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                    $_SESSION['time-message']=time();
                    $_SESSION['message-danger']="Email yang dimasukan sudah ada!";
                    header("Location: nota-lunas");return false;}}
            $checkLog=mysqli_query($conn_back, "SELECT * FROM users ORDER BY id_log DESC LIMIT 1");
            if(mysqli_num_rows($checkLog)>0){
                $rowLog=mysqli_fetch_assoc($checkLog);
                $id_loged=$rowLog['id_log']+1;
            }else if(mysqli_num_rows($checkLog)==0){
                $id_loged=1;}
            if(!empty($data['bukti-tanpa-nota'])){
                $ket_img=ket_img_lunas($data_encrypt);
                if(!$ket_img){return false;}
            }else{
                $ket_img="-";}
            mysqli_query($conn_back, "INSERT INTO users(id_user,data_encrypt,first_name,email,password,phone,address,id_log,date_created) VALUES('$id_user','$data_encrypt','$username','$email','$password','$tlpn','$alamat','$id_loged','$date')");
            if($id_layanan==1){
                mysqli_query($conn_back, "INSERT INTO handphone(id_hp,type,seri,imei) VALUES('$id_user','$type','$seri_hp','$imei')");
            }else if($id_layanan==2){
                mysqli_query($conn_back, "INSERT INTO laptop(id_laptop,merek,seri) VALUES('$id_user','$merek','$seri_laptop')");}
            $garansi="";
            if(is_numeric($biaya) && is_numeric($dp)){
                $total=$biaya-$dp;}
            mysqli_query($conn_back, "INSERT INTO notes(id_nota,id_nota_lunas,id_user,id_layanan,id_barang,id_pegawai,id_status,tgl_cari,tgl_masuk,tgl_lunas,tgl_status,tgl_ambil,time,time_status,kerusakan,kondisi,kelengkapan,ket_text,ket_img,garansi,dp,biaya,total,barcode,progress) VALUES('3','$nota_lunas','$id_user','$id_layanan','$id_barang','$id_teknisi','5','$date_search','$date','$date','$date','$date','$time','$time','$kerusakan','$kondisi','$kelengkapan','$keterangan','$ket_img','$garansi',$dp,$biaya,$total,'$barcode','100')");
            return mysqli_affected_rows($conn_back);}
        function barcode_notes_lunas($data_encrypt){global $link_qr;
            require_once('../Assets/phpqrcode/qrlib.php');
            $qrvalue = $link_qr.$data_encrypt;
            $tempDir = "../Assets/img/img-qrcode-notes/";
            $codeContents = $qrvalue;
            $fileName = $data_encrypt.".jpg";
            $pngAbsoluteFilePath = $tempDir.$fileName;
            if(!file_exists($pngAbsoluteFilePath)){
                QRcode::png($codeContents, $pngAbsoluteFilePath);}
            return $fileName;}
        function ket_img_lunas($data_encrypt){global $conn_back,$id_log,$date,$time;
            $namaFile=$_FILES["bukti-tanpa-nota"]["name"];
            $ukuranFile=$_FILES["bukti-tanpa-nota"]["size"];
            $tmpName=$_FILES["bukti-tanpa-nota"]["tmp_name"];
            $ekstensiGambarValid=['jpg','jpeg','png'];
            $ekstensiGambar=explode('.',$namaFile);
            $ekstensiGambar=strtolower(end($ekstensiGambar));
            if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
                $log="Kesalahan Input Barcode! Bukti tanpa nota yang dimasukan bukan gambar.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Maaf, bukan gambar!";
                header("Location: nota-lunas");return false;}
            if($ukuranFile>2000000){
                $log="Kesalahan Input Barcode! Bukti tanpa nota yang dimasukan berukuran lebih dari 2M.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Maaf, ukuran gambar terlalu besar! (2MB)";
                header("Location: nota-lunas");return false;}
            $verifyPhoto=$data_encrypt.".jpg";
            move_uploaded_file($tmpName,'../Assets/img/img-notes/'.$verifyPhoto);
            return $verifyPhoto;}
        function edit_notesLunas($data){global $conn_back,$id_log,$date,$time;
            // ==> Value from Form
            $id_data=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-data']))));
            $id_barang=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-barang']))));
            $nota_tinggal_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-nota-tinggal-old']))));
            $nota_dp_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-nota-dp-old']))));
            $nota_lunas_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-nota-lunas-old']))));
            $nota_tinggal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['nota-tinggal']))));
            $nota_dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['nota-dp']))));
            $nota_lunas=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['nota-lunas']))));
            $id_layanan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-layanan']))));
            if(empty($id_layanan)){
                $log="Kesalahan Ubah Nota Tinggal! Belum memilih layanan perbaikan.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Kamu belum memilih layanan perbaikan!";
                header("Location: nota-tinggal"); return false;
            }else if($id_layanan==1){
                $type=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['type']))));
                $seri_hp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['seri-hp']))));
                $imei=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['imei']))));
            }else if($id_layanan==2){
                $merek=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['merek']))));
                $seri_laptop=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['seri-laptop']))));}
            $kerusakan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['kerusakan']))));
            $kondisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['kondisi']))));
            $kelengkapan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['kelengkapan']))));
            $id_teknisi=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-teknisi']))));
            $tgl_ambil=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['tgl-ambil']))));
            $dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['dp']))));
            $biaya=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['biaya']))));
            // ==> Cek nota tinggal
            $checkNotaTinggal=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_nota_tinggal='$nota_tinggal'");
            if($nota_tinggal!=$nota_tinggal_old){
                if(mysqli_num_rows($checkNotaTinggal)>0){
                    $log="Kesalahan Ubah Nota Tinggal! Nota Tinggal yang dimasukan sudah ada dengan nomor ".$nota_tinggal.".";
                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                    $_SESSION['time-message']=time();
                    $_SESSION['message-danger']="Nota Tinggal yang kamu masukan sudah ada!";
                    header("Location: nota-tinggal"); return false;}}
            $checkNotaDp=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_nota_dp='$nota_dp'");
            if($nota_dp!=$nota_dp_old){
                if(mysqli_num_rows($checkNotaDp)>0){
                    $log="Kesalahan Ubah Nota Dp! Nota Dp yang dimasukan sudah ada dengan nomor ".$nota_dp.".";
                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                    $_SESSION['time-message']=time();
                    $_SESSION['message-danger']="Nota Dp yang kamu masukan sudah ada!";
                    header("Location: nota-tinggal"); return false;}}
            // ==> Jika nota lunas lama tidak sama dengan yang baru
            if(!empty($nota_lunas)){
                // ==> Jika ada nomor nota lunas
                if($nota_lunas_old!=$nota_lunas){
                    // ==> Jika nomor urut nota lunas tidak urut
                    $check_urut_nota=mysqli_query($conn_back, "SELECT * FROM notes ORDER BY id_nota_lunas DESC LIMIT 1");
                    if(mysqli_num_rows($check_urut_nota)>0){
                        $row_urut=mysqli_fetch_assoc($check_urut_nota);
                        $id_nota_urut=$row_urut['id_nota_lunas']+1;
                        if($id_nota_urut!=$nota_lunas){
                            $log="Kesalahan Input Nota Lunas! Nomor nota lunas yang kamu masukan tidak urut, Nota Lunas akhir saat ini ".$row_urut['id_nota_lunas'].".";
                            mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                            $_SESSION['time-message']=time();
                            $_SESSION['message-danger']="Nomor nota lunas yang kamu masukan tidak urut, Nota lunas akhir saat ini ".$row_urut['id_nota_lunas'].". cek kembali!";
                            header("Location: nota-lunas"); return false;}}
                    // ==> Jika nomor nota lunas telah mencapai batas maksimum nota fisik yang ada
                    $notes_type_lunas=mysqli_query($conn_back, "SELECT * FROM notes_type WHERE name LIKE '%Nota Lunas%'");
                    $row_notes_type_lunas=mysqli_fetch_assoc($notes_type_lunas);
                    $no_nota_lunas=$row_notes_type_lunas['no_nota'];
                    if($nota_lunas==$no_nota_lunas || $nota_lunas>$no_nota_lunas){
                        $log="Kesalahan Input Nota Lunas! Nomor nota lunas yang dimasukan telah mencapai batas maksimum cetak.";
                        mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $_SESSION['time-message']=time();
                        $_SESSION['message-danger']="Nomor nota lunas saat ini telah mencapai batas maksimum cetak, silakan cetak nota dan jika sudah segera setting ulang nomor nota lunas!";
                        header("Location: nota-lunas");return false;}
                    // ==> Jika nomor nota lunas sudah ada
                    $check_lunas=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_nota_lunas='$nota_lunas'");
                    if(mysqli_num_rows($check_lunas)>0){
                        $log="Kesalahan Input Nota Lunas! Nomor nota lunas yang dimasukan sudah ada dengan nomor ".$nota_lunas.".";
                        mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $_SESSION['time-message']=time();
                        $_SESSION['message-danger']="Nomor nota lunas yang kamu masukan sudah ada, cek kembali!";
                        header("Location: nota-lunas");return false;}}}
            if(!empty($nota_dp)){
                if(empty($dp) || $dp==0){
                    $log="Kesalahan Ubah Nota DP! Nomor nota dp ".$nota_dp." sudah ada tetapi biaya dp belum dimasukan.";
                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                    $_SESSION['time-message']=time();
                    $_SESSION['message-danger']="Kamu belum memasukan uang muka atau DP sementara nomor DP ada, sialakan cek lagi!";
                    header("Location: nota-tinggal");return false;}
            }else if(empty($nota_dp) && $dp>=10000){
                $log="Kesalahan Input Nota DP! Belum memasukan nomor nota dp sementara dp ada.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Kamu belum memasukan nomor nota dp sementara dp sudah, silakan coba lagi!";
                header("Location: nota-tinggal");return false;}
            if($biaya<=10000){
                $log="Kesalahan Ubah Biaya Perbaikan! Memasukan biaya kurang dari Rp. 10.000,00.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Pastikan anda memasukan biaya dengan benar (Min: Rp. 10.000,00)!";
                header("Location: nota-tinggal");return false;}
            if($id_layanan==1){
                mysqli_query($conn_back, "UPDATE handphone SET type='$type', seri='$seri_hp', imei='$imei' WHERE id_hp='$id_barang'");
            }else if($id_layanan==2){
                mysqli_query($conn_back, "UPDATE laptop SET merek='$merek', seri='$seri_laptop' WHERE id_laptop='$id_barang'");}
            mysqli_query($conn_back, "UPDATE notes SET id_nota_tinggal='$nota_tinggal', id_nota_dp='$nota_dp', id_nota_lunas='$nota_lunas', kerusakan='$kerusakan', kondisi='$kondisi', kelengkapan='$kelengkapan', id_pegawai='$id_teknisi', tgl_ambil='$tgl_ambil', dp='$dp', biaya='$biaya' WHERE id_data='$id_data'");
            return mysqli_affected_rows($conn_back);}
        function edit_noNotesLunas($data){global $conn_back,$id_log,$date,$time;
            $id_data=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-data']))));
            $nota_lunas_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-nota-lunas-old']))));
            $nota_lunas=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['nota-lunas']))));
            // ==> Jika ada nomor nota lunas
            if(!empty($nota_lunas)){
                // ==> Jika nota lunas lama tidak sama dengan yang baru
                if($nota_lunas_old!=$nota_lunas){
                    // ==> Jika nomor urut nota lunas tidak urut
                    $check_urut_nota=mysqli_query($conn_back, "SELECT * FROM notes ORDER BY id_nota_lunas DESC LIMIT 1");
                    if(mysqli_num_rows($check_urut_nota)>0){
                        $row_urut=mysqli_fetch_assoc($check_urut_nota);
                        $id_nota_urut=$row_urut['id_nota_lunas']+1;
                        if($id_nota_urut!=$nota_lunas){
                            $log="Kesalahan Input Nota Lunas! Nomor nota lunas yang kamu masukan tidak urut, Nota Lunas akhir saat ini ".$row_urut['id_nota_lunas'].".";
                            mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                            $_SESSION['time-message']=time();
                            $_SESSION['message-danger']="Nomor nota lunas yang kamu masukan tidak urut, Nota lunas akhir saat ini ".$row_urut['id_nota_lunas'].". cek kembali!";
                            header("Location: nota-lunas"); return false;
                        }else{
                            // ==> Jika nomor nota lunas telah mencapai batas maksimum nota fisik yang ada
                            $notes_type_lunas=mysqli_query($conn_back, "SELECT * FROM notes_type WHERE name LIKE '%Nota Lunas%'");
                            $row_notes_type_lunas=mysqli_fetch_assoc($notes_type_lunas);
                            $no_nota_lunas=$row_notes_type_lunas['no_nota'];
                            if($nota_lunas==$no_nota_lunas || $nota_lunas>$no_nota_lunas){
                                $log="Kesalahan Input Nota Lunas! Nomor nota lunas yang dimasukan telah mencapai batas maksimum cetak.";
                                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                                $_SESSION['time-message']=time();
                                $_SESSION['message-danger']="Nomor nota lunas saat ini telah mencapai batas maksimum cetak, silakan cetak nota dan jika sudah segera setting ulang nomor nota lunas!";
                                header("Location: nota-lunas");return false;
                            }else{
                                // ==> Jika nomor nota lunas sudah ada
                                $check_lunas=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_nota_lunas='$nota_lunas'");
                                if(mysqli_num_rows($check_lunas)>0){
                                    $log="Kesalahan Input Nota Lunas! Nomor nota lunas yang dimasukan sudah ada dengan nomor ".$nota_lunas.".";
                                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                                    $_SESSION['time-message']=time();
                                    $_SESSION['message-danger']="Nomor nota lunas yang kamu masukan sudah ada, cek kembali!";
                                    header("Location: nota-lunas");return false;
                                }else{
                                    mysqli_query($conn_back, "UPDATE notes SET id_nota_lunas='$nota_lunas' WHERE id_data='$id_data'");
                                    return mysqli_affected_rows($conn_back);}}}}
                }else if($nota_lunas_old==$nota_lunas){
                    $log="Kesalahan Input Nota Lunas! Nomor nota lunas yang kamu masukan sama dengan yang sebelumnya, Nota Lunas sebelumnya ".$nota_lunas_old.".";
                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                    $_SESSION['time-message']=time();
                    $_SESSION['message-danger']="Nomor nota lunas yang kamu masukan sama dengan yang sebelumnya, Nota Lunas sebelumnya ".$nota_lunas_old.".";
                    header("Location: nota-lunas"); return false;}}}
        function delete_notesLunas($data){global $conn_back;
            $id_data=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-data']))));
            $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-user']))));
            $id_barang=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-barang']))));
            $id_layanan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-layanan']))));
            $barcode=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['barcode']))));
            $files=glob("../Assets/img/img-qrcode-notes/".$barcode);
            foreach ($files as $file) {
                if (is_file($file))
                unlink($file);}
            if($id_layanan==1){
                mysqli_query($conn_back, "DELETE FROM handphone WHERE id_hp='$id_barang'");
            }else if($id_layanan==2){
                mysqli_query($conn_back, "DELETE FROM laptop WHERE id_laptop='$id_barang'");}
            mysqli_query($conn_back, "DELETE FROM users WHERE id_user='$id_user'");
            mysqli_query($conn_back, "DELETE FROM notes WHERE id_data='$id_data'");
            return mysqli_affected_rows($conn_back);}
        function quickStatus($data){global $conn_back,$date;
            $id_data=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-data']))));
            $id_status=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-status']))));
            if($id_status==1){
                mysqli_query($conn_back, "UPDATE notes SET id_nota='1', id_status='1', tgl_status='$date', progress='10' WHERE id_data='$id_data'");
                return mysqli_affected_rows($conn_back);
            }else if($id_status==2){
                mysqli_query($conn_back, "UPDATE notes SET id_nota='4', id_status='2', tgl_status='$date', tgl_cancel='$date', progress='0' WHERE id_data='$id_data'");
                return mysqli_affected_rows($conn_back);
            }else if($id_status==3){
                mysqli_query($conn_back, "UPDATE notes SET id_nota='1', id_status='3', tgl_status='$date', progress='50' WHERE id_data='$id_data'");
                return mysqli_affected_rows($conn_back);
            }else if($id_status==4){
                mysqli_query($conn_back, "UPDATE notes SET id_nota='1', id_status='4', tgl_status='$date', progress='75' WHERE id_data='$id_data'");
                return mysqli_affected_rows($conn_back);
            }else if($id_status==5){
                mysqli_query($conn_back, "UPDATE notes SET id_nota='3', id_status='5', tgl_status='$date', progress='95' WHERE id_data='$id_data'");
                return mysqli_affected_rows($conn_back);
            }else if($id_status==6){
                $expired=mktime(0,0,0,date("n"),date("j")+7,date("Y"));
                $garansi=date("d-m-Y", $expired);
                mysqli_query($conn_back, "UPDATE notes SET id_nota='5', id_status='6', tgl_lunas='$date', garansi='$garansi', progress='100', tgl_status='$date' WHERE id_data='$id_data'");
                return mysqli_affected_rows($conn_back);
            }else if($id_status==7){
                mysqli_query($conn_back, "UPDATE notes SET id_nota='4', id_status='7', tgl_status='$date', progress='5' WHERE id_data='$id_data'");
                return mysqli_affected_rows($conn_back);}}
        function notes_report($data){global $conn_back,$date,$time,$id_log;
            $id_data=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-data']))));
            $id_lunas=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-nota-lunas']))));
            $kerusakan=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['kerusakan']))));
            if($id_lunas==0){
                $log="Kesalahan Input Laporan Harian! Belum ada nomor nota lunas namun diajukan ke laporan harian.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Cek kembali nomor nota lunas! belum ada nomor nota lunas, silakan diisi terlebih dahulu.";
                header("Location: nota-lunas"); return false;
            }
            if(preg_match('LCD', $kerusakan)){
                $expired=mktime(0,0,0,date("n"),date("j")+7,date("Y"));
                $garansi=date("M d, Y h:i:s", $expired);
            }else{
                $garansi=date("M d, Y h:i:s");}
            mysqli_query($conn_back, "UPDATE notes SET id_nota='5', id_status='6', tgl_lunas='$date', tgl_laporan='$date', garansi='$garansi', progress='100', tgl_status='$date' WHERE id_data='$id_data'");
            return mysqli_affected_rows($conn_back);}
        function notesRecovery($data){global $conn_back,$date;
            $id_data=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-data']))));
            mysqli_query($conn_back, "UPDATE notes SET id_nota='1', id_status='1', tgl_status='$date', tgl_cancel='-', progress='10' WHERE id_data='$id_data'");
            return mysqli_affected_rows($conn_back);}
        function report_expense($data){global $conn_back,$time,$date,$date_search;
            $jenis=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['jenis']))));
            $ket=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['ket']))));
            $biaya=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['biaya']))));
            mysqli_query($conn_back, "INSERT INTO laporan_pengeluaran(jenis_pengeluaran,ket,biaya_pengeluaran,tgl_pengeluaran,tgl_cari,time) VALUES('$jenis','$ket','$biaya','$date','$date_search','$time')");
            return mysqli_affected_rows($conn_back);}
        function edit_report_expense($data){global $conn_back;
            $id_pengeluaran=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-pengeluaran']))));
            $jenis=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['jenis']))));
            $ket=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['ket']))));
            $biaya=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['biaya']))));
            mysqli_query($conn_back, "UPDATE laporan_pengeluaran SET jenis_pengeluaran='$jenis', ket='$ket', biaya_pengeluaran='$biaya' WHERE id_pengeluaran='$id_pengeluaran'");
            return mysqli_affected_rows($conn_back);}
        function delete_report_expense($data){global $conn_back;
            $id_pengeluaran=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-pengeluaran']))));
            mysqli_query($conn_back, "DELETE FROM laporan_pengeluaran WHERE id_pengeluaran='$id_pengeluaran'");
            return mysqli_affected_rows($conn_back);}
        function report_sparepart($data){global $conn_back,$time,$date,$date_search,$link_qrs;
            $cek_idSparepart=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts ORDER BY id_sparepart DESC LIMIT 1");
            if(mysqli_num_rows($cek_idSparepart)>0){
                $loop_idSparepart=mysqli_fetch_assoc($cek_idSparepart);
                $idSparepart=$loop_idSparepart['id_sparepart'];
                $id_sparepart=$idSparepart+1;
            }else if(mysqli_num_rows($cek_idSparepart)==0){
                $id_sparepart=1;}
            $data_encrypt=crc32($id_sparepart);
            $ket=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['ket']))));
            $suplayer=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['suplayer']))));
            $jumlah=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['jumlah']))));
            $harga=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['harga']))));
            $total=$harga*$jumlah;
            $ket_plus=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['ket-plus']))));
            $tgl_beli=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['tgl-beli']))));
            require_once('../Assets/phpqrcode/qrlib.php');
            $qrvalue = $link_qrs.$data_encrypt;
            $tempDir = "../Assets/img/img-qrcode-spareparts/";
            $codeContents = $qrvalue;
            $barcode = $data_encrypt.".jpg";
            $pngAbsoluteFilePath = $tempDir.$barcode;
            if(!file_exists($pngAbsoluteFilePath)){
                QRcode::png($codeContents, $pngAbsoluteFilePath);}
            mysqli_query($conn_back, "INSERT INTO laporan_spareparts(data_encrypt,tgl_masuk,tgl_cari,tgl_beli,time,ket,suplayer,jmlh_barang,harga,total,ket_plus,qrcode,status_sparepart) VALUES('$data_encrypt','$date','$date_search','$tgl_beli','$time','$ket','$suplayer','$jumlah','$harga','$total','$ket_plus','$barcode','1')");
            return mysqli_affected_rows($conn_back);}
        function remake_qrcode($data){global $conn_back,$link_qrs;
            $id_sparepart=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-sparepart']))));
            $qr=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['qrcode-old']))));
            $files=glob("../Assets/img/img-qrcode-spareparts/".$qr);
            foreach($files as $file){if(is_file($file))unlink($file);}
            $data_encrypt=crc32($id_sparepart);
            require_once('../Assets/phpqrcode/qrlib.php');
            $qrvalue = $link_qrs.$data_encrypt;
            $tempDir = "../Assets/img/img-qrcode-spareparts/";
            $codeContents = $qrvalue;
            $qrcode = $data_encrypt.".jpg";
            $pngAbsoluteFilePath = $tempDir.$qrcode;
            if(!file_exists($pngAbsoluteFilePath)){
                QRcode::png($codeContents, $pngAbsoluteFilePath);}
            mysqli_query($conn_back, "UPDATE laporan_spareparts SET data_encrypt='$data_encrypt', qrcode='$qrcode' WHERE id_sparepart='$id_sparepart'");
            return mysqli_affected_rows($conn_back);}
        function editSparepart($data){global $conn_back,$id_log,$date,$time;
            $id_sparepart=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-sparepart']))));
            $ket=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['ket']))));
            $suplayer=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['suplayer']))));
            if(empty($suplayer) || $suplayer==""){
                $log="Kesalahan Ubah Sparepart! Belum memilih suplayer.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Kamu belum memasukan suplayer!";
                header("Location: report-spareparts"); return false;}
            $jumlah=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['jumlah']))));
            $harga=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['harga']))));
            $total=$harga*$jumlah;
            $ket_plus=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['ket-plus']))));
            $tgl_beli=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['tgl-beli']))));
            mysqli_query($conn_back, "UPDATE laporan_spareparts SET ket='$ket', suplayer='$suplayer', jmlh_barang='$jumlah', harga='$harga', total='$total', ket_plus='$ket_plus', tgl_beli='$tgl_beli' WHERE id_sparepart='$id_sparepart'");
            return mysqli_affected_rows($conn_back);}
        function deleteSparepart($data){global $conn_back;
            $id_sparepart=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-sparepart']))));
            $qrcode=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['qrcode']))));
            $files=glob("../Assets/img/img-qrcode-spareparts/".$qrcode);
            foreach($files as $file){if(is_file($file))unlink($file);}
            mysqli_query($conn_back, "DELETE FROM laporan_spareparts WHERE id_sparepart='$id_sparepart'");
            return mysqli_affected_rows($conn_back);}
        function sparepartTerpakai($data){global $conn_back,$link_qrs,$date_search,$time,$id_log, $date;
            $id_sparepart=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-sparepart']))));
            $jmlh_barang=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['jmlh-barang']))));
            $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-user']))));
            $id_pegawai=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-pegawai']))));
            $dp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['dp']))));
            $queryStock=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts WHERE id_sparepart='$id_sparepart'");
            $rowS=mysqli_fetch_assoc($queryStock);
            if(preg_match('/LCD/', $rowS['ket'])){
                if($_SESSION['id-role']==3){
                    if($dp==0){
                        $log="Kesalahan Laporan Sparepart! Memasukan nota yang tidak ada DP.";
                        mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                        $_SESSION['time-message']=time();
                        $_SESSION['message-special']="Ops...! Nota yang dipilih tidak ada DP";
                        header("Location: select-note?ids=$id_sparepart&jb=$jmlh_barang"); return false;}}}
            $checkNotes=mysqli_query($conn_back, "SELECT * FROM notes WHERE id_user='$id_user'");
            $row=mysqli_fetch_assoc($checkNotes);
            if(!empty($row['id_nota_tinggal'])){
                $id_nota="T".$row['id_nota_tinggal'];
            }else{
                $id_nota="L".$row['id_nota_lunas'];}
            if($jmlh_barang>1){
                $cek_idSparepart=mysqli_query($conn_back, "SELECT * FROM laporan_spareparts ORDER BY id_sparepart DESC LIMIT 1");
                if(mysqli_num_rows($cek_idSparepart)>0){
                    $loop_idSparepart=mysqli_fetch_assoc($cek_idSparepart);
                    $idSparepart=$loop_idSparepart['id_sparepart'];
                    $id_sparepartNew=$idSparepart+1;
                }else if(mysqli_num_rows($cek_idSparepart)==0){
                    $id_sparepartNew=1;}
                $data_encrypt=crc32($id_sparepartNew);
                $ket=$rowS['ket'];
                $suplayer=$rowS['suplayer'];
                $jumlah=1;
                $jmlh_barangNow=$rowS['jmlh_barang']-1;
                $harga=$rowS['harga'];
                $total=$harga*$jumlah;
                $ket_plus=$rowS['ket_plus'];
                $tgl_beli=$rowS['tgl_beli'];
                require_once('../Assets/phpqrcode/qrlib.php');
                $qrvalue = $link_qrs.$data_encrypt;
                $tempDir = "../Assets/img/img-qrcode-spareparts/";
                $codeContents = $qrvalue;
                $barcode = $data_encrypt.".jpg";
                $pngAbsoluteFilePath = $tempDir.$barcode;
                if(!file_exists($pngAbsoluteFilePath)){
                    QRcode::png($codeContents, $pngAbsoluteFilePath);}
                mysqli_query($conn_back, "INSERT INTO laporan_spareparts(id_user,data_encrypt,tgl_masuk,tgl_cari,tgl_beli,time,ket,suplayer,jmlh_barang,harga,total,ket_plus,id_pegawai,id_nota,qrcode,status_sparepart) VALUES('$id_user','$data_encrypt','$date_search','$date_search','$tgl_beli','$time','$ket','$suplayer','$jumlah','$harga','$total','$ket_plus','$id_pegawai','$id_nota','$barcode','2')");
                mysqli_query($conn_back, "UPDATE laporan_spareparts SET jmlh_barang='$jmlh_barangNow' WHERE id_sparepart='$id_sparepart'");
                return mysqli_affected_rows($conn_back);
            }else if($jmlh_barang==1){
                mysqli_query($conn_back, "UPDATE laporan_spareparts SET id_user='$id_user', id_pegawai='$id_pegawai', id_nota='$id_nota', status_sparepart='2' WHERE id_sparepart='$id_sparepart'");
                return mysqli_affected_rows($conn_back);}}
        function sparepartBatal($data){global $conn_back;
            $id_sparepart=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-sparepart']))));
            mysqli_query($conn_back, "UPDATE laporan_spareparts SET status_sparepart='1' WHERE id_sparepart='$id_sparepart'");
            return mysqli_affected_rows($conn_back);}
        function sparepartDipakai($data){global $conn_back;
            $id_sparepart=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-sparepart']))));
            mysqli_query($conn_back, "UPDATE laporan_spareparts SET status_sparepart='3' WHERE id_sparepart='$id_sparepart'");
            return mysqli_affected_rows($conn_back);}
        function new_suplayer($data){global $conn_back;
            $suplayer=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['suplayer']))));
            mysqli_query($conn_back, "INSERT INTO supplier(supplier) VALUES('$suplayer')");
            return mysqli_affected_rows($conn_back);
        }
        // function __($data){global $conn_front,$conn_back;}
    }
    if($_SESSION['id-role']<=4){}
    if($_SESSION['id-role']<=5){}
    if($_SESSION['id-role']<=6){
        function darkMode($data){global $conn_back, $id_user;
            $id=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['id-darkMode']))));
            if($id==1){
                mysqli_query($conn_back, "UPDATE users SET id_darkMode='2' WHERE id_user='$id_user'");
                return mysqli_affected_rows($conn_back);
            }else if($id==2){
                mysqli_query($conn_back, "UPDATE users SET id_darkMode='1' WHERE id_user='$id_user'");
                return mysqli_affected_rows($conn_back);}}
        function photo_profile($data){global $conn_back,$id_user;
            $img=file_photo_user();
            if(!$img){return false;}
            $img_old=$data['img-old'];
            if($img_old!='default.png'){unlink('../Assets/img/img-users/'.$img_old);}
            mysqli_query($conn_back, "UPDATE users SET img='$img' WHERE id_user='$id_user'");
            return mysqli_affected_rows($conn_back);}
        function file_photo_user(){global $conn_back,$time,$date;
            $namaFile=$_FILES["profile"]["name"];
            $ukuranFile=$_FILES["profile"]["size"];
            $error=$_FILES["profile"]["error"];
            $tmpName=$_FILES["profile"]["tmp_name"];
            if($error===4){
                $id_log=$_SESSION['id-log'];
                $log="Kesalahan! Belum memilih gambar profile";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Pilih gambar profil kamu terlebih dahulu!";
                header("Location: ../Views/profile");return false;
            }
            $ekstensiGambarValid=['jpg','jpeg','png'];
            $ekstensiGambar=explode('.',$namaFile);
            $ekstensiGambar=strtolower(end($ekstensiGambar));
            if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
                $id_log=$_SESSION['id-log'];
                $log="Kesalahan! Bukan memilih gambar.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Maaf, file kamu bukan gambar!";
                header("Location: profile");return false;
            }
            if($ukuranFile>2000000){
                $id_log=$_SESSION['id-log'];
                $log="Kesalahan! Memilih gambar dengan ukuran lebih dari 2M";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Maaf, ukuran gambar terlalu besar! (2MB)";
                header("Location: profile");return false;
            }
            $namaFile_encrypt=crc32($namaFile);
            $encrypt=$namaFile_encrypt.".jpg";
            move_uploaded_file($tmpName,'../Assets/img/img-users/'.$encrypt);
            return $encrypt;}
        function email_profile($data){global $conn_back,$time,$date,$id_user;
            $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['email']))));
            $email_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['email-old']))));
            $password1=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['password1']))));
            $password2=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['password2']))));
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $id_log=$_SESSION['id-log'];
                $log="Kesalahan Profile! Tidak memasukan email dengan benar.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Email yang kamu masukan tidak sesuai.";
                header("Location: profile");return false;
            }
            if($email==$email_old){
                $id_log=$_SESSION['id-log'];
                $log="Kesalahan Profile! Email yang dimasukan sama dengan email lama.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Email yang kamu masukan sama dengan email lama kamu.";
                header("Location: profile");return false;
            }
            if($password1!=$password2){
                $id_log=$_SESSION['id-log'];
                $log="Kesalahan Profile! Password yang dimasukan tidak sama.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Password yang kamu masukan tidak sama.";
                header("Location: profile");return false;
            }
            $check_users=mysqli_query($conn_back, "SELECT * FROM users WHERE email='$email'");
            if(mysqli_num_rows($check_users)>0){
                $id_log=$_SESSION['id-log'];
                $log="Kesalahan Profile! Memasukan email yang sudah terpakai.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']='Email yang ingin kamu ubah: '. $email .' sudah ada atau telah dipakai!';
                header("Location: profile");return false;
            }else if(mysqli_num_rows($check_users)==0){
                $passUsers=mysqli_query($conn_back, "SELECT * FROM users WHERE email='$email_old'");
                $row=mysqli_fetch_assoc($passUsers);
                $pass=$row['password'];
                if(password_verify($password1,$pass)){
                    mysqli_query($conn_back, "UPDATE users SET email='$email' WHERE id_user='$id_user'");
                    return mysqli_affected_rows($conn_back);
                }else{
                    $id_log=$_SESSION['id-log'];
                    $log="Kesalahan Profile! Salah memasukan password.";
                    mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                    $_SESSION['time-message']=time();
                    $_SESSION['message-danger']='Password yang kamu masukan salah, silakan coba lagi!';
                    header("Location: profile");return false;}}}
        function biodata_profile($data){global $conn_back,$time,$date,$id_user;
            $first_name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['first-name']))));
            $last_name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['last-name']))));
            $phone=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['phone']))));
            $address=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['address']))));
            $postal=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['postal']))));
            mysqli_query($conn_back, "UPDATE users SET first_name='$first_name', last_name='$last_name', phone='$phone', address='$address', postal='$postal' WHERE id_user='$id_user'");
            return mysqli_affected_rows($conn_back);}
        function password_profile($data){global $conn_back,$time,$date,$id_user;
            $password1=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['password1']))));
            $password2=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['password2']))));
            $password_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['password-old']))));
            if(password_verify($password1, $password_old)){
                $id_log=$_SESSION['id-log'];
                $log="Kesalahan Setting Profile! Password yang dimasukan sama dengan password lama.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Password yang kamu masukan sama dengan password lama.";
                header("Location: profile-settings");return false;
            }
            if($password1!=$password2){
                $id_log=$_SESSION['id-log'];
                $log="Kesalahan Setting Profile! Password yang dimasukan tidak sama.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Password yang kamu masukan tidak sama.";
                header("Location: profile-settings");return false;
            }
            $check_lenght_pass=strlen($password1);
            if($check_lenght_pass<=8){
                $id_log=$_SESSION['id-log'];
                $log="Kesalahan Setting Profile! Password yang dimasukan terlalu pendek.";
                mysqli_query($conn_back, "INSERT INTO users_log(id_log,log,date,time) VALUES('$id_log','$log','$date','$time')");
                $_SESSION['time-message']=time();
                $_SESSION['message-danger']="Password yang kamu masukan terlalu pendek (Min: 8)!";
                header("Location: profile-settings");return false;
            }
            $password=password_hash($password1, PASSWORD_DEFAULT);
            mysqli_query($conn_back, "UPDATE users SET password='$password' WHERE id_user='$id_user'");
            return mysqli_affected_rows($conn_back);}
        function help_message($data){global $conn_back,$date,$id_user;
            $help_message=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $data['help-message']))));
            $tgl_cari=date('Y-m-d');
            mysqli_query($conn_back, "INSERT INTO users_help(id_user,help_message,date,tgl_cari) VALUES('$id_user','$help_message','$date','$tgl_cari')");
            return mysqli_affected_rows($conn_back);}
        // function __($data){global $conn_front,$conn_back;}
    }
    if($_SESSION['id-role']<=7){}
}