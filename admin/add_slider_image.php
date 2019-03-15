<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>

<?php
$msg = "";
if(isset($_POST['addImage'])){
    $msg = $slider->addSliderImage($_POST);
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
                            <input type="file" name="img" class="medium" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="addImage" Value="Add" />
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