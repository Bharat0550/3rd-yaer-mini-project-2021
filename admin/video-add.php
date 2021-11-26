<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;

    if(empty($_POST['title'])) {
        $valid = 0;
        $error_message .= "Video title can not be empty<br>";
    }

    if(empty($_POST['iframe_code'])) {
        $valid = 0;
        $error_message .= "Video iframe code can not be empty<br>";
    }
    
    if($valid == 1) {

		// saving into the database
		$statement = $pdo->prepare("INSERT INTO tbl_video (title,iframe_code) VALUES (?,?)");
		$statement->execute(array($_POST['title'],$_POST['iframe_code']));

    	$success_message = 'Video is added successfully.';
    }
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add Video</h1>
	</div>
	<div class="content-header-right">
		<a href="video.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


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
								<input type="text" class="form-control" name="title">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">iframe Code <span>*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control" name="iframe_code" style="height:200px;"></textarea>
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