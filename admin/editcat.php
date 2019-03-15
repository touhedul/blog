<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>

<?php
$msg = "";
$c_id = "";
$c_name = "";

if (isset($_POST['editCategory'])) {
    $category_id = Validation::validate($_GET['category_id']);
    $category_name = Validation::validate($_POST['category_name']);
    if ($category_name == "" OR strlen($category_name) > 20) {
        $msg = '<span style="color: red">Invalid Category Name</span>';
    } else {
        $category->updateCategory($category_id, $category_name);
            $msg = '<span style="color: green">Category Update Successful.</span>';
        
    }
}
if (isset($_GET['category_id'])) {

    $category_id = Validation::validate($_GET['category_id']);
    if (Exist::chkExist("category", "category_id", $category_id)) {
        $cat = $category->getCategoryById($category_id);
        $c_id = $cat['category_id'];
        $c_name = $cat['category_name'];
    } else {
        echo "<script>window.location = 'catlist.php';</script>";
        die("<h1 style='color: red'>Id does not exist.!!!</h1>");
    }
} else {
    echo "<script>window.location = 'catlist.php';</script>";
    die("<h1 style='color: red'>INVALID</h1>");
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock"> 
<?php echo '<h3>' . $msg . '</h3>'; ?>
            <form action="" method="POST">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" placeholder="Enter Category Name..." name="category_name" value="<?php echo $c_name; ?>" class="medium" />

                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="editCategory" Value="Edit" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<div class="clear">
</div>
include 'a_inc/a_footer.php';
?>