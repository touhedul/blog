<?php
include '../classes/Users.php';
include_once '../classes/Session.php';;
Session::chkLogin();

?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<?php $login = "";?>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $user = new Users();
        $login = $user->userLogin($_POST);
    }
    ?>

    <div class="container">
        <section id="content">
            <h2><?php echo $login;?></h2>
            <form action="" method="post">
                <h1>Admin Login</h1>
                <div>
                    <input type="text" placeholder="Username" required="" name="username"/>
                </div>
                <div>
                    <input type="password" placeholder="Password" required="" name="password"/>
                </div>
                <div>
                    <input type="submit" name="login" value="Log in" />
                </div>
            </form><!-- form -->
            <a href="forget_password.php">Forget Password !</a>
            <div class="button">
                <a href="#">My First Blog</a>
            </div><!-- button -->
        </section><!-- content -->
    </div><!-- container -->
</body>
</html>