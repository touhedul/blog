<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>

<?php
if (isset($_POST['ok'])) {
    echo "<script>window.location = 'userlist.php';</script>";
}
if (isset($_GET['user_id'])) {
    $user_id = Validation::validate($_GET['user_id']);
    $user_info = $user->getUserInfo($user_id);

    if ($user_info['user_role'] == 0)
        $u_role = "Admin";
    elseif ($user_info['user_role'] == 1)
        $u_role = "Author";
    elseif ($user_info['user_role'] == 2)
        $u_role = "Editor";
}else {
    echo "<script>window.location = 'userlist.php';</script>";
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>
        <div class="block">
            <form action = "" method = "POST">
                <table class = "form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type = "text" readonly="1" name = "user_name" value="<?php echo $user_info['user_name']; ?>" class = "medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input type = "text"  readonly="1" name = "username" value="<?php echo $user_info['username']; ?>" class = "medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="email" readonly="1" name="user_email" value="<?php echo $user_info['user_email']; ?>" class = "medium"/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Role</label>
                        </td>
                        <td>
                            <input type="email" readonly="1" name="user_email" value="<?php echo $u_role; ?>" class = "medium"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Details</label>
                        </td>
                        <td>
                            <textarea class="tinymce" readonly="1" rows="10" cols="60" name="user_details"><?php echo $user_info['user_details']; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="ok" Value="OK" />
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