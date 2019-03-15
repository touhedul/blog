<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>

<?php
$dltmsg = "";
if (isset($_GET['slider_id'])) {
    $slider_id = Validation::validate($_GET['slider_id']);
    if (Exist::chkExist("slider", "slider_id", $slider_id)) {
        $slider->deleteSlider($slider_id);
        $dltmsg = '<span style="color: green">Delete Successful.</span>';
    } else {
        echo "<script>window.location = '404.php';</script>";
    }
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <?php echo "<h2>$dltmsg</h2>"; ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $allSliderImage = Main::readAll("slider");
                    $i = 0;
                    $vd = "";
                    foreach ($allSliderImage as $s) {
                        $i++;
                        echo '<tr class="odd gradeX">
                        <td>' . $i . '</td>
                        <td> <img src = "upload/' . $s['slider_image'] . '" height = "50px" width="100px" alter="No Image"/> </td>
                        <td>' . ' <a href="update_slider.php?slider_id=' . $s['slider_id'] . '">Update</a>'
                        . '|| <a href="?slider_id=' . $s['slider_id'] . '">Delete</a></td>
                        </tr>';
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