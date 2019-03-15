<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>

<?php
$msg="";
if(isset($_POST['update'])){
    $msg = $social->updateLink($_POST);
}

 $getSocial = $social->getSocial();
 $fb = $getSocial['fb'];
 $tw = $getSocial['tw'];
 $ln = $getSocial['ln'];
 $gp = $getSocial['gp'];
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <?php echo '<h3>'.$msg.'</h3>';?>
        <div class="block">               
            <form action="" method="POST">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Facebook</label>
                        </td>
                        <td>
                            <input type="text" name="fb" value="<?php echo $fb;?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Twitter</label>
                        </td>
                        <td>
                            <input type="text" name="tw" value="<?php echo $tw;?>"  class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>LinkedIn</label>
                        </td>
                        <td>
                            <input type="text" name="ln" value="<?php echo $ln;?>"  class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Google Plus</label>
                        </td>
                        <td>
                            <input type="text" name="gp" value="<?php echo $gp;?>"  class="medium" />
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
        </div>
    </div>
</div>
<div class="clear">
</div>

<?php
include 'a_inc/a_footer.php';
?>