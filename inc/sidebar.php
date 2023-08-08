<aside class="sidebar">

	<form action="search-results.php" method="GET">
		<div class="input-group mb-3 pb-1">
			<input class="form-control text-1" placeholder="Search..." name="search" id="s" type="text" required="required">
			<span class="input-group-append">
				<button type="submit" class="btn btn-dark text-1 p-2"><i class="fas fa-search m-2"></i></button>
			</span>
		</div>
	</form>

	<h5 class="font-weight-bold pt-4">Categories</h5>
	<ul class="nav nav-list flex-column mb-5">

		<?php

				$sql = "SELECT id AS 'pCatID', name AS 'pCatName' FROM category WHERE is_parent = 0 AND status = 1 ORDER BY name ASC";
				$parentCat = mysqli_query($db,$sql);
				while($row = mysqli_fetch_assoc($parentCat)){
					extract($row);

				$sql2 = "SELECT id AS 'cCatID', name AS 'cCatName' FROM category WHERE is_parent = '$pCatID' AND status = 1 ORDER BY name ASC";
				$childCat = mysqli_query($db,$sql2);

				$numOfChild = mysqli_num_rows($childCat);

					$query = "SELECT * FROM post WHERE category_id = '$pCatID'";
					$readPostData = mysqli_query($db,$query);
					$numOfTotalPost = mysqli_num_rows($readPostData);

				if ($numOfChild == 0){
					?>

					<li class="nav-item">
						<a class="nav-link" href="category.php?id=<?php echo $pCatID;?>"><?php echo $pCatName;?> (<?php echo $numOfTotalPost;?>)</a>
					</li>

					<?php
				}
				else{
					?>

					<li class="nav-item">
						<a class="nav-link" href="#"><?php echo $pCatName;?> (<?php echo $numOfTotalPost;?>)</a>
						<ul>
						<?php
							while($row = mysqli_fetch_assoc($childCat)){
							extract($row);

							$query2 = "SELECT * FROM post WHERE category_id = '$cCatID'";
							$readPostData2 = mysqli_query($db,$query2);
							$numOfTotalPost2 = mysqli_num_rows($readPostData2);


						?>
							<li class="nav-item">
								<a class="nav-link" href="category.php?id=<?php echo $cCatID;?>"><?php echo $cCatName;?> (<?php echo $numOfTotalPost2;?>)</a>
							</li>
						<?php
							}
						?>
						</ul>
					</li>

					<?php
				} 
			}	
			?>
	</ul>
	<div class="tabs tabs-dark mb-4 pb-2">
		<ul class="nav nav-tabs">
			<li class="nav-item active"><a class="nav-link text-1 font-weight-bold text-uppercase" href="#recentPosts" data-toggle="tab">Recent</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="recentPosts">
				<ul class="simple-post-list">

			<?php

				$sql = "SELECT * FROM post WHERE status = 1 ORDER BY id DESC LIMIT 3";
				$allPost = mysqli_query($db,$sql);
				while ($row = mysqli_fetch_assoc($allPost)){
					$id          = $row['id'];
					$title       = $row['title'];
					$description = $row['description'];
					$image 		 = $row['image'];
					$post_date 	 = $row['post_date'];
					?>
						<li>
							<div class="post-image">
								<div class="img-thumbnail img-thumbnail-no-borders d-block">
									<a href="single.php?id=<?php echo $id;?>">
										<?php

											if(!empty($image)){
												echo '<img src ="admin/assets/images/posts/'.$image.'" width="50" height="50" alt="'.$title.'";">';
											}
											else{
												echo '<img src ="admin/assets/images/posts/default.png" width="50" height="50" alt="'.$title.'";">';
											}

											?>
									</a>
								</div>
							</div>
							<div class="post-info">
								<a href="single.php?id=<?php echo $id;?>"><?php echo $title;?></a>
								<div class="post-meta">
									 <?php echo $post_date;?>
								</div>
							</div>
						</li>
					<?php
				}

			?>
				</ul>
			</div>
		</div>
	</div>
	<h5 class="font-weight-bold pt-4">Tags</h5>
	<p>
		<?php

			$sql = "SELECT * FROM post WHERE status = 1 ORDER BY id DESC";
			$postData = mysqli_query($db,$sql);

			while ($row = mysqli_fetch_assoc($postData)){
				$id   = $row['id'];
				$tags = $row['tags'];

				//String to array conversion
				$postTags = explode(',',$tags);

				foreach($postTags as $tag){
					?>
						<span class="badge badge-primary"><a href="single.php?id=<?php echo $id;?>" style="color: #fff;"><?php echo $tag; ?></a></span>
					<?php
				}
			}
		?>		
	</p>
</aside>