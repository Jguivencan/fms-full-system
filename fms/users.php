<?php 

?>

<div class="container-fluid">
	
	<!-- <div class="row">
	<div class="col-lg-12">
			<button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button>
	</div>
	</div> -->
	
	<!-- <div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
				<table class="table-striped table-bordered col-md-12">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Name</th>
					<th class="text-center">Username</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					include 'db_connect.php';
 					$users = $conn->query("SELECT * FROM users order by name asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
				 <tr>
				 	<td>
				 		<?php echo $i++ ?>
				 	</td>
				 	<td>
				 		<?php echo $row['name'] ?>
				 	</td>
				 	<td>
				 		<?php echo $row['username'] ?>
				 	</td>
				 	<td>
				 		<center>
								<div class="btn-group">
								  <button type="button" class="btn btn-primary">Action</button>
								  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <div class="dropdown-menu">
								    <a class="dropdown-item edit_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Edit</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item delete_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete</a>
								  </div>
								</div>
								</center>
				 	</td>
				 </tr>
				<?php endwhile; ?>
			</tbody>
		</table>
			</div>
		</div>
	</div> -->

  	<link rel="stylesheet" href="./assets/css/users.css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
		<div class="container">
		<div class="row">
			<div class="col-sm-8 mx-auto">
				<div class="panel panel-white profile-widget">
					<div class="row">
						<div class="col-sm-12">
							<div class="image-container bg2" >  
								<img src="mycure-default-avatar.6f1fa23.png" class="avatar" alt="avatar" style="background:#fff"> 
							</div>
						</div>
						<div class="col-sm-12">
							<div class="details">
								<h4><?php echo $_SESSION['login_username']?><i class="fa fa-sheild"></i></h4>
								<div><?php echo $_SESSION['login_name']?></div>
								<!-- <div class="mg-top-10">
									<a href="#" class="btn btn-blue">Followers</a>
									<a href="#" class="btn btn-green">Following</a>
								</div> -->
							</div>
							
							Click to see <a href="index.php?page=terms" ><span class='icon-field'></span>Terms and Conditions</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<script>
	
$('#new_user').click(function(){
	uni_modal('New User','manage_user.php')
})
$('.edit_user').click(function(){
	uni_modal('Edit User','manage_user.php?id='+$(this).attr('data-id'))
})

</script>