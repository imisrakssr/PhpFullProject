<?php include "inc/header.php"; ?>
<div class="page-content">

	<div class="row row-cols-1 row-cols-md-12 row-cols-xl-12">
		<?php

		//Ternary Condition
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage'; 

			if ($do == 'Manage'){
				?>

				<h6 class="mb-0 text-uppercase">Manage All Comments</h6>
				<hr>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sl.</th>
										<th>Post Title</th>
										<th>User Name</th>
										<th>Comments</th>
										<th>Status</th>
										<th>Comment Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php

								$post_sql = "SELECT * FROM comments WHERE status = '1' ORDER BY id DESC";
								$post_res = mysqli_query($db,$post_sql);
								$countData = mysqli_num_rows($post_res);
								

								if($countData == 0){
									echo '<div class="alert alert-info">Sorry! No comments found into database.</div>';
								}
								else{
									$serial = 0;
									while ($row = mysqli_fetch_assoc($post_res)){
									$id       = $row['id'];
									$userID   = $row['userID'];
									$postID   = $row['postID'];
									$comments = $row['comments'];
									$status   = $row['status'];
									$cmt_date = $row['cmt_date'];
									$serial++;
								
									?>

									<tr>
										<td><?php echo $serial; ?></td>
										<td>
											<?php
											$sqlPost = "SELECT * FROM post WHERE id = '$postID'";
											$PostData = mysqli_query($db,$sqlPost);
											while($row = mysqli_fetch_assoc($PostData)){

												$Post_id    = $row['id'];
												$Post_title = $row['title'];

												echo $Post_title;
											}
											?>
										</td>
										<td>
											<?php
											$sqlAuth = "SELECT * FROM users WHERE id = '$userID'";
											$AuthData = mysqli_query($db,$sqlAuth);
											while($row = mysqli_fetch_assoc($AuthData)){

												$userID    = $row['id'];
												$auth_name = $row['name'];

												echo $auth_name;
											}
											?>
										</td>
										<td><?php echo $comments; ?></td>
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
										<td><?php echo $cmt_date; ?></td>
										<td>
											<div class="action-bar">
												<ul>
													<li>
														<a href="comments.php?do=Edit&id=<?php echo $id; ?>" data-bs-toggle="tooltip" title="Edit"><i class="bx bx-pencil"></i></a>
													</li>
													<li>
														<a href="" data-bs-toggle="modal" title="Delete"data-bs-target="#deleteComment<?php echo $id; ?>"><i class="bx bx-trash"></i></a>
													</li>
											    </ul>
											</div>
											
										</td>
									</tr>
														<!-- Modal -->
														<div class="modal fade" id="deleteComment<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
														  <div class="modal-dialog">
														    <div class="modal-content">
														      <div class="modal-header">
														        <h5 class="modal-title" id="exampleModalLabel">Move the comment into trash?</h5>
														        
														      </div>
														      <div class="modal-body">
														        <div class="modal-action">
														        	<ul>
														        		<li>
														        			<a href="comments.php?do=Trash&id=<?php echo $id; ?>" class="btn btn-danger">Yes</a>
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
			else if ($do == 'Edit'){

				if(isset($_GET['id'])){
					$editID = $_GET['id'];

					$post_sql = "SELECT * FROM comments WHERE id = '$editID'";
					$post_res = mysqli_query($db,$post_sql);

					while ($row = mysqli_fetch_assoc($post_res)){
					$id       = $row['id'];
					$userID   = $row['userID'];
					$postID   = $row['postID'];
					$comments = $row['comments'];
					$status   = $row['status'];
					$cmt_date = $row['cmt_date'];
					?>

					<h6 class="mb-0 text-uppercase">Update Comments Info</h6>
					<hr>
					<div class="card">
						<div class="card-body">
							<form action="comments.php?do=Update" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="editID" value="<?php echo $id; ?>">
							<div class="row">
								<div class="col-lg-4">
									<div class="mb-3">
										<label class="mb-2">Status</label>
										<select class="form-select" name="status">
											<option> Please Select Comments Status</option>
											<option value="1"<?php if($status == 1){
													echo 'selected';}?>>Active</option>
											<option value="0"<?php if($status == 0){
													echo 'selected';}?>>Inactive</option>
										</select>
									</div>
								</div>
								<div class="col-lg-8">
								</div>
								<div class="col-lg-12">
									<div class="mb-3">
										<input type="submit" name="editComment" class="btn btn-primary" value="Update Comment">
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
				if(isset($_POST['editComment'])){

				$editID      = mysqli_real_escape_string($db, $_POST['editID']);
				$status      = mysqli_real_escape_string($db, $_POST['status']);

					$edit_comment_sql = "UPDATE comments SET status='$status' WHERE id = '$editID'";
					$edit_comment_res = mysqli_query($db,$edit_comment_sql);

					if($edit_comment_res){
						header("Location: comments.php?do=Manage");
					}
					else{
						die("MySQL Error. " . mysqli_error($db));
					}
				}
			}
			else if ($do == 'Trash'){
				if(isset($_GET['id'])){
					$trashID = $_GET['id'];

					$sql = "UPDATE comments SET status ='0' WHERE id= '$trashID'";
					$trashData = mysqli_query($db,$sql);

					if($trashData){
							header("Location: comments.php?do=Manage");
						}
						else{
							die("MySQL Error. " . mysqli_error($db));
						}
				}
			}
			else if ($do == 'ManageTrash'){
				?>

				<h6 class="mb-0 text-uppercase">Deleted Comments</h6>
				<hr>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sl.</th>
										<th>Post Title</th>
										<th>User Name</th>
										<th>Comments</th>
										<th>Status</th>
										<th>Comment Date</th>
										<th>Action</th>
								</thead>
								<tbody>
								<?php

								$post_sql = "SELECT * FROM comments WHERE status = '0' ORDER BY id DESC";
								$post_res = mysqli_query($db,$post_sql);
								$countData = mysqli_num_rows($post_res);
								

								if($countData == 0){
									echo '<div class="alert alert-info">Sorry! No comments found into database.</div>';
								}
								else{
									$serial = 0;
									while ($row = mysqli_fetch_assoc($post_res)){
									$id       = $row['id'];
									$userID   = $row['userID'];
									$postID   = $row['postID'];
									$comments = $row['comments'];
									$status   = $row['status'];
									$cmt_date = $row['cmt_date'];
									$serial++;
								
									?>

									<tr>
										<td><?php echo $serial; ?></td>
										<td>
											<?php
											$sqlPost = "SELECT * FROM post WHERE id = '$postID'";
											$PostData = mysqli_query($db,$sqlPost);
											while($row = mysqli_fetch_assoc($PostData)){

												$Post_id    = $row['id'];
												$Post_title = $row['title'];

												echo $Post_title;
											}
											?>
										</td>
										<td>
											<?php
											$sqlAuth = "SELECT * FROM users WHERE id = '$userID'";
											$AuthData = mysqli_query($db,$sqlAuth);
											while($row = mysqli_fetch_assoc($AuthData)){

												$userID    = $row['id'];
												$auth_name = $row['name'];

												echo $auth_name;
											}
											?>
										</td>
										<td><?php echo $comments; ?></td>
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
										<td><?php echo $cmt_date; ?></td>
										<td>
											<div class="action-bar">
												<ul>
													<li>
														<a href="comments.php?do=Edit&id=<?php echo $id; ?>" data-bs-toggle="tooltip" title="Edit"><i class="bx bx-pencil"></i></a>
													</li>
													<li>
														<a href="" data-bs-toggle="modal" title="Delete"data-bs-target="#deleteComment<?php echo $id; ?>"><i class="bx bx-trash"></i></a>
													</li>
											    </ul>
											</div>
											
										</td>
									</tr>
									<!-- Modal -->
									<div class="modal fade" id="deleteComment<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLabel">Delete this comment permanently?</h5>
									        
									      </div>
									      <div class="modal-body">
									        <div class="modal-action">
									        	<ul>
									        		<li>
									        			<a href="comments.php?do=Delete&id=<?php echo $id; ?>" class="btn btn-danger">Yes</a>
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

					$sql = "DELETE FROM comments WHERE id= '$deleteID'";
					$deleteData = mysqli_query($db,$sql);

					if($deleteData){
							header("Location: comments.php?do=Manage");
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