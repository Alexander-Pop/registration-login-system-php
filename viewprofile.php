<?php
session_start();
include_once 'vendor/autoload.php';

use app\src\User;

$user = new User();

if (!$user->getSession()) {
    header('location:login.php');
}

//user sessions if neeed we can use
$id = $_SESSION['uid'];
$username = $_SESSION['uname'];

$singleuser = $user->prepare($_GET)->viewProfile();

$userPicture = $user->prepare($_GET)->editProfile();
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
            <div class="row">
                <div class="col-md-8">
                    <div class="alignCenter">
                        <h3 class="">Profile of:
                            <?php
                                if (isset($singleuser['first_name']) && isset($singleuser['last_name'])) {
                                echo $singleuser['first_name'] . "\n". $singleuser['last_name'];
                            } else {
                                echo $singleuser['username'];
                            }
                            ?>
                        </h3>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="profilePic">
                        <img
                            src="<?php echo 'assets/img/' . $userPicture['profile_pic']; ?>"
                            alt=""
                            id="profilePic"
                            width="150"
                            height="150">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="singleUser">
            <table class="table table-responsive table-bordered table-hover">
                <tbody>
                    <tr>
                        <th>Fist Name</th>
                        <td><?php echo $singleuser['first_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td><?php echo $singleuser['last_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td><?php echo $singleuser['username']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $singleuser['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Personal Phone</th>
                        <td><?php echo $singleuser['personal_phone']; ?></td>
                    </tr>
                    <tr>
                        <th>Home Phone</th>
                        <td><?php echo $singleuser['home_phone']; ?></td>
                    </tr>
                    <tr>
                        <th>Office Phone</th>
                        <td><?php echo $singleuser['office_phone']; ?></td>
                    </tr>
                    <tr>
                        <th>Current Address</th>
                        <td><?php echo $singleuser['current_address']; ?></td>
                    </tr>
                    <tr>
                        <th>Permanent Address</th>
                        <td><?php echo $singleuser['permanent_address']; ?></td>
                    </tr>
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