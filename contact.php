<?php
include 'inc/header.php';
?>
<?php
$msg = "";
if (isset($_POST['send'])) {
    $msg = $contact->createContact($_POST);
}
?>

<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <div class="about">
            <h2>Contact us</h2>
            <?php echo '<h3>'.$msg.'</h3>' ;?>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td>Your Name:</td>
                        <td>
                            <input type="text" name="name" placeholder="Enter your name" required="1"/>
                        </td>
                    </tr>

                    <tr>
                        <td>Your Email Address:</td>
                        <td>
                            <input type="email" name="email" placeholder="Enter Email Address" required="1"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Your Message:</td>
                        <td>
                            <textarea name="message"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="send" value="Send"/>
                        </td>
                    </tr>
                </table>
            </form>				
        </div>

    </div>
    <?php include 'inc/sidebar.php'; ?>
</div>

<?php include './inc/footer.php'; ?>