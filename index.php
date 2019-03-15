<?php
include 'inc/header.php';
//include 'inc/slider.php';
include_once 'classes/Main.php';
?>

<div class="contentsection contemplete clear">
    <div class="maincontent clear">

        <?php
        //Pagination 
        $per_page = 3;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $start_from = ($page - 1) * $per_page;
        //Pagination 
        ?>
        <?php
        //show all posts start
        // header('location : about.php');
        $allPost = $post->allPost($start_from, $per_page);
        if ($allPost) {
            foreach ($allPost as $s) {
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
            header('location : 404.php');
        }
        //all posts end
        ?>   
        <?php
        //Pagination 
        $rows = Main::chkRowNumber("SELECT post_id from posts");
        $total_pages = ceil($rows / $per_page);
        echo "<span class = 'pagination'><a href='index.php?page=1'>" . 'First Page' . "</a>";
        for ($i = 1; $i <= $total_pages; $i++) {
             echo "<a style='padding: 2px 10px' href='index.php?page=".$i."'>".$i."</a>";
        }
        echo "<a href='index.php?page=$total_pages'>" . 'Last Page' . "</a></span>";

        //Pagination 
        ?>
    </div>
    <?php include 'inc/sidebar.php'; ?>
</div>

<?php include './inc/footer.php'; ?>