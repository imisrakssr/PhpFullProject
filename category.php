<?php include "inc/header.php";?>


			<div role="main" class="main">

				<section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
					<div class="container">
						<div class="row">

							<div class="col-md-12 align-self-center p-static order-2 text-center">

								<h1 class="text-dark font-weight-bold text-8">Large Image Right Sidebar</h1>
							<span class="sub-title text-dark">Check out our Latest News!</span>
							</div>

							<div class="col-md-12 align-self-center order-1">

								<ul class="breadcrumb d-block text-center">
									<li><a href="#">Home</a></li>
									<li class="active">Blog</li>
								</ul>
							</div>
						</div>
					</div>
				</section>

				<div class="container py-4">

					<div class="row">
						<div class="col-lg-3 order-lg-2">

						<?php include "inc/sidebar.php";?>

							
						</div>
						<div class="col-lg-9 order-lg-1">
							<div class="blog-posts">

								<?php

								if(isset($_GET['id'])){
									$category_id = $_GET['id'];

								$sql = "SELECT * FROM post WHERE category_id = '$category_id' AND status = 1 ORDER BY id DESC";
								$postData = mysqli_query($db,$sql);

								$totalPostinCategory = mysqli_num_rows($postData);

								if($totalPostinCategory == 0){
									echo '<div class="alert alert-info">Oops! No post found in this category...</div>';
								}
								else{

									while ($row = mysqli_fetch_assoc($postData)){

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

											<article class="post post-large">
												<div class="post-image">
													<a href="single.php?id=<?php echo $id;?>">
														<?php

														if(!empty($image)){
															echo '<img src ="admin/assets/images/posts/'.$image.'" class=" img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="'.$title.'";">';
														}
														else{
															echo '<img src ="admin/assets/images/posts/default.png" class=" img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="'.$title.'";">';
														}

														?>
													</a>
												</div>
											
												<div class="post-date">
													<span class="month"><?php echo $post_date;?></span>
												</div>
											
												<div class="post-content">
											
													<h2 class="font-weight-semibold text-6 line-height-3 mb-3"><a href="single.php?id=<?php echo $id;?>"><?php echo $title;?></a></h2>
													<p><?php echo substr($description, 0, 335)?> [...]</p>
											
													<div class="post-meta">
														<span><i class="far fa-user"></i> By 
															<a href="#">
														<?php
														$sqlAuth = "SELECT * FROM users WHERE id = '$author_id'";
														$AuthData = mysqli_query($db,$sqlAuth);
														while($row = mysqli_fetch_assoc($AuthData)){

															$auth_id   = $row['id'];
															$auth_name = $row['name'];

															echo $auth_name;
														}
														?>
															</a> 
														</span>
														<span><i class="far fa-folder"></i> 
														<?php
														$sqlCat = "SELECT * FROM category WHERE id = '$category_id'";
														$catData = mysqli_query($db,$sqlCat);
														while($row = mysqli_fetch_assoc($catData)){

															$cat_id   = $row['id'];
															$cat_name = $row['name'];

															echo $cat_name;
														}
														?> 
														</span>
														<span><i class="far fa-comments"></i> 
															<a href="#">0 Comments</a>
														</span>
														<span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0">
															<a href="single.php?id=<?php echo $id;?>" class="btn btn-xs btn-light text-1 text-uppercase">Read More</a>
														</span>
													</div>
											
												</div>
											</article>

													<?php

										}
								}

								}
								?>
							</div>
						</div>
					</div>

				</div>

			</div>

<?php include "inc/footer.php";?>
