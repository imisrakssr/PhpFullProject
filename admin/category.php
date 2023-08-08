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

				<h6 class="mb-0 text-uppercase">Manage All Category</h6>
				<hr>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sl.</th>
										<th>Category Name</th>
										<th>Description</th>
										<th>Parent / Sub Category</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php

								$category_sql = "SELECT * FROM category WHERE is_parent = 0 AND status = '1' ORDER BY id DESC";
								$category_res = mysqli_query($db,$category_sql);
								$countData = mysqli_num_rows($category_res);
								

								if($countData == 0){
									echo '<div class="alert alert-info">Sorry! No data found into database.</div>';
								}
								else{
									$serial = 0;
									while ($row = mysqli_fetch_assoc($category_res)){
									$id          = $row['id'];
									$name        = $row['name'];
									$description = $row['description'];
									$is_parent   = $row['is_parent'];
									$status      = $row['status'];
									$serial++;
								
									?>

									<tr>
										<td><?php echo $serial; ?></td>
										<td><?php echo $name; ?></td>
										<td><?php echo $description; ?></td>
										<td>
											<?php
											if ($is_parent == 0){
												echo '<div class="badge bg-warning">Parent Category</div>';
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
										<td>
											<div class="action-bar">
												<ul>
													<li>
														<a href="category.php?do=Edit&id=<?php echo $id; ?>" data-bs-toggle="tooltip" title="Edit"><i class="bx bx-pencil"></i></a>
													</li>
													<li>
														<a href="" data-bs-toggle="modal" title="Delete"data-bs-target="#deleteCategory<?php echo $id; ?>"><i class="bx bx-trash"></i></a>
													</li>
											    </ul>
											</div>
											
										</td>
									</tr>
									<!-- Modal -->
									<div class="modal fade" id="deleteCategory<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLabel">Move the category into trash?</h5>
									        
									      </div>
									      <div class="modal-body">
									        <div class="modal-action">
									        	<ul>
									        		<li>
									        			<a href="category.php?do=Trash&id=<?php echo $id; ?>" class="btn btn-danger">Yes</a>
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

									//checking if there is any sub-categoris exist

								$category_sql2 = "SELECT * FROM category WHERE is_parent = '$id' AND status = '1' ORDER BY id DESC";
								$category_res2 = mysqli_query($db,$category_sql2);

								while ($row = mysqli_fetch_assoc($category_res2)){
									$id    = $row['id'];
									$name        = $row['name'];
									$description = $row['description'];
									$is_parent   = $row['is_parent'];
									$status      = $row['status'];
									$serial++;

									?>

									<tr>
										<td><?php echo $serial; ?></td>
										<td>--<?php echo $name; ?></td>
										<td><?php echo $description; ?></td>
										<td>
											<?php
											if ($is_parent == 0){
												echo '<div class="badge bg-warning">Parent Category</div>';
											}
											else{
												echo '<div class="badge bg-dark">Child Category</div>';
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
										<td>
											<div class="action-bar">
												<ul>
													<li>
														<a href="category.php?do=Edit&id=<?php echo $id; ?>" data-bs-toggle="tooltip" title="Edit"><i class="bx bx-pencil"></i></a>
													</li>
													<li>
														<a href="" data-bs-toggle="modal" title="Delete"data-bs-target="#deleteCategory<?php echo $id; ?>"><i class="bx bx-trash"></i></a>
													</li>
											    </ul>
											</div>
											
										</td>
									</tr>
									<!-- Modal -->
									<div class="modal fade" id="deleteCategory<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLabel">Move the category into trash?</h5>
									        
									      </div>
									      <div class="modal-body">
									        <div class="modal-action">
									        	<ul>
									        		<li>
									        			<a href="category.php?do=Trash&id=<?php echo $id; ?>" class="btn btn-danger">Yes</a>
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
								} //while loop ends

								} //First while loop ends

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

				<h6 class="mb-0 text-uppercase">Add Category</h6>
				<hr>
				<div class="card">
					<div class="card-body">

						<form action="category.php?do=Store" method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-4">

								<div class="mb-3">
									<label class="mb-2">Category Name</label>
									<input type="name" name="name" placeholder="Enter Name" class="form-control" autocomplete="off" autofocus required>
								</div>
								<div class="mb-3">
									<label class="mb-2">Select the parent category [If Any]</label>
									<select class="form-select" name="is_parent">
										<option> Please Select Parent Category</option>
										<?php

										$sql = "SELECT * FROM category WHERE is_parent = 0 AND status = 1 ORDER BY name ASC";
										$pcat = mysqli_query($db,$sql);
										while ($row = mysqli_fetch_assoc($pcat)){
											$pid  = $row['id'];
											$pname = $row['name'];
											?>
											<option value="<?php echo $pid; ?>"><?php echo $pname; ?></option>
											<?php
										}

										?>
									</select>
								<div class="mb-3">
									<label class="mb-2">Status</label>
									<select class="form-select" name="status">
										<option> Please Select Account Status</option>
										<option value="1">Active</option>
										<option value="2">Inactive</option>
									</select>
								</div>

								</div>

								</div>
								<div class="col-lg-4">

								<div class="mb-3">
									<textarea class="form-control" rows="5" name="description"></textarea>
								</div>
									
								</div>
								<div class="col-lg-4">

								<div class="mb-3">
									<input type="submit" name="addCategory" class="btn btn-primary" value="Add New Category">
								</div>

								</div>
							</div>
						</form>

					</div>
				</div>

				<?php
			}
			else if ($do == 'Store'){
				if(isset($_POST['addCategory'])){
					$name        = $_POST['name']; 
					$description = $_POST['description'];
					$is_parent   = mysqli_real_escape_string($db, $_POST['is_parent']);
					$status      = mysqli_real_escape_string($db, $_POST['status']);

					
					if($password == $password_confirm){

						$add_category_sql = "INSERT INTO category (name, description, is_parent, status) VALUES ('$name','$description','$is_parent','$status')";
						$add_category_res = mysqli_query($db,$add_category_sql);
						if($add_category_res){
							header("Location: category.php?do=Manage");
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

					$category_sql = "SELECT * FROM category WHERE id = '$editID'";
					$category_res = mysqli_query($db,$category_sql);

					while ($row = mysqli_fetch_assoc($category_res)){
					$id          = $row['id'];
					$name        = $row['name'];
					$description = $row['description'];
					$is_parent   = $row['is_parent'];
					$status      = $row['status'];
					?>

					<h6 class="mb-0 text-uppercase">Update Category Information</h6>
					<hr>
					<div class="card">
						<div class="card-body">

							<form action="category.php?do=Update" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="editID" value="<?php echo $id; ?>"><div class="row">
								<div class="col-lg-4">

								<div class="mb-3">
									<label class="mb-2">Category Name</label>
									<input type="name" name="name" value="<?php echo $name; ?>" class="form-control" autocomplete="off" autofocus required>
								</div>
								<div class="mb-3">
									<label class="mb-2">Select the parent category [If Any]</label>
									<select class="form-select" name="is_parent">
										<option value="0"> Please Select Parent Category [If Any]</option>
										<?php

										$sql = "SELECT * FROM category WHERE is_parent = 0 AND status = 1 ORDER BY name ASC";
										$pcat = mysqli_query($db,$sql);
										while ($row = mysqli_fetch_assoc($pcat)){
											$pid  = $row['id'];
											$pname = $row['name'];
											?>
											<option value="<?php echo $pid; ?>"<?php if($pid == $is_parent){ echo 'selected';} ?>>
												<?php echo $pname; ?>
											</option>
											<?php
										}

										?>
									</select>
								<div class="mb-3">
										<label class="mb-2">Status</label>
										<select class="form-select" name="status">
											<option> Please Select Category Status</option>
											<option value="1"<?php if($status == 1){
												echo 'selected';}?>>Active</option>
											<option value="2"<?php if($status == 2){
												echo 'selected';}?>>Inactive</option>
										</select>
									</div>

								</div>

								</div>
								<div class="col-lg-4">

								<div class="mb-3">
									<textarea class="form-control" rows="5" name="description"><?php echo $description; ?></textarea>
								</div>
									
								</div>
								<div class="col-lg-4">

								<div class="mb-3">
									<input type="submit" name="updateCategory" class="btn btn-primary" value="Update Category">
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
				if(isset($_POST['updateCategory'])){

				$editID      = $_POST['editID']; 
				$name        = $_POST['name']; 
				$description = $_POST['description'];
				$is_parent   = mysqli_real_escape_string($db, $_POST['is_parent']);
				$status      = mysqli_real_escape_string($db, $_POST['status']);

					$edit_category_sql = "UPDATE category SET name='$name', description='$description',is_parent='$is_parent',status='$status' WHERE id = '$editID'";
					$edit_category_res = mysqli_query($db,$edit_category_sql);

						if($edit_category_res){
							header("Location: category.php?do=Manage");
						}
						else{
							die("MySQL Error. " . mysqli_error($db));
						}
				}
			}
			else if ($do == 'Trash'){
				if(isset($_GET['id'])){
					$trashID = $_GET['id'];

					$sql = "UPDATE category SET status ='2' WHERE id= '$trashID'";
					$trashData = mysqli_query($db,$sql);

					if($trashData){
							header("Location: category.php?do=Manage");
						}
						else{
							die("MySQL Error. " . mysqli_error($db));
						}
				}
			}
			else if ($do == 'ManageTrash'){
				?>

				<h6 class="mb-0 text-uppercase">Deleted Categories</h6>
				<hr>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sl.</th>
										<th>Category Name</th>
										<th>Description</th>
										<th>Parent / Sub Category</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php

								$category_sql = "SELECT * FROM category WHERE status = '2' ORDER BY id DESC";
								$category_res = mysqli_query($db,$category_sql);
								$countData = mysqli_num_rows($category_res);
								

								if($countData == 0){
									echo '<div class="alert alert-info">Sorry! No data found into database.</div>';
								}
								else{
									$serial = 0;
									while ($row = mysqli_fetch_assoc($category_res)){
									$id          = $row['id'];
									$name        = $row['name'];
									$description = $row['description'];
									$is_parent   = $row['is_parent'];
									$status      = $row['status'];
									$serial++;
								
									?>

									<tr>
										<td><?php echo $serial; ?></td>
										<td><?php echo $name; ?></td>
										<td><?php echo $description; ?></td>
										<td>
											<?php
											if ($is_parent == 0){
												echo '<div class="badge bg-warning">Parent Category</div>';
											}
											else{
												echo '<div class="badge bg-dark">Child Category</div>';
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
										<td>
											<div class="action-bar">
												<ul>
													<li>
														<a href="category.php?do=Edit&id=<?php echo $id; ?>" data-bs-toggle="tooltip" title="Edit"><i class="bx bx-pencil"></i></a>
													</li>
													<li>
														<a href="" data-bs-toggle="modal" title="Delete"data-bs-target="#deleteCategory<?php echo $id; ?>"><i class="bx bx-trash"></i></a>
													</li>
											    </ul>
											</div>
											
										</td>
									</tr>
									<!-- Modal -->
									<div class="modal fade" id="deleteCategory<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLabel">Delete this category permanently?</h5>
									        
									      </div>
									      <div class="modal-body">
									        <div class="modal-action">
									        	<ul>
									        		<li>
									        			<a href="category.php?do=Delete&id=<?php echo $id; ?>" class="btn btn-danger">Yes</a>
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

					$sql = "DELETE FROM category WHERE id= '$deleteID'";
					$deleteData = mysqli_query($db,$sql);

					if($deleteData){
							header("Location: category.php?do=Manage");
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