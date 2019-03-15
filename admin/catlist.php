<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>

<?php
$dltmsg = "";
if (isset($_GET['category_id'])) {

    $category_id = Validation::validate($_GET['category_id']);
    if (Exist::chkExist("category", "category_id", $category_id)) {
        $category->deleteCategory($category_id);
        $dltmsg = '<span style="color: green">Delete Successful.</span>';
    } else {
        echo "<script>window.location = 'catlist.php';</script>";
    }
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <div class="block">    
            <?php echo "<h2>$dltmsg</h2>"; ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $allCategory = Main::readAll("category");
                    if ($allCategory) {
                        $i = 0;
                        foreach ($allCategory as $s) {
                            $i++;
                            echo "<tr class='odd gradeX'>
                            <td>$i</td>
                            <td>" . $s['category_name'] . "</td>
                            <td><a href='editcat.php?category_id=" . $s['category_id'] . "'>Edit</a> ||"
                            . " <a onclick='return confirm(" . "'Are you sure to Delete'" . ");' "
                            . "href='catlist.php?category_id=" . $s['category_id'] . "'>Delete</a></td>
                            </tr>";
                        }
                    } else {
                        echo 'Not category found.';
                    }
                    ?>
                </tbody>
            </table>
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
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();


    });
</script>