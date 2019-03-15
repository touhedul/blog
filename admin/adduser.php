<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
if(!Session::get("userRole") == 0){
    echo "<script>window.location = 'index.php';</script>";
}
?>

<?php
$msg = "";
if(isset($_POST['createUser'])){
    $msg = $user->createUser($_POST);
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block copyblock"> 
            <?php echo $msg;?>
            <form action="" method="POST">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" placeholder="Enter Username..." name="username" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" placeholder="Enter Password..." name="password" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="role">
                                <option value="">Select Role</option>
                                <option value="0">Admin</option>
                                <option value="1">Author</option>
                                <option value="2">Editor</option>
                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="createUser" Value="Create" />
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