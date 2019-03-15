<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>

<?php
$msg = "";
if (isset($_POST['send'])) {
    $to = Validation::validate($_POST['to']);
    $from = Validation::validate($_POST['from']);
    $subject = Validation::validate($_POST['subject']);
    $message = Validation::validate($_POST['message']);
    if ($to == "" || $from == "" || $message == "" || $subject == "") {
        $msg = $msg = "<span style='color : red'>ERROR! Field cannot be Empty!!!</span>";
    } elseif (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
        $msg = "<span style='color : red'>ERROR! Invalid Email!!!</span>";
    }elseif (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
        $msg = "<span style='color : red'>ERROR! Invalid Email!!!</span>";
    }else{
        $sendmail = mail($to,$subject,$message, $from);
        if($sendmail){
            $msg = $msg = "<span style='color : green'>Send Successful!!!</span>";
        }else{
             $msg = "<span style='color : red'>ERROR! Something went wrong.!!</span>";
        }
    }
}
if (isset($_GET['contact_id'])) {
    $contact_id = Validation::validate($_GET['contact_id']);
    $getContact = $contact->getContactById($contact_id);
    if ($getContact) {
        $email = $getContact['contact_email'];
    } else {
        echo "<script>window.location = '404.php';</script>";
    }
} else {
    echo "<script>window.location = '404.php';</script>";
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Message</h2>
        <?php echo '<h2>'.$msg.'</h2>';?>
        <div class="block">
            <form action = "" method = "POST">
                <table class = "form">

                    <tr>
                        <td>
                            <label>To</label>
                        </td>
                        <td>
                            <input type="text" readonly="1" name="to" value="<?php echo $email; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>From</label>
                        </td>
                        <td>
                            <input type="text"  name="from" placeholder="Enter your email..." />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Subject</label>
                        </td>
                        <td>
                            <input type="text"  name="subject" placeholder="Enter your Subject..." />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea name="message" rows="15" cols="70"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="send" Value="Send" />
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

