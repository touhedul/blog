<?php
include '../classes/Session.php';

include '../classes/Category.php';
include '../classes/Posts.php';
include '../classes/Validation.php';
include '../classes/DB.php';
include '../classes/Main.php';
include '../classes/Exist.php';
include '../classes/TSL.php';
include '../classes/Social.php';
include '../classes/Copyright.php';
include '../classes/Contact.php';
include '../classes/Pages.php';
include '../classes/Users.php';
include '../classes/Theme.php';
include '../classes/Slider.php';
include '../helper/Format.php';

$category = new Category();
$post = new Posts();
$user = new Users();
$tsl = new TSL();
$social = new Social();
$page = new Pages();
$copyright = new Copyright();
$contact = new Contact();
$fm = new Format();
$slider = new Slider();
$theme = new Theme();

if(isset($_GET['action']) && $_GET['action'] == 'logout'){
    Session::destroy();
}
?>


﻿<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title> Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>

</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="img/livelogo.png" alt="Logo" />
				</div>
				<div class="floatleft middle">
					<h1>My First Blog</h1>
					<p>www.myfirstblog.com</p>
				</div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <?php
                            $user_id = Session::get("user_id");
                            $user_info = $user->getUserInfo($user_id);
                            echo '<li>Hello '.$user_info['user_name'].'</li>';
                            ?>
                            
                            <li><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <?php
        //inbox message
        $count_message = "";
        $message = $contact->count();
        $count_message = $message['COUNT(*)'];
        ?>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-dashboard"><a href="theme.php"><span>Theme</span></a> </li>
                <li class="ic-form-style"><a href="user_profile.php"><span>User Profile</span></a></li>
				<li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>
                                <li class="ic-grid-tables"><a href="inbox.php">
                                        <span>Inbox(<?php echo $count_message;?>)</span></a></li>
                 <?php
                 if(Session::get("userRole") == 0){
                     echo '<li class="ic-charts"><a href="adduser.php"><span>Add User</span></a></li>';
                 }
                 ?>                       
                
                <li class="ic-charts"><a href="userlist.php"><span>User List</span></a></li>
            </ul>
        </div>
        <div class="clear">
        </div>