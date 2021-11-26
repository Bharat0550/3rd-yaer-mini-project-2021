<?php require_once('header.php'); ?>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $pgallery_title = $row['pgallery_title'];
    $pgallery_banner = $row['pgallery_banner'];
}
?>

<div class="page-banner" style="background-image: url(assets/uploads/<?php echo $pgallery_banner; ?>);">
	<div class="inner">
		<h1><?php echo $pgallery_title; ?></h1>
	</div>
</div>

<div class="page">
	<div class="container">
		<div class="row">            
			<div class="col-md-12">

				<div class="gal-container">
					
			<?php
            /* ===================== Pagination Code Starts ================== */
            $adjacents = 5;
            
            $statement = $pdo->prepare("SELECT * FROM tbl_photo ORDER BY id DESC");
			$statement->execute();
            $total_pages = $statement->rowCount();


            $targetpage = $_SERVER['PHP_SELF'];   //your file name  (the name of this file)
            $limit = 12;                                 //how many items to show per page
            $page = @$_GET['page'];
            if($page) 
                $start = ($page - 1) * $limit;          //first item to display on this page
            else
                $start = 0;
            
            $statement = $pdo->prepare("SELECT * FROM tbl_photo ORDER BY id DESC LIMIT $start, $limit");
			$statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            
            if ($page == 0) $page = 1;                  //if no page var is given, default to 1.
            $prev = $page - 1;                          //previous page is page - 1
            $next = $page + 1;                          //next page is page + 1
            $lastpage = ceil($total_pages/$limit);      //lastpage is = total pages / items per page, rounded up.
            $lpm1 = $lastpage - 1;   
            $pagination = "";
            if($lastpage > 1)
            {   
                $pagination .= "<div class=\"pagination\">";
                if ($page > 1) 
                    $pagination.= "<a href=\"$targetpage?page=$prev\">&#171; previous</a>";
                else
                    $pagination.= "<span class=\"disabled\">&#171; previous</span>";    
                if ($lastpage < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
                {   
                    for ($counter = 1; $counter <= $lastpage; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                    }
                }
                elseif($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
                {
                    if($page < 1 + ($adjacents * 2))        
                    {
                        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                        {
                            if ($counter == $page)
                                $pagination.= "<span class=\"current\">$counter</span>";
                            else
                                $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                        }
                        $pagination.= "...";
                        $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                        $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
                    }
                    elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                    {
                        $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                        $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                        $pagination.= "...";
                        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                        {
                            if ($counter == $page)
                                $pagination.= "<span class=\"current\">$counter</span>";
                            else
                                $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                        }
                        $pagination.= "...";
                        $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                        $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
                    }
                    else
                    {
                        $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                        $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                        $pagination.= "...";
                        for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                        {
                            if ($counter == $page)
                                $pagination.= "<span class=\"current\">$counter</span>";
                            else
                                $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                        }
                    }
                }
                if ($page < $counter - 1) 
                    $pagination.= "<a href=\"$targetpage?page=$next\">next &#187;</a>";
                else
                    $pagination.= "<span class=\"disabled\">next &#187;</span>";
                $pagination.= "</div>\n";       
            }
            /* ===================== Pagination Code Ends ================== */
            ?>

					<?php
												
					foreach ($result as $row) {
						?>
						<div class="col-md-4 col-sm-6 co-xs-12 gal-item">
							<div class="box">
								<a href="#" data-toggle="modal" data-target="#<?php echo $row['id']; ?>">
									<img src="assets/uploads/<?php echo $row['photo']; ?>" alt="<?php echo $row['caption']; ?>">
								</a>
								<div class="modal fade" id="<?php echo $row['id']; ?>" tabindex="-1" role="dialog">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
											<div class="modal-body">
												<img src="assets/uploads/<?php echo $row['photo']; ?>" alt="<?php echo $row['caption']; ?>">
											</div>
											<div class="col-md-12 description">
												<h4><?php echo $row['caption']; ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					?>

					<div class="pagination">
                    <?php 
                        echo $pagination; 
                    ?>
                    </div>

				</div>

			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>