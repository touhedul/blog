<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>
<?php
$msg = "";

if(isset($_POST['changePassword'])){
    $msg = $user->changePassword($_POST);
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Change Password</h2>
        <?php echo '<h2>'.$msg.'</h2>';?>
        <div class="block">               
            <form action="" method="POST">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Old Password</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Enter Old Password..."  name="oldPass" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>New Password</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Enter New Password..." name="newPass" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Confirm New Password</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Enter New Password..." name="newConPass" class="medium" />
                        </td>
                    </tr>


                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="changePassword" Value="Change" />
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