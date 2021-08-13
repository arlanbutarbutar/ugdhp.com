<?php
    require_once('Application/controller/script.php');
    if(isset($_GET['keyword-hp'])&&$_GET['keyword-hp']!=""){
        $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_GET['keyword-hp']))));
        $query="SELECT * FROM notes 
            JOIN users ON notes.id_user=users.id_user
            JOIN notes_status ON notes.id_status=notes_status.id_status
            WHERE notes.id_nota_tinggal LIKE '%$keyword%'
            AND notes.id_status<6
            AND notes.id_layanan=1
            ORDER BY notes.id_data ASC LIMIT 1";
        $hp_search=mysqli_query($conn_back, $query);
        if(mysqli_num_rows($hp_search)>0){
            $row=mysqli_fetch_assoc($hp_search);
            if($row['id_status']<6){
                echo "<div class='card card-body border-0 shadow mt-3 mb-5'>
                    <h4>Handphone kamu!</h4>
                    <p>dengan nomor Nota ". $keyword .", saat ini handphone anda berstatus <strong>". $row['status'] ."</strong>. Jika sudah Finish anda sudah bisa mengambil handphone anda.</p>
                </div>";}}else{
                    echo "<div class='card card-body border-0 shadow mt-3 mb-5'>
                        <h4>Handphone kamu!</h4>
                        <p>Tidak dapat mencari, kemungkinan anda salah memasukan data atau nomor nota sudah tidak berlaku.</p>
                    </div>";}}
    if(isset($_GET['keyword-laptop'])&&$_GET['keyword-laptop']!=""){
        $keyword=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_GET['keyword-laptop']))));
        $query="SELECT * FROM notes 
            JOIN users ON notes.id_user=users.id_user
            JOIN notes_status ON notes.id_status=notes_status.id_status
            WHERE notes.id_nota_tinggal LIKE '%$keyword%'
            AND notes.id_status<6
            AND notes.id_layanan=2
            ORDER BY notes.id_data ASC LIMIT 1";
        $laptop_search=mysqli_query($conn_back, $query);
        $row=mysqli_fetch_assoc($laptop_search);
        if(mysqli_num_rows($laptop_search)>0){
            if($row['id_status']<6){
                echo "<div class='card card-body border-0 shadow mt-3 mb-5'>
                    <h4>Laptop kamu!</h4>
                    <p>dengan nomor Nota ". $keyword .", saat ini laptop anda berstatus <strong>". $row['status'] ."</strong>. Jika sudah Finish anda sudah bisa mengambil laptop anda.</p>
                </div>";}}else{
                    echo "<div class='card card-body border-0 shadow mt-3 mb-5'>
                        <h4>Laptop kamu!</h4>
                        <p>Tidak dapat mencari, kemungkinan anda salah memasukan data atau nomor nota sudah tidak berlaku.</p>
                    </div>";}}
?>