<?php
require_once('header.php');

// Preventing the direct access of this page.
if ( !isset($_REQUEST['email']) || !isset($_REQUEST['key']) )
{
	header('location: index.php');
	exit;
}
else
{
	// Check the data is valid or not.
	$statement = $pdo->prepare("SELECT * FROM tbl_subscriber WHERE subs_email=? AND subs_hash=?");
	$statement->execute(array($_REQUEST['email'],$_REQUEST['key']));
	$total = $statement->rowCount();
	if( $total == 0 )
	{
		header('location: index.php');
		exit;
	}
}
// Remove the hash and making the subscriber active by updating database
$statement = $pdo->prepare("UPDATE tbl_subscriber SET subs_hash=?, subs_active=? WHERE subs_email=?");
$statement->execute(array('',1,$_REQUEST['email']));
?>

<div class="page-banner" style="background-color:#444;">
    <div class="inner">
        <h1>Subscription Successful</h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="user-content" style="color:green;">
                    Thank you for verifying your subscription.
                </div>                
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>