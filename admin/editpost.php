<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>

<?php
$postUpdateMsg = "";
$p_title = "";
$p_body = "";
$c_name = "";
$c_id = "";
$p_image = "";
$p_tag = "";
$p_author = "";



if (isset($_POST['editPost'])) {
    $post_id = Validation::validate($_GET['post_id']);
    $postUpdateMsg = $post->UpdatePost($_POST,$post_id);
}
if (isset($_GET['post_id'])) {

    $post_id = Validation::validate($_GET['post_id']);
    if (Exist::chkExist("posts", "post_id", $post_id)) {
        $postWithCategoryById = $post->postWithCategoryById($post_id);
        $p_title = $postWithCategoryById['post_title'];
        $p_body = $postWithCategoryById['post_body'];
        $c_name = $postWithCategoryById['category_name'];
        $c_id = $postWithCategoryById['category_id'];
        $p_image = $postWithCategoryById['post_image'];
        $p_tag = $postWithCategoryById['post_tag'];
        $p_author = $postWithCategoryById['post_author'];
    } else {
        echo "<script>window.location = 'postlist.php';</script>";
    }
} else {
    echo "<script>window.location = 'postlist.php';</script>";
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Post</h2>
        <div class="block">
            <?php echo '<h2>' . $postUpdateMsg . '</h2>'; ?>
            <form action = "" method = "POST" enctype = "multipart/form-data">
                <table class = "form">

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type = "text" name = "post_title" value="<?php echo $p_title ?>" 
                                   placeholder = "Enter Post Title..." class = "medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id = "select" name = "category_id">
                                <option value="<?php echo $c_id ?>"><?php echo $c_name ?></option>
                                <?php
                                $cat = Main::readAll("category");
                                foreach ($cat as $s) {
                                    echo '<option value="' . $s['category_id'] . '">' . $s['category_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>

                            <img src="upload/<?php echo $p_image ?>" height="50px" width="100px"/>
                            <input type="file" name="img"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;
                            padding-top: 9px;
                            ">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" rows="10" cols="60" name="post_body" value=""><?php echo $p_body ?></textarea>
                        </td>
                    </tr>



                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" id="date-picker" name="post_tag" value="<?php echo $p_tag ?>" />
                        </td>
                    </tr>



                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" readonly="1" name="post_author" value="<?php echo $p_author ?>" id="date-picker" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="editPost" Value="Save" />
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
