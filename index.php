<?php
session_start();

include_once 'vendor/autoload.php';

use app\src\User;

$user = new User();

    if ($user->getSession()) {
        header('location:dashboard.php');
    }
?>

<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Mini Project | Register Login</title>
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div class="headerArea">
        <nav class="navbar navbarBg">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#crud-main-navbar" aria-expanded="false">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
    
                <div class="collapse navbar-collapse" id="crud-main-navbar">
                    <ul class="nav navbar-nav crudNav">
                        <li>
                            <a href="register.php">Register <i class="fa fa-user"></i></a>
                        </li>
                        <li>
                            <a href="login.php">Login <i class="fa fa-sign-in"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="jumbotron">
            <h3 class="alignCenter">Mini Project - Registration and Login system</h3>
        </div>
    </div>


    <?php
    include_once './content-part.php';
    footerContent();
    ?>
    
    <script src="assets/js/jquery-v2.2.2.js"></script>
    <script src="assets/js/jquery-migrate-v1.2.1.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>
</html>