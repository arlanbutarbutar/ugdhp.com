<?php if(!isset($_SESSION)){session_start();}require_once('../Application/controller/connect.php');
    $today=date('Y-m-d');
    $news_reviews = mysqli_query($conn_back, "SELECT * FROM notes 
        JOIN notes_type ON notes.id_nota=notes_type.id_nota 
        JOIN users ON notes.id_user=users.id_user 
        JOIN category_services ON notes.id_layanan=category_services.id_category 
        JOIN notes_status ON notes.id_status=notes_status.id_status 
        WHERE tgl_cari='$today' ORDER BY id_data DESC
    ");
    if(isset($_POST['ubah-cepat-status'])){
        $id_data=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['id-data']))));
        $id_status=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn_back, $_POST['id-status']))));
        if($id_status==1){
            mysqli_query($conn_back, "UPDATE notes SET id_nota='1', id_status='1', tgl_status='$date', progress='10' WHERE id_data='$id_data'");
            return mysqli_affected_rows($conn_back);
        }else if($id_status==2){
            mysqli_query($conn_back, "UPDATE notes SET id_nota='4', id_status='2', tgl_status='$date', progress='0' WHERE id_data='$id_data'");
            return mysqli_affected_rows($conn_back);
        }else if($id_status==3){
            mysqli_query($conn_back, "UPDATE notes SET id_nota='1', id_status='3', tgl_status='$date', progress='50' WHERE id_data='$id_data'");
            return mysqli_affected_rows($conn_back);
        }else if($id_status==4){
            mysqli_query($conn_back, "UPDATE notes SET id_nota='1', id_status='4', tgl_status='$date', progress='75' WHERE id_data='$id_data'");
            return mysqli_affected_rows($conn_back);
        }else if($id_status==5){
            mysqli_query($conn_back, "UPDATE notes SET id_nota='3', id_status='5', tgl_status='$date', progress='95 WHERE id_data='$id_data'");
            return mysqli_affected_rows($conn_back);
        }else if($id_status==6){
            mysqli_query($conn_back, "UPDATE notes SET id_nota='5', id_status='6', tgl_lunas='$date', progress='100' tgl_status='$date' WHERE id_data='$id_data'");
            return mysqli_affected_rows($conn_back);
        }else if($id_status==7){
            mysqli_query($conn_back, "UPDATE notes SET id_nota='4', id_status='7', tgl_status='$date', progress='5' WHERE id_data='$id_data'");
            return mysqli_affected_rows($conn_back);}}
?>

<?php if (mysqli_num_rows($news_reviews) == 0) { ?>
    <div class="card shadow mb-3">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-start">
            <h6 class="m-0 font-weight-bold">Repair Data</h6>
        </div>
        <div class="card-body text-center">
            <p>
                Belum ada data yang dimasukkan.
            </p>
        </div>
    </div>
    <?php } else if (mysqli_num_rows($news_reviews) > 0) {
    while ($row = mysqli_fetch_assoc($news_reviews)) { ?>
        <div class="card shadow mb-3">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold"><?= "T" . $row['id_nota_tinggal'] . " | DP" . $row['id_nota_dp'] . " | L" . $row['id_nota_lunas'] ?></h6>
                <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#starHalf<?= $row['id_data']?>"><i class="fas fa-star-half-alt text-info"></i></button>
                <div class="modal fade" id="starHalf<?= $row['id_data']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <h4 class="modal-title" id="exampleModalLabel">Quick Status <i class="fas fa-space-shuttle text-info"></i></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="POST">
                                <div class="modal-body">
                                    <p>Kemudahan mengubah status perbaikan dengan cepat. Pilih status untuk perbaikan nota <?= "T" . $row['id_nota_tinggal'] . " | DP" . $row['id_nota_dp'] . " | L" . $row['id_nota_lunas'] ?><br><span class="badge bg-warning text-dark">Peringatan!!</span> Cek kembali data sebelum merubah status.</p>
                                    <div class="form-group">
                                        <select name="id-status" class="form-control">
                                            <option>Pilih Status</option>
                                            <?php if($row['id_status']==4){
                                                $notesStatusBost=mysqli_query($conn_back, "SELECT * FROM notes_status WHERE id_status=5");
                                            }else if($row['id_status']<=4){
                                                $notesStatusBost=mysqli_query($conn_back, "SELECT * FROM notes_status WHERE id_status<=4");
                                            }else if($row['id_status']==5){
                                                $notesStatusBost=mysqli_query($conn_back, "SELECT * FROM notes_status WHERE id_status=6");}
                                            foreach($notesStatusBost as $rowBost):?>
                                            <option value="<?= $rowBost['id_status']?>"><?= $rowBost['status']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer border-top-0 justify-content-center">
                                    <button type="button" class="btn btn-outline-dark btn-sm shadow" data-dismiss="modal">Keluar</button>
                                    <button type="submit" name="ubah-cepat-status" class="btn btn-dark btn-sm shadow"><i class="fas fa-pen"></i> Ubah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="small">
                    Perbaikan <?= $row['product'] ?> dengan kerusakan <?= $row['kerusakan'] ?> dan kondisi <?= $row['kondisi'] ?>. Kelengkapan dari <?= $row['product'] ?> <?php if (empty($row['kelengkapan']) || $row['kelengkapan'] == '-') { echo 'tidak ada'; } else { echo $row['kelengkapan']; } ?>. Perbaikan dikerjakan oleh <?php $id_tek = $row['id_pegawai']; $teknisi = mysqli_query($conn_back, "SELECT * FROM users WHERE id_user='$id_tek'"); $row_tek = mysqli_fetch_assoc($teknisi); echo $row_tek['first_name']; ?>
                </p>
                <div class="row no-gutters align-items-center">
                    <div class="col-lg-4">
                        <div class="h6 mb-0 mr-3 font-weight-bold">Progress:
                            <?php $id_barang = $row['id_barang'];
                            if ($row['id_layanan'] == 1) {
                                $handphone = mysqli_query($conn_back, "SELECT * FROM handphone WHERE id_hp='$id_barang'");
                                $row_hp = mysqli_fetch_assoc($handphone);
                                echo $row_hp['type'] . " (" . $row_hp['seri'] . " - " . $row_hp['imei'] . ")";
                            }
                            if ($row['id_layanan'] == 2) {
                                $laptop = mysqli_query($conn_back, "SELECT * FROM laptop WHERE id_laptop='$id_barang'");
                                $row_laptop = mysqli_fetch_assoc($laptop);
                                echo $row_laptop['merek'] . " (" . $row_laptop['seri'] . ")";
                            } ?>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="progress-wrapper">
                            <div class="progress-info">
                                <div class="progress-label">
                                    <span class="text-info"><?= $row['status']?></span>
                                </div>
                                <div class="progress-percentage">
                                    <span><?= $row['progress']?>%</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar <?php if($row['progress']<=10){echo "bg-danger";}else if($row['progress']>10 && $row['progress']<=75){echo "bg-warning";}else if($row['progress']>75){echo "bg-success";}?>" role="progressbar" style="width: <?= $row['progress'] . "%" ?>" aria-valuenow="<?= $row['progress'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php }} ?>