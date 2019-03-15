<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>

<?php
$postSuccess = "";
if (isset($_POST['post'])) {
    $postSuccess = $post->insertPost($_POST);
    
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>
        <div class="block">
            <?php echo '<h2>'.$postSuccess.'</h2>'; ?>
            <form action = "" method = "POST" enctype = "multipart/form-data">
                <table class = "form">

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type = "text" name = "post_title" placeholder = "Enter Post Title..." class = "medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id = "select" name = "category_id">
                                <option>Select</option>
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
                            <input type="file" name="img" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" rows="10" cols="60" name="post_body"></textarea>
                        </td>
                    </tr>



                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" id="date-picker" name="post_tag" />
                        </td>
                    </tr>



                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" name="post_author" value="<?php echo Session::get("username");?>" id="date-picker" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="post" Value="Save" />
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