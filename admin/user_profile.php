<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>

<?php
$updateSuccess = "";
$user_id = Session::get("user_id");
if (isset($_POST['update'])) {
    $updateSuccess = $user->updateUserInfo($_POST,$user_id);
}
$user_info = $user->getUserInfo($user_id);
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Profile</h2>
        <div class="block">
            <?php echo '<h2>' . $updateSuccess . '</h2>'; ?>
            <form action = "" method = "POST">
                <table class = "form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type = "text" name = "user_name" value="<?php echo $user_info['user_name']; ?>" class = "medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input type = "text" name = "username" value="<?php echo $user_info['username']; ?>" class = "medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="email" name="user_email" value="<?php echo $user_info['user_email']; ?>" class = "medium"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Details</label>
                        </td>
                        <td>
                            <textarea class="tinymce" rows="10" cols="60" name="user_details"><?php echo $user_info['user_details']; ?></textarea>
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



<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>