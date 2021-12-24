<?php
require('top.inc.php');
isAdmin();
$tanggal='';
$pemasukan='';
$pengeluaran='';
$nama_admin='';
$catatan_admin='';

$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from pelaporan where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$tanggal=$row['tanggal'];
		$pemasukan=$row['pemasukan'];
		$pengeluaran=$row['pengeluaran'];
		$nama_admin=$row['nama_admin'];
		$catatan_admin=$row['catatan_admin'];
	}else{
		header('location:pelaporan.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$tanggal=get_safe_value($con,$_POST['tanggal']);
	$pemasukan=get_safe_value($con,$_POST['pemasukan']);
	$pengeluaran=get_safe_value($con,$_POST['pengeluaran']);
	$nama_admin=get_safe_value($con,$_POST['nama_admin']);
	$catatan_admin=get_safe_value($con,$_POST['catatan_admin']);
	
	$res=mysqli_query($con,"select * from pelaporan where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="PELAPORAN CODE ALREADY EXIST";
			}
		}else{
			$msg="PELAPORAN CODE ALREADY EXIST";
		}
	}
	
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$update_sql="update pelaporan set tanggal='$tanggal',pemasukan='$pemasukan',pengeluaran='$pengeluaran',nama_admin='$nama_admin',catatan_admin='$catatan_admin' where id='$id'";
			mysqli_query($con,$update_sql);
		}else{
			mysqli_query($con,"insert into pelaporan(tanggal,pemasukan,pengeluaran,nama_admin,catatan_admin,status) values('$tanggal','$pemasukan','$pengeluaran','$nama_admin','$catatan_admin',1)");
		}
		header('location:pelaporan.php');
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>PELAPORAN FORM</strong><small> </small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Tanggal</label>
									<input type="text" name="tanggal" placeholder="Enter tanggal" class="form-control" required value="<?php echo $tanggal?>">
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Pemasukan</label>
									<input type="text" name="pemasukan" placeholder="Enter pemasukan" class="form-control" required value="<?php echo $pemasukan?>">
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Pengeluaran</label>
									<input type="text" name="pengeluaran" placeholder="Enter pengeluaran" class="form-control" required value="<?php echo $pengeluaran?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Nama Admin</label>
									<input type="text" name="nama_admin" placeholder="Enter nama admin" class="form-control" required value="<?php echo $nama_admin?>">
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Catatan Admin</label>
									<input type="text" name="catatan_admin" placeholder="Enter catatan admin" class="form-control" required value="<?php echo $catatan_admin?>">
								</div>
								
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Simpan</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
		 
		 
         
<?php
require('footer.inc.php');
?>