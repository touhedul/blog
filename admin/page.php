<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>
<?php
$msg = "";
//update
if (isset($_POST['update'])) {
    $page_id = Validation::validate($_GET['page_id']);
    $msg = $page->updatePage($_POST, $page_id);
}
//Delete
if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $page_id = Validation::validate($_GET['page_id']);
    if (Exist::chkExist("pages", "page_id", $page_id)) {
        $msg = $page->deletePage($page_id);
        echo '<h1>'.$msg.'</h1>';
        die();
         echo "<script>window.location = 'index.php';</script>";
    } else {
        echo "<script>window.location = '404.php';</script>";
    }
}
//validate
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
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Page</h2>
        <div class="block">
            <?php echo '<h2>' . $msg . '</h2>'; ?>
            <form action = "" method = "POST">
                <table class = "form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type = "text" name = "page_name" value="<?php echo $pageById['page_name']; ?>" class = "medium" />
                        </td>
                    </tr>


                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce " rows="10" cols="60" name="page_body">"<?php echo $pageById['page_body']; ?>"
                            </textarea>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="update" Value="Update" />
                            
                        </td>
                    </tr>
                </table>
            </form>
            <a onclick="return confirm('Are you sure?');" href="?action=delete&page_id=<?php echo $page_id; ?>"><button class="btn btn-danger">Delete</button></a>
        </div>
    </div>
</div>
<div class="clear">
</div>
<?php
include 'a_inc/a_footer.php';
?>



<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>