<?php
include 'inc/header.php';
?>
<?php
if (isset($_GET['page_id'])) {
    $page_id = Validation::validate($_GET['page_id']);
    if (Exist::chkExist("pages", "page_id", $page_id)) {
        $pageById = $page->getPageById($page_id);
    } else {
        echo "<script>window.location = '404.php';</script>";
    }
} else {
    echo "<script>window.location = '404.php';</script>";
}
?>
<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <div class="about">
            <h2><?php echo $pageById['page_name'];?></h2>
            <p><?php echo $pageById['page_body'];?></p>
        </div>

    </div>
    <?php include 'inc/sidebar.php'; ?>
</div>
<?php include './inc/footer.php'; ?>