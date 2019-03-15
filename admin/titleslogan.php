<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>
<?php
$msg = "";
if(isset($_POST['update'])){
    $msg = $tsl->updateTSL($_POST);
    
}

$getTSL = $tsl->getTSL();
$w_title = $getTSL['tsl_title'];
$w_slogan = $getTSL['tsl_slogan'];
$w_logo= $getTSL['tsl_logo'];
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <div class="block sloginblock">  
            <?php echo '<h3>'.$msg.'</h3>';?>
            <form action=""  method="POST" enctype="multipart/form-data">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Website Title</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $w_title;?>" name="w_title" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Website Slogan</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $w_slogan;?>" name="w_slogan" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Website logo</label>
                        </td>
                        <td>
                            <img src="upload/<?php echo $w_logo; ?>" height="50px" width="100px"/>
                            <input type="file" name="img" class="medium" />
                        </td>
                    </tr>


                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="update" Value="Update" />
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