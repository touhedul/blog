<?php
include '../classes/Users.php';
include_once '../classes/Session.php';
;
Session::chkLogin();
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
    <?php $msg = ""; ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['recover'])) {
        $user = new Users();
        $msg = $user->recoverPassword($_POST);
    }
    ?>

    <div class="container">
        <section id="content">
            <h2><?php echo $msg; ?></h2>
            <form action="" method="post">
                <h1>Password Recovery</h1>
                <div>
                    <input type="text" placeholder="Enter your Email..." required="" name="email"/>
                </div>
                <div>
                    <input type="submit" name="recover" value="Recover" />
                </div>
            </form><!-- form -->
            <a href="login.php">Login !</a>
            <div class="button">
                <a href="#">My First Blog</a>
            </div><!-- button -->
        </section><!-- content -->
    </div><!-- container -->
</body>
</html>