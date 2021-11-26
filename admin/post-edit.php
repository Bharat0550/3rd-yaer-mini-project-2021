<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;

	if(empty($_POST['post_title'])) {
		$valid = 0;
		$error_message .= 'Post title can not be empty<br>';
	} else {
		// Duplicate Category checking
    	// current Post title that is in the database
    	$statement = $pdo->prepare("SELECT * FROM tbl_post WHERE post_id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) {
			$current_post_title = $row['post_title'];
		}

		$statement = $pdo->prepare("SELECT * FROM tbl_post WHERE post_title=? and post_title!=?");
    	$statement->execute(array($_POST['post_title'],$current_post_title));
    	$total = $statement->rowCount();							
    	if($total) {
    		$valid = 0;
        	$error_message .= 'Post title already exists<br>';
    	}
	}

	if(empty($_POST['post_content'])) {
		$valid = 0;
		$error_message .= 'Post content can not be empty<br>';
	}

	if(empty($_POST['post_date'])) {
		$valid = 0;
		$error_message .= 'Post publish date can not be empty<br>';
	}

	if(empty($_POST['category_id'])) {
		$valid = 0;
		$error_message .= 'You must have to select a category<br>';
	}

	$path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    $previous_photo = $_POST['previous_photo'];

	if($path!='') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

	if($valid == 1) {

		if($_POST['post_slug'] == '') {
    		// generate slug
    		$temp_string = strtolower($_POST['post_title']);
    		$post_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);;
    	} else {
    		$temp_string = strtolower($_POST['post_slug']);
    		$post_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
    	}

    	// if slug already exists, then rename it
		$statement = $pdo->prepare("SELECT * FROM tbl_post WHERE post_slug=? AND post_title!=?");
		$statement->execute(array($post_slug,$current_post_title));
		$total = $statement->rowCount();
		if($total) {
			$post_slug = $post_slug.'-1';
		}

		// If previous image not found and user do not want to change the photo
	    if($previous_photo == '' && $path == '') {
	    	$statement = $pdo->prepare("UPDATE tbl_post SET post_title=?, post_slug=?, post_content=?, post_date=?, category_id=?, meta_title=?, meta_keyword=?, meta_description=? WHERE post_id=?");
	    	$statement->execute(array($_POST['post_title'],$post_slug,$_POST['post_content'],$_POST['post_date'],$_POST['category_id'],$_POST['meta_title'],$_POST['meta_keyword'],$_POST['meta_description'],$_REQUEST['id']));
	    }

		// If previous image found and user do not want to change the photo
	    if($previous_photo != '' && $path == '') {
	    	$statement = $pdo->prepare("UPDATE tbl_post SET post_title=?, post_slug=?, post_content=?, post_date=?, category_id=?, meta_title=?, meta_keyword=?, meta_description=? WHERE post_id=?");
	    	$statement->execute(array($_POST['post_title'],$post_slug,$_POST['post_content'],$_POST['post_date'],$_POST['category_id'],$_POST['meta_title'],$_POST['meta_keyword'],$_POST['meta_description'],$_REQUEST['id']));
	    }


	    // If previous image not found and user want to change the photo
	    if($previous_photo == '' && $path != '') {

	    	$final_name = 'post-'.$_REQUEST['id'].'.'.$ext;
            move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

	    	$statement = $pdo->prepare("UPDATE tbl_post SET post_title=?, post_slug=?, post_content=?, post_date=?, photo=?, category_id=?, meta_title=?, meta_keyword=?, meta_description=? WHERE post_id=?");
	    	$statement->execute(array($_POST['post_title'],$post_slug,$_POST['post_content'],$_POST['post_date'],$final_name,$_POST['category_id'],$_POST['meta_title'],$_POST['meta_keyword'],$_POST['meta_description'],$_REQUEST['id']));
	    }

	    
	    // If previous image found and user want to change the photo
		if($previous_photo != '' && $path != '') {

	    	unlink('../assets/uploads/'.$previous_photo);

	    	$final_name = 'post-'.$_REQUEST['id'].'.'.$ext;
            move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

	    	$statement = $pdo->prepare("UPDATE tbl_post SET post_title=?, post_slug=?, post_content=?, post_date=?, photo=?, category_id=?, meta_title=?, meta_keyword=?, meta_description=? WHERE post_id=?");
	    	$statement->execute(array($_POST['post_title'],$post_slug,$_POST['post_content'],$_POST['post_date'],$final_name,$_POST['category_id'],$_POST['meta_title'],$_POST['meta_keyword'],$_POST['meta_description'],$_REQUEST['id']));
	    }

	    $success_message = 'Post is updated successfully!';
	}
}
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_post WHERE post_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Post</h1>
	</div>
	<div class="content-header-right">
		<a href="post.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_post WHERE post_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$post_title       = $row['post_title'];
	$post_slug        = $row['post_slug'];
	$post_content     = $row['post_content'];
	$post_date        = $row['post_date'];
	$photo            = $row['photo'];
	$category_id      = $row['category_id'];
	$meta_title       = $row['meta_title'];
	$meta_keyword     = $row['meta_keyword'];
	$meta_description = $row['meta_description'];
}
?>

<section class="content">

	<div class="row">
		<div class="col-md-12">

			<?php if($error_message): ?>
			<div class="callout callout-danger">
			
			<p>
			<?php echo $error_message; ?>
			</p>
			</div>
			<?php endif; ?>

			<?php if($success_message): ?>
			<div class="callout callout-success">
			
			<p><?php echo $success_message; ?></p>
			</div>
			<?php endif; ?>

			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Post Title <span>*</span></label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
							</div>
						</div>
						<div class="form-group">
		                    <label for="" class="col-sm-2 control-label">Post Slug</label>
		                    <div class="col-sm-6">
		                        <input type="text" class="form-control" name="post_slug" value="<?php echo $post_slug; ?>">
		                    </div>
		                </div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Post Content <span>*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control" name="post_content" id="editor1"><?php echo $post_content; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Post Publish Date <span>*</span></label>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="post_date" id="datepicker" value="<?php echo $post_date; ?>">(Format: dd-mm-yy)
							</div>
						</div>
						<div class="form-group">
				            <label for="" class="col-sm-2 control-label">Existing Featured Photo</label>
				            <div class="col-sm-6" style="padding-top:6px;">
				            	<?php
				            	if($photo == '') {
				            		echo 'No photo found';
				            	} else {
				            		echo '<img src="../assets/uploads/'.$photo.'" class="existing-photo" style="width:200px;">';	
				            	}
				            	?>
				                <input type="hidden" name="previous_photo" value="<?php echo $photo; ?>">
				            </div>
				        </div>
						<div class="form-group">
				            <label for="" class="col-sm-2 control-label">Change Featured Photo</label>
				            <div class="col-sm-6" style="padding-top:6px;">
				                <input type="file" name="photo">
				            </div>
				        </div>
						<div class="form-group">
				            <label for="" class="col-sm-2 control-label">Categories <span>*</span></label>
				            <div class="col-sm-3">
				            	<select class="form-control select2" name="category_id">
								<?php
				            	$i=0;
				            	$statement = $pdo->prepare("SELECT * FROM tbl_category ORDER BY category_name ASC");
				            	$statement->execute();
				            	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
				            	foreach ($result as $row) {
									?>
									<option value="<?php echo $row['category_id']; ?>" <?php if($row['category_id']==$category_id){echo 'selected';} ?>><?php echo $row['category_name']; ?></option>
	                                <?php
								}
								?>
								</select>
				            </div>
				        </div>
						<h3 class="seo-info">SEO Information</h3>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Title </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="meta_title" value="<?php echo $meta_title; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Keywords </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="meta_keyword" value="<?php echo $meta_keyword; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Description </label>
							<div class="col-sm-9">
								<textarea class="form-control" name="meta_description" style="height:200px;"><?php echo $meta_description; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1">Update</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

</section>

<?php require_once('footer.php'); ?>