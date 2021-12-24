<?php
require('top.inc.php');
isAdmin();
if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update pelaporan set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from pelaporan where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

$sql="select * from pelaporan order by id desc";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">PELAPORAN</h4>
				   <h4><a href="detail_pelaporan.php">Buat Laporan</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							 
							   <th width="2%">ID</th>
							   <th width="20%">Tanggal</th>
							   <th width="20%">Pemasukan</th>
							   <th width="20%">Pengeluaran</th>
							   <th width="20%">Nama Admin</th>
							   <th width="20%">Catatan Admin</th>
							   <th width="20%">Aksi</th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							 
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['tanggal']?></td>
							   <td><?php echo $row['pemasukan']?></td>
							   <td><?php echo $row['pengeluaran']?></td>
							   <td><?php echo $row['nama_admin']?></td>
							   <td><?php echo $row['catatan_admin']?></td>
							  
							   <td>
							    <?php
								if($row['status']==1){
									//echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
								}else{
									//echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
								}
								echo "<span class='badge badge-edit'><a href='detail_pelaporan.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
								
								?>
							   </td>
							</tr>
							<?php } ?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.inc.php');
?>