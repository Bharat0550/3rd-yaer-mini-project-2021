<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;

	if(empty($_POST['title'])) {
        $valid = 0;
        $error_message .= "Video Title can not be empty<br>";
    }

    if(empty($_POST['iframe_code'])) {
        $valid = 0;
        $error_message .= "Video iframe code can not be empty<br>";
    }
        
    if($valid == 1) {

    	// updating into the database
		$statement = $pdo->prepare("UPDATE tbl_video SET title=?, iframe_code=? WHERE id=?");
		$statement->execute(array($_POST['title'],$_POST['iframe_code'],$_REQUEST['id']));
    	    	
    	$success_message = 'Video is updated successfully.';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_video WHERE id=?");
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
		<h1>Edit Video</h1>
	</div>
	<div class="content-header-right">
		<a href="video.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<?php							
foreach ($result as $row) {
	$title = $row['title'];
	$iframe_code = $row['iframe_code'];
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

			<form class="form-horizontal" action="" method="post">

				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Video Title <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">iframe Code <span>*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control" name="iframe_code" style="height:200px;"><?php echo $iframe_code; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
							</div>
						</div>
					</div>
				</div>

			</form>


		</div>
	</div>

</section>

<?php require_once('footer.php'); ?>