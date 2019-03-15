<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>

<?php
$msg = "";
if(isset($_POST['updateSlider'])){
    $slider_id = Validation::validate($_GET['slider_id']);
    $msg = $slider->updateSliderImage($slider_id);
}
if (isset($_GET['slider_id'])) {

    $slider_id = Validation::validate($_GET['slider_id']);
    if (Exist::chkExist("slider", "slider_id", $slider_id)) {
        $getSlider = $slider->getSlider($slider_id);
    } else {
        echo "<script>window.location = '404.php';</script>";
    }
} else {
    echo "<script>window.location = 'catlist.php';</script>";
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add Slider Image</h2>
        <div class="block copyblock"> 
            <?php echo $msg;?>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="form">					
                    <tr>
                        <td>
                            <img src="upload/<?php echo $getSlider['slider_image'] ?>" height="50px" width="100px"/>
                            <input type="file" name="img" class="medium" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="updateSlider" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<div class="clear">
</div>
<?php
include 'a_inc/a_footer.php';
?>