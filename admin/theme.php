<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>
<?php
$msg = "";

if (isset($_POST['change'])) {
    $theme_name = Validation::validate($_POST['theme']);
    if ($theme_name == "" OR strlen($theme_name) > 10) {
        $msg = '<span style="color: red">Invalid Theme Name</span>';
    } else {
        $theme->updateTheme($theme_name);
        $msg = '<span style="color: green">Theme Update Successful.</span>';
    }
}
$allTheme = $theme->getTheme();
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Theme</h2>
        <div class="block copyblock"> 
            <?php echo '<h3>' . $msg . '</h3>'; ?>
            <form action="" method="POST">
                <table class="form">					
                    <tr>
                        <td>
                            <input <?php if($allTheme['theme_name'] == "default")echo 'checked';?> type="radio" name="theme" value="default" />Default
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input <?php if($allTheme['theme_name'] == "green")echo 'checked';?> type="radio" name="theme" value="green" />Green
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="change" Value="Change" />
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