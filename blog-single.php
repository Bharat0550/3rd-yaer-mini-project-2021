<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['slug'])) {
    header('location: index.php');
    exit;
}

$statement = $pdo->prepare("SELECT * 
                            FROM tbl_post t1
                            JOIN tbl_category t2
                            ON t1.category_id = t2.category_id
                            WHERE t1.post_slug=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $post_title = $row['post_title'];
    $post_content = $row['post_content'];
    $photo = $row['photo'];
    $post_date = $row['post_date'];
    $category_name = $row['category_name'];
    $category_slug = $row['category_slug'];
}
?>

<div class="page">
    <div class="container">
        <div class="row">            
            <div class="col-md-9">
                <div class="blog">
                    <div class="row">
                        <div class="col-md-12">

                            
                            <div class="post-item">
                                <div class="image-holder image-holder-single">
                                    <img class="img-responsive" src="assets/uploads/<?php echo $photo; ?>" alt="<?php echo $post_title; ?>">
                                </div>
                                <div class="text text-single">
                                    <h3><?php echo $post_title; ?></h3>
                                    <ul class="status">
                                        <li><i class="fa fa-tag"></i><a href="category.php?slug=<?php echo $category_slug; ?>"><?php echo $category_name; ?></a></li>
                                        <li><i class="fa fa-calendar"></i><?php echo $post_date; ?></li>
                                    </ul>
                                    <p>
                                        <?php echo $post_content; ?>
                                    </p>

                                    <h3>Share This</h3>
                                    <div class="sharethis-inline-share-buttons"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Comments</h3>
                                    <div class="fb-comments" data-href="<?php echo BASE_URL.'blog-single.php?slug='.$_REQUEST['slug']; ?>" data-numposts="5"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>                
            </div>
            <div class="col-md-3">
                
                <?php require_once('sidebar.php'); ?>
                
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>