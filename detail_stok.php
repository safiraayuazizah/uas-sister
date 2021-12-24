<?php
require('top.inc.php');
isAdmin();
$nama_barang='';
$stok='';
$jenis_barang='';
$harga='';

$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from coupon_master where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$nama_barang=$row['nama_barang'];
		$stok=$row['stok'];
		$jenis_barang=$row['jenis_barang'];
		$harga=$row['harga'];
	}else{
		header('location:perekapan_stok.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$nama_barang=get_safe_value($con,$_POST['nama_barang']);
	$stok=get_safe_value($con,$_POST['stok']);
	$jenis_barang=get_safe_value($con,$_POST['jenis_barang']);
	$harga=get_safe_value($con,$_POST['harga']);
	
	$res=mysqli_query($con,"select * from coupon_master where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="STOK CODE ALREADY EXIST";
			}
		}else{
			$msg="STOK CODE ALREADY EXIST";
		}
	}
	
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$update_sql="update coupon_master set nama_barang='$nama_barang',stok='$stok',jenis_barang='$jenis_barang',harga='$harga' where id='$id'";
			mysqli_query($con,$update_sql);
		}else{
			mysqli_query($con,"insert into coupon_master(nama_barang,stok,jenis_barang,harga,status) values('$nama_barang','$stok','$jenis_barang','$harga',1)");
		}
		header('location:perekapan_stok.php');
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>PEREKAPAN STOK FORM</strong><small> </small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Nama Barang</label>
									<input type="text" name="nama_barang" placeholder="Enter nama barang" class="form-control" required value="<?php echo $nama_barang?>">
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Stok</label>
									<input type="text" name="stok" placeholder="Enter stok" class="form-control" required value="<?php echo $stok?>">
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Jenis Barang</label>
									<select class="form-control" name="jenis_barang" required>
                                    <option value="Makanan">Makanan</option>
                                    <option value="Minuman">Minuman</option>
                                    <option value="Sembako">Sembako</option>
                                   
                                    <option value="Lainnya">Lainnya</option>
									</select>
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Harga</label>
									<input type="text" name="harga" placeholder="Enter harga" class="form-control" required value="<?php echo $harga?>">
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