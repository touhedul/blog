<!DOCTYPE html>

<?php
include 'classes/Category.php';
include 'classes/Posts.php';
include 'classes/Validation.php';
include 'classes/DB.php';
include 'classes/TSL.php';
include 'classes/Social.php';
include 'classes/Copyright.php';
include 'classes/Exist.php';
include 'classes/Contact.php';
include 'classes/Pages.php';
include 'helper/Format.php';


$category = new Category();
$post = new Posts();
$tsl = new TSL();
$copyright = new Copyright();
$page = new Pages();
$social = new Social();
$contact = new Contact();
$fm = new Format();
?>
<?php
//title
$myblog = "My Blog";
$title = $fm->title();
$page_id = "";
if (isset($_GET['page_id'])) {
    $page_id = Validation::validate($_GET['page_id']);
    if (Exist::chkExist("pages", "page_id", $page_id)) {
        $pageById = $page->getPageById($page_id);
        $title = $pageById['page_name'] . ' - ' . $myblog;
    }
} elseif (isset($_GET['p_id'])) {
    $post_id = Validation::validate($_GET['p_id']);
    $getPostById = $post->getPostById($post_id);
    if ($getPostById) {
        $title = $getPostById['post_title'] . ' - ' . $myblog;
    }
}
?>
<?php
//Meta
$keyword = "Java, PHP, CMS, C++, Education";
$description = "This is a learning website";
if (isset($_GET['p_id'])) {
    $post_id = Validation::validate($_GET['p_id']);
    $getPostById = $post->getPostById($post_id);
    if ($getPostById) {
        $keyword = $getPostById['post_tag'];
        $description = "This post is about $keyword";
    }
}
?>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta name="language" content="English">
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="<?php echo $keyword; ?>">
        <meta name="author" content="Ratul">
       <?php include 'scripts/css.php';?>
       <?php include 'scripts/js.php';?>
       
    </head>

    <body>
        <div class="headersection templete clear">
            <a href="index.php">
                <div class="logo">
                    <?php
                    $getTSL = $tsl->getTSL();
                    ?>
                    <img src="admin/upload/<?php echo $getTSL['tsl_logo']; ?>" alt="Logo"/>
                    <h2><?php echo $getTSL['tsl_title']; ?></h2>
                    <p><?php echo $getTSL['tsl_slogan']; ?></p>
                </div>
            </a>
            <?php
            $getSocial = $social->getSocial();
            ?>
            <div class="social clear">
                <div class="icon clear">
                    <a href="<?php echo $getSocial['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="<?php echo $getSocial['tw']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="<?php echo $getSocial['ln']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                    <a href="<?php echo $getSocial['gp']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                </div>
                <div class="searchbtn clear">
                    <form action="search.php" method="post">
                        <input type="text" name="keyword" placeholder="Search keyword..."/>
                        <input type="submit" name="search" value="Search"/>
                    </form>
                </div>
            </div>
        </div>
        <div class="navsection templete">
            <ul>

                <li>
                    <a
                    <?php
                    //Highlight
                    if ($fm->highlight() == "Home") {
                        echo 'id="active"';
                    }
                    ?>
                        href="index.php">Home</a>
                </li>
                <?php
                $getPage = $page->getPage();
                foreach ($getPage as $s) {
                    if ($page_id == $s['page_id']) {
                        echo '<li><a id="active" href="page.php?page_id=' . $s['page_id'] . '">' . $s['page_name'] . '</a></li>';
                    } else
                        echo '<li><a  href="page.php?page_id=' . $s['page_id'] . '">' . $s['page_name'] . '</a></li>';
                }
                ?>
                <li>
                    <a  
                    <?php
                    //highlight
                    if ($fm->highlight() == "Contact") {
                        echo 'id="active"';
                    }
                    ?>
                        href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
