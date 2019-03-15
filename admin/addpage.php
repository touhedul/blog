<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>
<?php
$msg = "";
if(isset($_POST['create'])){
    $msg = $page->createPage($_POST);
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Page</h2>
        <div class="block">
            <?php echo '<h2>'.$msg.'</h2>';?>
            <form action = "" method = "POST">
                <table class = "form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type = "text" name = "page_name" placeholder = "Enter Page Name..." class = "medium" />
                        </td>
                    </tr>


                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" rows="10" cols="60" name="page_body"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="create" Value="Save" />
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