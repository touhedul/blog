<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>

<?php
$dltmsg = "";
$loginUser_id = Session::get("user_id");

if (isset($_GET['post_id']) && isset($_GET['u_id'])) {

    $u_id = Validation::validate($_GET['u_id']);
    $post_id = Validation::validate($_GET['post_id']);
    if ($loginUser_id == $u_id) {
        if ($loginUser_id == $post->getUserIdByPostId($post_id)['user_id']) {
            if (Exist::chkExist("posts", "post_id", $post_id)) {
                $post->deletePost($post_id);
                $dltmsg = '<span style="color: green">Delete Successful.</span>';
            } else {
                echo "<script>window.location = 'postlist.php';</script>";
            }
        } else {
            echo "<script>window.location = '404.php';</script>";
        }
    } else {
        echo "<script>window.location = '404.php';</script>";
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
                        <th>Post Title</th>
                        <th>Posted At</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $allPostWithCategeoy = $post->allPostWithCategory();
                    $i = 0;
                    $vd = "";
                    foreach ($allPostWithCategeoy as $s) {
                        $i++;
                        if ($user_id == $s['user_id']) {
                            $vd = TRUE;
                        }
                        echo '<tr class="odd gradeX">
                        <td>' . $i . '</td>
                        <td>' . $s['post_title'] . '</td>
                        <td>' . $fm->formatDate($s['post_date']) . '</td>
                        <td>' . $fm->formatText($s['post_body'], 20) . '</td>
                        <td>' . $s['category_name'] . '</td>
                        <td> <img src = "upload/' . $s['post_image'] . '" height = "50px" width="100px" alter="No Image"/> </td>
                        <td><a href="viewpost.php?post_id=' . $s['post_id'] . '">View</a> ';

                        if ($vd == TRUE) {
                            echo '|| <a href="editpost.php?post_id=' . $s['post_id'] . '">Edit</a>'
                            . '|| <a href="?post_id=' . $s['post_id'] . '&u_id=' . $s['user_id'] . '">Delete</a></td>
                        </tr>';
                        }
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