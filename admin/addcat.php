<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>

<?php
$msg = "";
if(isset($_POST['addCategory'])){
    $category_name = Validation::validate($_POST['category_name']);
    if($category_name == "" OR strlen($category_name)>20){
        $msg = '<span style="color: red">Invalid Category</span>';
    }else{
        if($category->insertCategory($category_name)){
            $msg = '<span style="color: green">Cahegory insertion Successful.</span>';
        }else{
            $msg = '<span style="color: red">Cahegory insertion Failed</span>';
        }
    }
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock"> 
            <?php echo $msg;?>
            <form action="" method="POST">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" placeholder="Enter Category Name..." name="category_name" class="medium" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="addCategory" Value="Save" />
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