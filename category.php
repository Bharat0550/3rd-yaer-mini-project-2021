<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['slug'])) {
    header('location: index.php');
    exit;
}

$statement = $pdo->prepare("SELECT * FROM tbl_category WHERE category_slug=?");
$statement->execute(array($_REQUEST['slug']));
$statement->rowCount();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $category_name = $row['category_name'];
}

?>

<div class="page-banner" style="background-image: url(assets/uploads/banner.jpg);">
    <div class="inner">
        <h1>Category: <?php echo $category_name; ?></h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">            
            <div class="col-md-9">
                <div class="blog">
                    <div class="row">
                        <div class="col-md-12">
                    

            <?php
            /* ===================== Pagination Code Starts ================== */
            $adjacents = 5;
            
            $statement = $pdo->prepare("SELECT * 
                                        FROM tbl_post t1
                                        JOIN tbl_category t2 
                                        ON t1.category_id = t2.category_id
                                        WHERE t2.category_slug = ?
                                        ORDER BY t1.post_id DESC");
            $statement->execute(array($_REQUEST['slug']));
            $total_pages = $statement->rowCount();

            $cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

            $targetpage = BASE_URL.$cur_page.'?slug='.$_REQUEST['slug'];   //your file name  (the name of this file)
            $limit = 10;                                 //how many items to show per page
            $page = @$_GET['page'];
            if($page) 
                $start = ($page - 1) * $limit;          //first item to display on this page
            else
                $start = 0;
            
            $statement = $pdo->prepare("SELECT * 
                                        FROM tbl_post t1
                                        JOIN tbl_category t2 
                                        ON t1.category_id = t2.category_id
                                        WHERE t2.category_slug = ?
                                        ORDER BY t1.post_id DESC
                                        LIMIT $start, $limit");
            $statement->execute(array($_REQUEST['slug']));
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
                    $pagination.= "<a href=\"$targetpage&page=$prev\">&#171; previous</a>";
                else
                    $pagination.= "<span class=\"disabled\">&#171; previous</span>";    
                if ($lastpage < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
                {   
                    for ($counter = 1; $counter <= $lastpage; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
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
                                $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
                        }
                        $pagination.= "...";
                        $pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
                        $pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";       
                    }
                    elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                    {
                        $pagination.= "<a href=\"$targetpage&page=1\">1</a>";
                        $pagination.= "<a href=\"$targetpage&page=2\">2</a>";
                        $pagination.= "...";
                        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                        {
                            if ($counter == $page)
                                $pagination.= "<span class=\"current\">$counter</span>";
                            else
                                $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
                        }
                        $pagination.= "...";
                        $pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
                        $pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";       
                    }
                    else
                    {
                        $pagination.= "<a href=\"$targetpage&page=1\">1</a>";
                        $pagination.= "<a href=\"$targetpage&page=2\">2</a>";
                        $pagination.= "...";
                        for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                        {
                            if ($counter == $page)
                                $pagination.= "<span class=\"current\">$counter</span>";
                            else
                                $pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";                 
                        }
                    }
                }
                if ($page < $counter - 1) 
                    $pagination.= "<a href=\"$targetpage&page=$next\">next &#187;</a>";
                else
                    $pagination.= "<span class=\"disabled\">next &#187;</span>";
                $pagination.= "</div>\n";       
            }
            /* ===================== Pagination Code Ends ================== */
            ?>




                            <?php
                            
                            foreach ($result as $row) {
                                ?>
                                <div class="post-item">
                                    <div class="image-holder">
                                        <img class="img-responsive" src="assets/uploads/<?php echo $row['photo']; ?>" alt="<?php echo $row['post_title']; ?>">
                                    </div>
                                    <div class="text">
                                        <div class="inner">
                                            <h3><a href="blog-single.php?slug=<?php echo $row['post_slug']; ?>"><?php echo $row['post_title']; ?></a></h3>
                                            <ul class="status">
                                                <li><i class="fa fa-tag"></i><a href="category.php?slug=<?php echo $row['category_slug']; ?>"><?php echo $row['category_name']; ?></a></li>
                                                <li><i class="fa fa-calendar"></i><?php echo $row['post_date']; ?></li>
                                            </ul>
                                            <p>
                                                <?php echo substr($row['post_content'],0,200).' ...'; ?> 
                                            </p>
                                            <p class="button">
                                                <a href="blog-single.php?slug=<?php echo $row['post_slug']; ?>">Read More</a>
                                            </p>
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
            <div class="col-md-3">
                
                <?php require_once('sidebar.php'); ?>
                
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>