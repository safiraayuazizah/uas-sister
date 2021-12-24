<?php
require('top.inc.php');
isAdmin();
$username='';
$password='';
$email='';
$mobile='';
$alamat='';


$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from biodata where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$username=$row['username'];
		$email=$row['email'];
		$mobile=$row['mobile'];
		$alamat=$row['alamat'];
		
	}else{
		header('location:vendor_management.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$username=get_safe_value($con,$_POST['username']);
	$email=get_safe_value($con,$_POST['email']);
	$mobile=get_safe_value($con,$_POST['mobile']);
	$alamat=get_safe_value($con,$_POST['alamat']);
	
	$res=mysqli_query($con,"select * from biodata where username='$username'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Username already exist";
			}
		}else{
			$msg="Username already exist";
		}
	}
	
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$update_sql="update biodata set username='$username',alamat='$alamat',email='$email',mobile='$mobile', where id='$id'";
			mysqli_query($con,$update_sql);
		}else{
			mysqli_query($con,"insert into biodata(username,alamat,email,mobile,role,status) values('$username','$alamat','$email','$mobile',1,1)");
		}
		header('location:biodata.php');
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>BIODATA FORM</strong><small> </small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   
								
								<div class="form-group">
									<label for="username" class=" form-control-label">Username</label>
									<input type="text" name="username" placeholder="Enter username" class="form-control" required value="<?php echo $username?>">
								</div>
								
								
								<div class="form-group">
									<label for="password" class=" form-control-label">Email</label>
									<input type="email" name="email" placeholder="Enter email" class="form-control" required value="<?php echo $email?>">
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">No Telp</label>
									<input type="text" name="mobile" placeholder="Enter no tlp" class="form-control" required value="<?php echo $mobile?>">
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Alamat</label>
									<input type="text" name="alamat" placeholder="Enter alamat" class="form-control" required value="<?php echo $password?>">
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