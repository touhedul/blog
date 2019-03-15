<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>
<?php
$msg = "";
if (isset($_POST['update'])) {
    $msg = $copyright->updateCopyrightText($_POST);
}
$getCopyright = $copyright->getCopyrightText();
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <?php echo '<h3>' . $msg . '</h3>'; ?>
        <div class="block copyblock"> 
            <form action="" method="POST">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $getCopyright['copyright_text']; ?>" name="copyright" class="large" />
                        </td>
                    </tr>

                    <tr> 
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