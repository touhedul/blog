<?php
include 'inc/header.php';
?>

<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <?php
        //show all category posts start
        if (isset($_GET['c_id'])) {
            $post = new Posts();
            $fm = new Format();
            $c_id = Validation::validate($_GET['c_id']);
            $allCategoryPost = $post->relatePost($c_id);
            if ($allCategoryPost) {
                foreach ($allCategoryPost as $s) {
                    ?>
                    <div class = "samepost clear">
                        <h2><a href = "post.php?p_id=<?php echo $s['post_id']; ?>"><?php echo $s['post_title']; ?></a></h2>
                        <h4><?php echo $fm->formatDate($s['post_date']); ?> <a href = "#"><?php echo $s['post_author']; ?></a></h4>
                        <a href = "#"><img src = "admin/upload/<?php echo $s['post_image']; ?>" alt = "post image"/></a>
                        <p>
                            <?php echo $fm->formatText($s['post_body']); ?>
                        </p>
                        <div class = "readmore clear">
                            <a href = "post.php?p_id=<?php echo $s['post_id']; ?>">Read More</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<h2>No Post Found</h2>";
            }
            //all posts end
        } else {
             echo "<h2>Invalid</h2>";
        }
        ?>
    </div>
        <?php include 'inc/sidebar.php'; ?>
</div>

<?php include './inc/footer.php'; ?>