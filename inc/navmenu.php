<div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
	<nav class="collapse header-mobile-border-top">
		<ul class="nav nav-pills" id="mainNav">

			<li class="dropdown">
						<a class="dropdown-item dropdown-toggle" href="index.php">
							All News
						</a>
			</li>


			<?php

				$sql = "SELECT id AS 'pCatID', name AS 'pCatName' FROM category WHERE is_parent = 0 AND status = 1 ORDER BY name ASC";
				$parentCat = mysqli_query($db,$sql);
				while($row = mysqli_fetch_assoc($parentCat)){
					extract($row);

				$sql2 = "SELECT id AS 'cCatID', name AS 'cCatName' FROM category WHERE is_parent = '$pCatID' AND status = 1 ORDER BY name ASC";
				$childCat = mysqli_query($db,$sql2);

				$numOfChild = mysqli_num_rows($childCat);

				if ($numOfChild == 0){
					?>

					<li class="dropdown">
						<a class="dropdown-item dropdown-toggle" href="category.php?id=<?php echo $pCatID;?>">
							<?php echo $pCatName;?>
						</a>
					</li>

					<?php
				}
				else{
					?>

					<li class="dropdown">
						<a class="dropdown-item dropdown-toggle" href="#">
							<?php echo $pCatName;?>
						</a>
						<ul class="dropdown-menu">
						<?php
							while($row = mysqli_fetch_assoc($childCat)){
							extract($row);
						?>
							<li class="">
								<a class="dropdown-item" href="category.php?id=<?php echo $cCatID;?>"><?php echo $cCatName;?></a>
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

			<?php

				if( !empty($_SESSION['id'])){
					$userID = $_SESSION['id'];

					$sql = "SELECT * FROM users WHERE id = '$userID'";
					$userData = mysqli_query($db,$sql);

					while($row = mysqli_fetch_assoc($userData)){
						$authID = $row['id'];
						$authName = $row['name'];
						?>
							<li class="dropdown">
								<a class="dropdown-item dropdown-toggle" href="#">
									<?php echo $authName;?>
								</a>
								<ul class="dropdown-menu">
									<li class="">
										<a class="dropdown-item" href="profile.php">Profile Update</a>
									</li>
									<li class="">
										<a class="dropdown-item" href="logout.php">Logout</a>
									</li>
								</ul>
							</li>
						<?php
					}
					
						
				}
				else{
					?>

						<li class="dropdown">
							<a class="dropdown-item dropdown-toggle" href="login.php">
								Login / Register
							</a>
						</li>

					<?php
				}

			?>
		</ul>
	</nav>
</div> 