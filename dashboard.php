<?php
session_start();

include_once 'vendor/autoload.php';

use app\src\User;

$user = new User();

if (!$user->getSession()) {
    header('location:login.php');
}

$allUser = $user->prepare($_POST)->getAllUser();

$id = $_SESSION['uid'];
$username = $_SESSION['uname'];
$email = $_SESSION['uemail'];

//var_dump($user->isAdmin($id));
//exit();
?>

<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Mini Project</title>
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
                    <?php if (!$user->getSession()) :; ?>
                    <li>
                        <a href="register.php">Registration</a>
                    </li>
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                    <?php  endif; ?>
                    <li>
                        <a href="dashboard.php">Dashboard</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
    
                </ul>
            </div>
        </div>
    </nav>
</div>

    <div class="container">
        <div class="jumbotron">
            <h3 class="alignCenter">Welcome:
                <?php
                    if ($id == $user->isAdmin($id)) {
                        echo "Admin";
                    } else {
                        echo $username;
                    }
                ?>
            </h3>
        </div>
    </div>
    
    <div class="container">
        <div class="allUser">
            <table class="table table-responsive table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($id == $user->isAdmin($id)) {
                    $slNo = 0;
                    foreach ($allUser as $user) {
                        $slNo++;
                        ?>
                        <tr>
                            <td><?php echo $slNo; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td>
                                <a href="viewprofile.php?id=<?php echo $user['id']; ?>" title="view profile" data-toggle="tooltip">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="editprofile.php?id=<?php echo $user['id']; ?>" title="edit profile" data-toggle="tooltip">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }

                    } else {
                        ?>
                        <tr>
                            <td><?php echo $slNo = 1; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><?php echo $email; ?></td>
                            <td>
                                <a href="viewprofile.php?id=<?php echo $id; ?>" title="view profile" data-toggle="tooltip">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="editprofile.php?id=<?php echo $id; ?>" title="edit profile" data-toggle="tooltip">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        <?php

                            }
                        ?>
                </tbody>
            </table>
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