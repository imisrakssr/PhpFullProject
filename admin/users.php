<?php include "inc/header.php"; ?>
<div class="page-content">

	<div class="row row-cols-1 row-cols-md-12 row-cols-xl-12">
		<?php

		// if(isset($_GET['do'])){
		// 	$do = $_GET['do'];
		// }
		// else{
		// 	$do = 'Mange';
		// }

		//Ternary Condition
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage'; 

			if ($do == 'Manage'){
				?>

				<h6 class="mb-0 text-uppercase">Manage All Users</h6>
				<hr>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sl.</th>
										<th>Image</th>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Address</th>
										<th>Role</th>
										<th>Status</th>
										<th>Join Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php

								$user_sql = "SELECT * FROM users WHERE status = '1' ORDER BY id DESC";
								$user_res = mysqli_query($db,$user_sql);
								$countData = mysqli_num_rows($user_res);
								

								if($countData == 0){
									echo '<div class="alert alert-info">Sorry! No data found into database.</div>';
								}
								else{
									$serial = 0;
									while ($row = mysqli_fetch_assoc($user_res)){
									$id        = $row['id'];
									$name      = $row['name'];
									$email     = $row['email'];
									$password  = $row['password'];
									$phone     = $row['phone'];
									$address   = $row['address'];
									$role      = $row['role'];
									$status    = $row['status'];
									$image     = $row['image'];
									$join_date = $row['join_date'];
									$serial++;
								
									?>

									<tr>
										<td><?php echo $serial; ?></td>
										<td>
											<?php

											if(!empty($image)){
												echo '<img src ="assets/images/users/'.$image.'" style="width:40px;">';
											}
											else{
												echo '<img src ="assets/images/users/default.png" style="width:40px;">';
											}

											?>
										</td>
										<td><?php echo $name; ?></td>
										<td><?php echo $email; ?></td>
										<td><?php echo $phone; ?></td>
										<td><?php echo $address; ?></td>
										<td>
										<?php
											if ($role == 1){
												echo '<div class="badge bg-info">Admin</div>';
											}
											else if ($role == 2){
												echo '<div class="badge bg-primary">User</div>';
											}
										?>
										</td>
										<td>
										<?php
											if ($status == 1){
												echo '<div class="badge bg-success">Active</div>';
											}
											else if ($status == 2){
												echo '<div class="badge bg-danger">Inactive</div>';
											}
										?>
										</td>
										<td><?php echo $join_date; ?></td>
										<td>
											<div class="action-bar">
												<ul>
													<li>
														<a href="users.php?do=Edit&id=<?php echo $id; ?>" data-bs-toggle="tooltip" title="Edit"><i class="bx bx-pencil"></i></a>
													</li>
													<li>
														<a href="" data-bs-toggle="modal" title="Delete"data-bs-target="#delete<?php echo $id; ?>"><i class="bx bx-trash"></i></a>
													</li>
											    </ul>
											</div>
											
										</td>
									</tr>
				<!-- Modal -->
				<div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Move the user into trash?</h5>
				        
				      </div>
				      <div class="modal-body">
				        <div class="modal-action">
				        	<ul>
				        		<li>
				        			<a href="users.php?do=Trash&id=<?php echo $id; ?>" class="btn btn-danger">Yes</a>
				        		</li>
				        		<li>
				        			<a href="" class="btn btn-success" data-bs-dismiss="modal">No</a>
				        		</li>
				        	</ul>
				        </div>
				      </div>
				      
				    </div>
				  </div>
				</div>


									<?php
								}

								}

								?>
								
									

							</table>
						</div>
					</div>
				</div>


				<?php
			}
			else if ($do == 'Add'){
				?>

				<h6 class="mb-0 text-uppercase">Add User</h6>
				<hr>
				<div class="card">
					<div class="card-body">

						<form action="users.php?do=Store" method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-4">

								<div class="mb-3">
									<label class="mb-2">Full Name</label>
									<input type="name" name="name" placeholder="Enter Name" class="form-control" autocomplete="off" autofocus required>
								</div>
								<div class="mb-3">
									<label class="mb-2">Email Address</label>
									<input type="email" name="email" placeholder="Enter Email" class="form-control" autocomplete="off" autofocus required>
								</div>
								<div class="mb-3">
									<label class="mb-2">Password</label>
									<input type="password" name="password" placeholder="Enter Password" class="form-control" autocomplete="off" autofocus required>
								</div>
								<div class="mb-3">
									<label class="mb-2">Re-type Password</label>
									<input type="password" name="password_confirm" placeholder="Enter Password Again" class="form-control" autocomplete="off" autofocus required>
								</div>

								</div>
								<div class="col-lg-4">

								<div class="mb-3">
									<label class="mb-2">Phone</label>
									<input type="text" name="phone" placeholder="Enter Phone Number" class="form-control" autocomplete="off" autofocus>
								</div>
								<div class="mb-3">
									<label class="mb-2">Address</label>
									<input type="text" name="address" placeholder="Enter Address" class="form-control" autocomplete="off" autofocus>
								</div>
								<div class="mb-3">
									<label class="mb-2">Role</label>
									<select class="form-select" name="role">
										<option> Please Select User Role</option>
										<option value="1">Admin</option>
										<option value="2">User</option>
									</select>
								</div>
								<div class="mb-3">
									<label class="mb-2">Status</label>
									<select class="form-select" name="status">
										<option> Please Select Account Status</option>
										<option value="1">Active</option>
										<option value="2">Inactive</option>
									</select>
								</div>
									
								</div>
								<div class="col-lg-4">

								<div class="mb-3">
									<label class="mb-2">Image</label>
									<input type="file" name="image" class="form-control">
								</div>
								<div class="mb-3">
									<input type="submit" name="addUser" class="btn btn-primary" value="Add New User">
								</div>

								</div>
							</div>
						</form>

					</div>
				</div>

				<?php
			}
			else if ($do == 'Store'){
				if(isset($_POST['addUser'])){
					$name             = mysqli_real_escape_string($db, $_POST['name']); 
					$email            = mysqli_real_escape_string($db, $_POST['email']); 
					$password         = mysqli_real_escape_string($db, $_POST['password']); 
					$password_confirm = mysqli_real_escape_string($db, $_POST['password_confirm']); 
					$phone            = mysqli_real_escape_string($db, $_POST['phone']); 
					$address          = mysqli_real_escape_string($db, $_POST['address']);
					$role             = mysqli_real_escape_string($db, $_POST['role']); 
					$status           = mysqli_real_escape_string($db, $_POST['status']);

					//for image
					$image   = $_FILES['image']['name'];
					$img_tmp = $_FILES['image']['tmp_name'];

					if($password == $password_confirm){
						$hassedPass = sha1($password);

						if(!empty($image)){
						$img = rand(1, 9999999).'-'.$image;
						move_uploaded_file($img_tmp, "assets/images/users/" . $img);
						}
						else{
							$img = '';
						}

						$add_user_sql = "INSERT INTO users (name, email, password, phone,address, role, status, image, join_date) VALUES ('$name','$email','$hassedPass','$phone','$address','$role','$status','$img',now())";
						$add_user_res = mysqli_query($db,$add_user_sql);
						if($add_user_res){
							header("Location: users.php?do=Manage");
						}
						else{
							die("MySQL Error. " . mysqli_error($db));
						}
					}
					else{
						echo "Password did not match";
					} 
				}
			}
			else if ($do == 'Edit'){

				if(isset($_GET['id'])){
					$editID = $_GET['id'];

					$user_sql = "SELECT * FROM users WHERE id = '$editID'";
					$user_res = mysqli_query($db,$user_sql);

					while ($row = mysqli_fetch_assoc($user_res)){
					$id        = $row['id'];
					$name      = $row['name'];
					$email     = $row['email'];
					$password  = $row['password'];
					$phone     = $row['phone'];
					$address   = $row['address'];
					$role      = $row['role'];
					$status    = $row['status'];
					$image     = $row['image'];
					?>

					<h6 class="mb-0 text-uppercase">Update User Information</h6>
					<hr>
					<div class="card">
						<div class="card-body">

							<form action="users.php?do=Update" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="editID" value="<?php echo $id; ?>">
								<div class="row">
									<div class="col-lg-4">

									<div class="mb-3">
										<label class="mb-2">Full Name</label>
										<input type="name" name="name" value="<?php echo $name; ?>" class="form-control" autocomplete="off" autofocus required>
									</div>
									<div class="mb-3">
										<label class="mb-2">Email Address</label>
										<input type="email" name="email" value="<?php echo $email; ?>" class="form-control" autocomplete="off" autofocus required>
									</div>
									<div class="mb-3">
										<label class="mb-2">Password</label>
										<input type="password" name="password" placeholder="(Unchanged)" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="mb-3">
										<label class="mb-2">Re-type Password</label>
										<input type="password" name="password_confirm" placeholder="(Unchanged)" class="form-control" autocomplete="off" autofocus>
									</div>

									</div>
									<div class="col-lg-4">

									<div class="mb-3">
										<label class="mb-2">Phone</label>
										<input type="text" name="phone" value="<?php echo $phone; ?>" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="mb-3">
										<label class="mb-2">Address</label>
										<input type="text" name="address" value="<?php echo $address; ?>" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="mb-3">
										<label class="mb-2">Role</label>
										<select class="form-select" name="role">
											<option> Please Select User Role</option>
											<option value="1"<?php if($role == 1){
												echo 'selected';}?>>Admin</option>
											<option value="2"<?php if($role == 2){
												echo 'selected';}?>>User</option>
										</select>
									</div>
									<div class="mb-3">
										<label class="mb-2">Status</label>
										<select class="form-select" name="status">
											<option> Please Select Account Status</option>
											<option value="1"<?php if($status == 1){
												echo 'selected';}?>>Active</option>
											<option value="2"<?php if($status == 2){
												echo 'selected';}?>>Inactive</option>
										</select>
									</div>
										
									</div>
									<div class="col-lg-4">

									<div class="mb-3">
										<label class="mb-2">Image</label>
										<input type="file" name="image" class="form-control">
									</div>
									<div class="mb-3">
										<input type="submit" name="editUser" class="btn btn-primary" value="Update User">
									</div>

									</div>
								</div>
							</form>

						</div>
					</div>

					<?php
				}
				}
			}
			else if ($do == 'Update'){
				if(isset($_POST['editUser'])){

				$editID           = mysqli_real_escape_string($db, $_POST['editID']); 
				$name             = mysqli_real_escape_string($db, $_POST['name']); 
				$email            = mysqli_real_escape_string($db, $_POST['email']); 
				$password         = mysqli_real_escape_string($db, $_POST['password']); 
				$password_confirm = mysqli_real_escape_string($db, $_POST['password_confirm']); 
				$phone            = mysqli_real_escape_string($db, $_POST['phone']); 
				$address          = mysqli_real_escape_string($db, $_POST['address']);
				$role             = mysqli_real_escape_string($db, $_POST['role']); 
				$status           = mysqli_real_escape_string($db, $_POST['status']);

				//for image
				$image   = $_FILES['image']['name'];
				$img_tmp = $_FILES['image']['tmp_name'];

				if(!empty($password)){

					if($password == $password_confirm){
					$hassedPass = sha1($password);

					if(!empty($image)){
						$img = rand(1, 9999999).'--'.$image;
						move_uploaded_file($img_tmp, "assets/images/users/" . $img);
						}
					else{
						$img = '';
					}

					$edit_user_sql = "UPDATE users SET name='$name', email='$email',password='$hassedPass',phone='$phone',address='$address',role='$role',status='$status',image='$img' WHERE id = '$editID'";
					$edit_user_res = mysqli_query($db,$edit_user_sql);

						if($edit_user_res){
							header("Location: users.php?do=Manage");
						}
						else{
							die("MySQL Error. " . mysqli_error($db));
						}
				}
				else{
					echo "Password did not match";
				}
				}
				else{
					//without pass
					$edit_user_sql = "UPDATE users SET name='$name', email='$email',phone='$phone',address='$address',role='$role',status='$status',image='$img' WHERE id = '$editID'";
					$edit_user_res = mysqli_query($db,$edit_user_sql);

						if($edit_user_res){
							header("Location: users.php?do=Manage");
						}
						else{
							die("MySQL Error. " . mysqli_error($db));
						}

				}


				}
			}
			else if ($do == 'Trash'){
				if(isset($_GET['id'])){
					$trashID = $_GET['id'];

					$sql = "UPDATE users SET status ='2' WHERE id= '$trashID'";
					$trashData = mysqli_query($db,$sql);

					if($trashData){
							header("Location: users.php?do=Manage");
						}
						else{
							die("MySQL Error. " . mysqli_error($db));
						}
				}
			}
			else if ($do == 'ManageTrash'){
				?>

				<h6 class="mb-0 text-uppercase">Deleted Users</h6>
				<hr>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sl.</th>
										<th>Image</th>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Address</th>
										<th>Role</th>
										<th>Status</th>
										<th>Join Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php

								$user_sql = "SELECT * FROM users WHERE status = '2' ORDER BY id DESC";
								$user_res = mysqli_query($db,$user_sql);
								$countData = mysqli_num_rows($user_res);
								

								if($countData == 0){
									echo '<div class="alert alert-info">Sorry! No data found into database.</div>';
								}
								else{
									$serial = 0;
									while ($row = mysqli_fetch_assoc($user_res)){
									$id        = $row['id'];
									$name      = $row['name'];
									$email     = $row['email'];
									$password  = $row['password'];
									$phone     = $row['phone'];
									$address   = $row['address'];
									$role      = $row['role'];
									$status    = $row['status'];
									$image     = $row['image'];
									$join_date = $row['join_date'];
									$serial++;
								
									?>

									<tr>
										<td><?php echo $serial; ?></td>
										<td>
											<?php

											if(!empty($image)){
												echo '<img src ="assets/images/users/'.$image.'" style="width:40px;">';
											}
											else{
												echo '<img src ="assets/images/users/default.png" style="width:40px;">';
											}

											?>
										</td>
										<td><?php echo $name; ?></td>
										<td><?php echo $email; ?></td>
										<td><?php echo $phone; ?></td>
										<td><?php echo $address; ?></td>
										<td>
										<?php
											if ($role == 1){
												echo '<div class="badge bg-info">Admin</div>';
											}
											else if ($role == 2){
												echo '<div class="badge bg-primary">User</div>';
											}
										?>
										</td>
										<td>
										<?php
											if ($status == 1){
												echo '<div class="badge bg-success">Active</div>';
											}
											else if ($status == 2){
												echo '<div class="badge bg-danger">Inactive</div>';
											}
										?>
										</td>
										<td><?php echo $join_date; ?></td>
										<td>
											<div class="action-bar">
												<ul>
													<li>
														<a href="users.php?do=Edit&id=<?php echo $id; ?>" data-bs-toggle="tooltip" title="Edit"><i class="bx bx-pencil"></i></a>
													</li>
													<li>
														<a href="" data-bs-toggle="modal" title="Delete"data-bs-target="#delete<?php echo $id; ?>"><i class="bx bx-trash"></i></a>
													</li>
											    </ul>
											</div>
											
										</td>
									</tr>
									<!-- Modal -->
									<div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLabel">Delete this user permanently?</h5>
									        
									      </div>
									      <div class="modal-body">
									        <div class="modal-action">
									        	<ul>
									        		<li>
									        			<a href="users.php?do=Delete&id=<?php echo $id; ?>" class="btn btn-danger">Yes</a>
									        		</li>
									        		<li>
									        			<a href="" class="btn btn-success" data-bs-dismiss="modal">No</a>
									        		</li>
									        	</ul>
									        </div>
									      </div>
									      
									    </div>
									  </div>
									</div>


									<?php
								}

								}

								?>
								
									

							</table>
						</div>
					</div>
				</div>


				<?php
			}
			else if ($do == 'Delete'){
				if(isset($_GET['id'])){
					$deleteID = $_GET['id'];

					$sql = "DELETE FROM users WHERE id= '$deleteID'";
					$deleteData = mysqli_query($db,$sql);

					if($deleteData){
							header("Location: users.php?do=Manage");
						}
						else{
							die("MySQL Error. " . mysqli_error($db));
						}
				}	
			}
			else{
				echo '<div class="alert alert-warning">404 Page not found!
				Sorry, you are trying to access wrong URL.</div>';	
			}
		
			
		?>
	</div><!--end row-->
</div>
<?php include "inc/footer.php"; ?>		