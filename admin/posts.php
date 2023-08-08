<?php include "inc/header.php"; ?>
<div class="page-content">

	<div class="row row-cols-1 row-cols-md-12 row-cols-xl-12">
		<?php

		//Ternary Condition
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage'; 

			if ($do == 'Manage'){
				?>

				<h6 class="mb-0 text-uppercase">Manage All Posts</h6>
				<hr>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sl.</th>
										<th>Image</th>
										<th>Title</th>
										<th>Category</th>
										<th>Author</th>
										<th>Tags</th>
										<th>Status</th>
										<th>Post Date</th>
										<th>Action</th>
										

									</tr>
								</thead>
								<tbody>
								<?php

								$post_sql = "SELECT * FROM post WHERE status = '1' ORDER BY id DESC";
								$post_res = mysqli_query($db,$post_sql);
								$countData = mysqli_num_rows($post_res);
								

								if($countData == 0){
									echo '<div class="alert alert-info">Sorry! No post found into database.</div>';
								}
								else{
									$serial = 0;
									while ($row = mysqli_fetch_assoc($post_res)){
									$id          = $row['id'];
									$title       = $row['title'];
									$description = $row['description'];
									$image 		 = $row['image'];
									$category_id = $row['category_id'];
									$author_id   = $row['author_id'];
									$tags      	 = $row['tags'];
									$status    	 = $row['status'];
									$post_date 	 = $row['post_date'];
									$serial++;
								
									?>

									<tr>
										<td><?php echo $serial; ?></td>
										<td>
											<?php

											if(!empty($image)){
												echo '<img src ="assets/images/posts/'.$image.'" style="width:40px;">';
											}
											else{
												echo '<img src ="assets/images/posts/default.png" style="width:40px;">';
											}

											?>
										</td>
										<td><?php echo $title; ?></td>
										<td>

											<?php
											$sqlCat = "SELECT * FROM category WHERE id = '$category_id'";
											$catData = mysqli_query($db,$sqlCat);
											while($row = mysqli_fetch_assoc($catData)){

												$cat_id   = $row['id'];
												$cat_name = $row['name'];

												echo $cat_name;
											}
											?>
												
										</td>
										<td>
											<?php
											$sqlAuth = "SELECT * FROM users WHERE id = '$author_id'";
											$AuthData = mysqli_query($db,$sqlAuth);
											while($row = mysqli_fetch_assoc($AuthData)){

												$auth_id   = $row['id'];
												$auth_name = $row['name'];

												echo $auth_name;
											}
											?>
										</td>
										<td><?php echo $tags; ?></td>
										<td>
										<?php
											if ($status == 1){
												echo '<div class="badge bg-success">Active</div>';
											}
											else if ($status == 0){
												echo '<div class="badge bg-danger">Inactive</div>';
											}
										?>
										</td>
										<td><?php echo $post_date; ?></td>
										<td>
											<div class="action-bar">
												<ul>
													<li>
														<a href="posts.php?do=Edit&id=<?php echo $id; ?>" data-bs-toggle="tooltip" title="Edit"><i class="bx bx-pencil"></i></a>
													</li>
													<li>
														<a href="" data-bs-toggle="modal" title="Delete"data-bs-target="#deletePost<?php echo $id; ?>"><i class="bx bx-trash"></i></a>
													</li>
											    </ul>
											</div>
											
										</td>
									</tr>
														<!-- Modal -->
														<div class="modal fade" id="deletePost<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
														  <div class="modal-dialog">
														    <div class="modal-content">
														      <div class="modal-header">
														        <h5 class="modal-title" id="exampleModalLabel">Move the post into trash?</h5>
														        
														      </div>
														      <div class="modal-body">
														        <div class="modal-action">
														        	<ul>
														        		<li>
														        			<a href="posts.php?do=Trash&id=<?php echo $id; ?>" class="btn btn-danger">Yes</a>
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

				<h6 class="mb-0 text-uppercase">Add post</h6>
				<hr>
				<div class="card">
					<div class="card-body">

						<form action="posts.php?do=Store" method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-4">

								<div class="mb-3">
									<label class="mb-2">Post Title</label>
									<input type="name" name="title" placeholder="Post Title" class="form-control" autocomplete="off" autofocus required>
								</div>
								<div class="mb-3">
									<label class="mb-2">Category Name</label>
									<select class="form-select" name="category_id">
										<option>Please select a category</option>
										<?php

										$sql = "SELECT * FROM category WHERE is_parent = '0' AND status = 1 ORDER BY name ASC";
										$parentCat = mysqli_query($db,$sql);
										while($row = mysqli_fetch_assoc($parentCat)){
											$pc_id   = $row['id'];
											$pc_name = $row['name'];
											?>
											<option value="<?php echo $pc_id; ?>"><?php echo $pc_name; ?></option>
											<?php
											$sql2 = "SELECT * FROM category WHERE is_parent = '$pc_id' AND status = 1 ORDER BY name ASC";
											$childCat = mysqli_query($db,$sql2);
											while($row = mysqli_fetch_assoc($childCat)){
											$ch_id   = $row['id'];
											$ch_name = $row['name'];
											?>
											<option value="<?php echo $ch_id; ?>">--<?php echo $ch_name; ?></option>
											<?php
											}
										}
										?>
									</select>
								</div>
								<div class="mb-3">
									<label class="mb-2">Meta Tags</label>
									<input type="text" name="tags" placeholder="Meta Tags [Use comma after every tag]" class="form-control" autocomplete="off" autofocus>
								</div>
								<div class="mb-3">
									<label class="mb-2">Status</label>
									<select class="form-select" name="status">
										<option> Please Select Post Status</option>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
								</div>
								<div class="mb-3">
									<label class="mb-2">Image</label>
									<input type="file" name="image" class="form-control">
								</div>

								</div>
								<div class="col-lg-8">
									
									<div class="mb-3">
										<textarea name="description" class="form-control" rows="15" id="descriptionBox"></textarea>
									</div>


								</div>
								<div class="col-lg-12">

								
								<div class="mb-3">
									<input type="submit" name="addpost" class="btn btn-primary" value="Add New Post">
								</div>

								</div>
							</div>
						</form>

					</div>
				</div>

				<?php
			}
			else if ($do == 'Store'){
				if(isset($_POST['addpost'])){
					$title		 = mysqli_real_escape_string($db, $_POST['title']); 
					$description = mysqli_real_escape_string($db, $_POST['description']); 
					$category_id = mysqli_real_escape_string($db, $_POST['category_id']); 
					$author_id   = $_SESSION['id']; 
					$tags        = mysqli_real_escape_string($db, $_POST['tags']); 
					$status      = mysqli_real_escape_string($db, $_POST['status']);

					//for image
					$image   = $_FILES['image']['name'];
					$img_tmp = $_FILES['image']['tmp_name'];

						if(!empty($image)){
						$img = rand(1, 9999999).'-'.$image;
						move_uploaded_file($img_tmp, "assets/images/posts/" . $img);
						}
						else{
							$img = '';
						}

						$add_post_sql = "INSERT INTO post (title, description, image,category_id, author_id, tags, status, post_date) VALUES ('$title','$description','$img','$category_id','$author_id','$tags','$status',now())";
						$add_post_res = mysqli_query($db,$add_post_sql);
						if($add_post_res){
							header("Location: posts.php?do=Manage");
						}
						else{
							die("MySQL Error. " . mysqli_error($db));
						}
				}
			}
			else if ($do == 'Edit'){

				if(isset($_GET['id'])){
					$editID = $_GET['id'];

					$post_sql = "SELECT * FROM post WHERE id = '$editID'";
					$post_res = mysqli_query($db,$post_sql);

					while ($row = mysqli_fetch_assoc($post_res)){
					$id          = $row['id'];
					$title       = $row['title'];
					$description = $row['description'];
					$image 		 = $row['image'];
					$category_id = $row['category_id'];
					$author_id   = $row['author_id'];
					$tags      	 = $row['tags'];
					$status    	 = $row['status'];
					$post_date 	 = $row['post_date'];
					?>

					<h6 class="mb-0 text-uppercase">Update Post Information</h6>
					<hr>
					<div class="card">
						<div class="card-body">
							<form action="posts.php?do=Update" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="editID" value="<?php echo $id; ?>">
							<div class="row">
								<div class="col-lg-4">

								<div class="mb-3">
									<label class="mb-2">Post Title</label>
									<input type="name" name="title" value="<?php echo $title; ?>" class="form-control" autocomplete="off" autofocus required>
								</div>
								<div class="mb-3">
									<label class="mb-2">Category Name</label>
									<select class="form-select" name="category_id">
										<option>Please select a category</option>
										<?php

										$sql = "SELECT * FROM category WHERE is_parent = '0' AND status = 1 ORDER BY name ASC";
										$parentCat = mysqli_query($db,$sql);
										while($row = mysqli_fetch_assoc($parentCat)){
											$pc_id   = $row['id'];
											$pc_name = $row['name'];
											?>
											<option value="<?php echo $pc_id; ?>"
												<?php if( $category_id == $pc_id){echo 'selected';} ?>
												><?php echo $pc_name; ?></option>
											<?php
											$sql2 = "SELECT * FROM category WHERE is_parent = '$pc_id' AND status = 1 ORDER BY name ASC";
											$childCat = mysqli_query($db,$sql2);
											while($row = mysqli_fetch_assoc($childCat)){
											$ch_id   = $row['id'];
											$ch_name = $row['name'];
											?>
											<option value="<?php echo $ch_id; ?>"
												<?php if( $category_id == $ch_id){echo 'selected';} ?>
												>--<?php echo $ch_name; ?></option>
											<?php
											}
										}
										?>
									</select>
								</div>
								<div class="mb-3">
									<label class="mb-2">Meta Tags</label>
									<input type="text" name="tags" value="<?php echo $tags; ?>" class="form-control" autocomplete="off" autofocus>
								</div>
								<div class="mb-3">
									<label class="mb-2">Status</label>
									<select class="form-select" name="status">
										<option> Please Select Post Status</option>
										<option value="1"<?php if($status == 1){
												echo 'selected';}?>>Active</option>
										<option value="0"<?php if($status == 0){
												echo 'selected';}?>>Inactive</option>
									</select>
								</div>
								<div class="mb-3">
									<label class="mb-2">Image</label>
									<input type="file" name="image" class="form-control">
								</div>

								</div>
								<div class="col-lg-8">
									
									<div class="mb-3">
										<textarea name="description" class="form-control" rows="15" id="descriptionBox"><?php echo $description; ?></textarea>
									</div>


								</div>
								<div class="col-lg-12">

								
								<div class="mb-3">
									<input type="submit" name="editPost" class="btn btn-primary" value="Update Post">
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
				if(isset($_POST['editPost'])){

				$editID      = mysqli_real_escape_string($db, $_POST['editID']); 
				$title		 = mysqli_real_escape_string($db, $_POST['title']); 
				$description = mysqli_real_escape_string($db, $_POST['description']); 
				$category_id = mysqli_real_escape_string($db, $_POST['category_id']); 
				$author_id   = $_SESSION['id']; 
				$tags        = mysqli_real_escape_string($db, $_POST['tags']); 
				$status      = mysqli_real_escape_string($db, $_POST['status']);

				//for image
				$image   = $_FILES['image']['name'];
				$img_tmp = $_FILES['image']['tmp_name'];

					if(!empty($image)){
					$img = rand(1, 9999999).'-'.$image;
					move_uploaded_file($img_tmp, "assets/images/posts/" . $img);

					$edit_post_sql = "UPDATE post SET title='$title', description='$description',image='$img',category_id='$category_id',tags='$tags',status='$status' WHERE id = '$editID'";
					$edit_post_res = mysqli_query($db,$edit_post_sql);

					if($edit_post_res){
						header("Location: posts.php?do=Manage");
					}
					else{
						die("MySQL Error. " . mysqli_error($db));
					}
					}
					else{
						
					$edit_post_sql = "UPDATE post SET title='$title', description='$description',category_id='$category_id',tags='$tags',status='$status' WHERE id = '$editID'";
					$edit_post_res = mysqli_query($db,$edit_post_sql);

					if($edit_post_res){
						header("Location: posts.php?do=Manage");
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

					$sql = "UPDATE post SET status ='0' WHERE id= '$trashID'";
					$trashData = mysqli_query($db,$sql);

					if($trashData){
							header("Location: posts.php?do=Manage");
						}
						else{
							die("MySQL Error. " . mysqli_error($db));
						}
				}
			}
			else if ($do == 'ManageTrash'){
				?>

				<h6 class="mb-0 text-uppercase">Deleted Posts</h6>
				<hr>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sl.</th>
										<th>Image</th>
										<th>Title</th>
										<th>Category</th>
										<th>Author</th>
										<th>Tags</th>
										<th>Status</th>
										<th>Post Date</th>
										<th>Action</th>
								</thead>
								<tbody>
								<?php

								$post_sql = "SELECT * FROM post WHERE status = '0' ORDER BY id DESC";
								$post_res = mysqli_query($db,$post_sql);
								$countData = mysqli_num_rows($post_res);
								

								if($countData == 0){
									echo '<div class="alert alert-info">Sorry! No post found into database.</div>';
								}
								else{
									$serial = 0;
									while ($row = mysqli_fetch_assoc($post_res)){
									$id          = $row['id'];
									$title       = $row['title'];
									$description = $row['description'];
									$image 		 = $row['image'];
									$category_id = $row['category_id'];
									$author_id   = $row['author_id'];
									$tags      	 = $row['tags'];
									$status    	 = $row['status'];
									$post_date 	 = $row['post_date'];
									$serial++;
								
									?>

									<tr>
										<td><?php echo $serial; ?></td>
										<td>
											<?php

											if(!empty($image)){
												echo '<img src ="assets/images/posts/'.$image.'" style="width:40px;">';
											}
											else{
												echo '<img src ="assets/images/posts/default.png" style="width:40px;">';
											}

											?>
										</td>
										<td><?php echo $title; ?></td>
										<td><?php echo $category_id; ?></td>
										<td><?php echo $author_id; ?></td>
										<td><?php echo $tags; ?></td>
										<td>
										<?php
											if ($status == 1){
												echo '<div class="badge bg-success">Active</div>';
											}
											else if ($status == 0){
												echo '<div class="badge bg-danger">Inactive</div>';
											}
										?>
										</td>
										<td><?php echo $post_date; ?></td>
										<td>
											<div class="action-bar">
												<ul>
													<li>
														<a href="posts.php?do=Edit&id=<?php echo $id; ?>" data-bs-toggle="tooltip" title="Edit"><i class="bx bx-pencil"></i></a>
													</li>
													<li>
														<a href="" data-bs-toggle="modal" title="Delete"data-bs-target="#deletePost<?php echo $id; ?>"><i class="bx bx-trash"></i></a>
													</li>
											    </ul>
											</div>
											
										</td>
									</tr>
									<!-- Modal -->
									<div class="modal fade" id="deletePost<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLabel">Delete this post permanently?</h5>
									        
									      </div>
									      <div class="modal-body">
									        <div class="modal-action">
									        	<ul>
									        		<li>
									        			<a href="posts.php?do=Delete&id=<?php echo $id; ?>" class="btn btn-danger">Yes</a>
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

					$sql = "DELETE FROM post WHERE id= '$deleteID'";
					$deleteData = mysqli_query($db,$sql);

					if($deleteData){
							header("Location: posts.php?do=Manage");
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