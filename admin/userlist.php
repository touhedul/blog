<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>

<?php
$dltmsg = "";
if (isset($_GET['user_id'])) {

    if (!Session::get("userRole") == 0) {
        echo "<script>window.location = '404.php';</script>";
    } else {
        $user_id = Validation::validate($_GET['user_id']);
        if (Exist::chkExist("users", "user_id", $user_id)) {
            $user->deleteUser($user_id);
            $dltmsg = '<span style="color: green">Delete Successful.</span>';
        } else {
            echo "<script>window.location = 'userlist.php';</script>";
        }
    }
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <?php echo "<h2>$dltmsg</h2>"; ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Details</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $alluser = Main::readAll("users");
                    $i = 0;
                    foreach ($alluser as $s) {
                        $i++;
                        if ($s['user_role'] == 0)
                            $u_role = "Admin";
                        elseif ($s['user_role'] == 1)
                            $u_role = "Author";
                        elseif ($s['user_role'] == 2)
                            $u_role = "Editor";

                        echo '<tr class="odd gradeX">
                        <td>' . $i . '</td>
                        <td>' . $s['user_name'] . '</td>
                        <td>' . $s['username'] . '</td>
                        <td>' . $s['user_email'] . '</td>
                        <td>' . $fm->formatText($s['user_details'], 20) . '</td>
                        <td>' . $u_role . '</td>
                        <td> <a href="view_user_profile.php?user_id=' . $s['user_id'] . '">View</a> ';
                        if (Session::get("userRole") == 0)
                            echo '||<a onclick="return confirm(\'Are you sure you want to Delete this?\')" href="?user_id=' . $s['user_id'] . '">Delete</a></td>
                        </tr>';
                    }
                    ?>

                </tbody>
            </table>
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
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>