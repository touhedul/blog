<?php
include_once 'classes/Main.php';
?>

<?php
$post = new Posts();
$fm = new Format();
$category = new Category();
$selectCategory = Main::readAll("category");
?>
<div class="sidebar clear">
    <div class="samesidebar clear">
        <h2>Categories</h2>
        <ul>
            <?php
            //category
            if ($selectCategory) {
                foreach ($selectCategory as $s) {
                    echo '<li><a href="c_post.php?c_id='.$s['category_id'].'">'.$s['category_name'].'</a></li>';
                }
            }
            ?>						
        </ul>
    </div>
    <div class="samesidebar clear">
        <h2>Latest articles</h2>
    </div>
    <?php
//latest post
    $latestPost = $post->getLatestPost();
    if ($latestPost) {
        foreach ($latestPost as $s) {
            ?>
            <div class="samesidebar clear">

                <div class="popular clear">
                    <h3><a href="post.php?p_id=<?php echo $s['post_id']; ?>"><?php echo $s['post_title']; ?></a></h3>
                    <a href="post.php?p_id=<?php echo $s['post_id']; ?>"> <img  src = "admin/upload/<?php echo $s['post_image']; ?>" alt="post image"/></a>
                    <p><?php echo $fm->formatText($s['post_body'], 50); ?></p>
                </div>
            </div>

            <?php
        }
    } else {
        header('location : 404.php');
    }
    ?>

</div>