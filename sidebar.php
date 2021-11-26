<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $total_recent_post_sidebar = $row['total_recent_post_sidebar'];
    $total_popular_post_sidebar = $row['total_popular_post_sidebar'];
}
?>
<div class="sidebar">
    <div class="widget">
        <h4>Categories</h4>
        <ul>
            <?php
            $statement = $pdo->prepare("SELECT * FROM tbl_category ORDER BY category_name ASC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
            foreach ($result as $row) {
                ?>
                <li><a href="category.php?slug=<?php echo $row['category_slug']; ?>"><?php echo $row['category_name']; ?></a></li>
                <?php
            }
            ?>
        </ul>
    </div>
    <div class="widget">
        <h4>Latest Posts</h4>
        <ul>
            <?php
            $i = 0;
            $statement = $pdo->prepare("SELECT * FROM tbl_post ORDER BY post_id DESC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
            foreach ($result as $row) {
                $i++;
                if($i > $total_recent_post_sidebar) {
                    break;
                }
                ?>
                <li><a href="blog-single.php?slug=<?php echo $row['post_slug']; ?>"><?php echo $row['post_title']; ?></a></li>
                <?php
            }
            ?>
        </ul>
    </div>
    <div class="widget">
        <h4>Popular Posts</h4>
        <ul>
            <?php
            $i = 0;
            $statement = $pdo->prepare("SELECT * FROM tbl_post ORDER BY total_view DESC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
            foreach ($result as $row) {
                $i++;
                if($i > $total_popular_post_sidebar) {
                    break;
                }
                ?>
                <li><a href="blog-single.php?slug=<?php echo $row['post_slug']; ?>"><?php echo $row['post_title']; ?></a></li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>