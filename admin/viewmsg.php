<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>

<?php

if(isset($_POST['ok'])){
    echo "<script>window.location = 'inbox.php';</script>";
}
if(isset($_GET['contact_id'])){
    $contact_id = Validation::validate($_GET['contact_id']);
    $getContact = $contact->getContactById($contact_id);
    if($getContact){
        $name = $getContact['contact_name'];
        $email = $getContact['contact_email'];
        $message = $getContact['contact_message'];
    } else {
        echo "<script>window.location = '404.php';</script>";
    }
}else{
    echo "<script>window.location = '404.php';</script>";
}

?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Message</h2>
        <div class="block">
            <form action = "" method = "POST">
                <table class = "form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <?php echo $name;?>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                           <?php echo $email;?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea rows="15" cols="70"><?php echo $message;?></textarea>
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



<?php
include 'a_inc/a_footer.php';
?>

