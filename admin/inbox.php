<?php
include 'a_inc/a_header.php';
include 'a_inc/a_sidebar.php';
?>
<?php
if (isset($_GET['contact_id'])) {
    $contact_id = Validation::validate($_GET['contact_id']);
    if(Exist::chkExist("contact", "contact_id", $contact_id)) {
        $contact->updateSeen($contact_id);
    } else {
        echo "<script>window.location = '404.php';</script>";
    }
}

if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $contact_id = Validation::validate($_GET['contact_id']);
    if(Exist::chkExist("contact", "contact_id", $contact_id)) {
        $contact->deleteMessage($contact_id);
    } else {
        echo "<script>window.location = '404.php';</script>";
    }
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Time</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $allContact = $contact->getAll();
                    $i = 1;
                    foreach ($allContact as $s) {
                        echo '
                        <tr class="odd gradeX">
                        <td>' . $i . '</td>
                        <td>' . $s['contact_name'] . '</td>
                        <td>' . $s['contact_email'] . '</td>
                        <td>' . $fm->formatDate($s['contact_time']) . '</td>
                        <td>' . $fm->formatText($s['contact_message'], 20) . '</td>
                        <td><a href="viewmsg.php?contact_id=' . $s['contact_id'] . '">View</a> || 
                            <a href="replymsg.php?contact_id=' . $s['contact_id'] . '">Replay</a>|| 
                            <a href="?contact_id=' . $s['contact_id'] . '">Seen</a></td>
                        </tr>';
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="box round first grid">
        <h2>Seen Message</h2>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Time</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $allContact = $contact->getAllSeenMessage();
                    $i = 1;
                    foreach ($allContact as $s) {
                        echo '
                        <tr class="odd gradeX">
                        <td>' . $i . '</td>
                        <td>' . $s['contact_name'] . '</td>
                        <td>' . $s['contact_email'] . '</td>
                        <td>' . $fm->formatDate($s['contact_time']) . '</td>
                        <td>' . $fm->formatText($s['contact_message'], 20) . '</td>
                        <td><a href="viewmsg.php?contact_id=' . $s['contact_id'] . '">View</a> || 
                            <a href="replymsg.php?contact_id=' . $s['contact_id'] . '">Replay</a>|| 
                            <a href="inbox.php?action=delete&contact_id=' . $s['contact_id'] . '">Delete</a>
                        </tr>';
                        $i++;
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