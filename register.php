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
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
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
        </div>

        <div class="collapse navbar-collapse" id="crud-main-navbar">
            <ul class="nav navbar-nav crudNav">
                <li>
                    <a href="index.php">Home <i class="fa fa-home"></i></a>
                </li>
                <li>
                    <a href="register.php">Registration <i class="fa fa-user"></i></a>
                </li>
                <li>
                    <a href="login.php">Login <i class="fa fa-sign-in"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</div>

    <div class="container">
        <div class="jumbotron">
            <h3 class="alignCenter">Please Register</h3>
        </div>
    </div>

    <div class="registrationArea">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
            <form role="form" action="app/view/register-process.php" method="post">
                <div class="form-group">
                    <label for="uName">User Name:</label>
                    <input
                        name="username"
                        type="text"
                        class="form-control"
                        id="uName"
                        placeholder="please enter your user name"
                        >
                </div>

                <div class="form-group">
                    <label for="eml">Email:</label>
                    <input
                        name="email"
                        type="email"
                        class="form-control"
                        id="eml"
                        placeholder="please enter your email address"
                        >
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input
                        name="password"
                        type="password"
                        class="form-control"
                        id="pwd"
                        placeholder="please enter your password"
                        >
                </div>

                <button type="submit" class="btn btn-default">Register</button>
            </form>
                    </div>
                </div>

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