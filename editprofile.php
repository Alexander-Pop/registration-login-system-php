<?php
session_start();

include_once 'vendor/autoload.php';

use app\src\User;

$user = new User();

if (!$user->getSession()) {
    header('location:login.php');
}

$singleuser = $user->prepare($_GET)->editProfile();

//user data from session if need we can use
$id = $_SESSION['uid'];
$username = $_SESSION['uname'];

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

    <div class="container">
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="alignCenter">Edit profile of:
                        <?php
                        if (isset($singleuser['first_name']) && isset($singleuser['last_name'])) {
                            echo $singleuser['first_name'] . "\n". $singleuser['last_name'];
                        } else {
                            echo $singleuser['username'];
                        }
                        ?>

                    </h3>
                </div>

                <div class="col-md-4">
                    <div class="profilePic">
                        <img
                            src="<?php echo 'assets/img/' . $singleuser['profile_pic']; ?>"
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
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form action="./app/view/updateprofile.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="fName">First Name:</label>
                        <input type="text" name="first_name" id="fName" value="<?php echo $singleuser['first_name']; ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="lName">Last Name:</label>
                        <input type="text" name="last_name" id="lName" value="<?php echo $singleuser['last_name']; ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="pPic">Profile Picture:</label>
                        <input type="file" name="profile_pic" id="pPic" class="btn btn-default" value=""  />
                    </div>
                    <div class="form-group">
                        <label for="uName">Username:</label>
                        <input type="text" name="username" id="uName" value="<?php echo $singleuser['username']; ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="email">eamil:</label>
                        <input type="email" name="email" id="email" value="<?php echo $singleuser['email']; ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="phone">Personal Phone:</label>
                        <input type="number" name="personal_phone" id="phone" value="<?php echo $singleuser['personal_phone']; ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="hPhone">Home Phone:</label>
                        <input type="number" name="home_phone" id="hPhone" value="<?php echo $singleuser['home_phone']; ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="oPhone">Office Phone:</label>
                        <input type="number" name="office_phone" id="oPhone" value="<?php echo $singleuser['office_phone']; ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="cAddrs">Current Address:</label>
                        <input type="text" name="current_address" id="cAddrs" value="<?php echo $singleuser['current_address']; ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="pAddrs">Permanent Address:</label>
                        <input type="text" name="permanent_address" id="pAddrs" value="<?php echo $singleuser['permanent_address']; ?>" class="form-control" />
                    </div>

                    <input type="hidden" name="id" value="<?php echo $singleuser['id'];  ?>" />
                    <button type="submit" class="btn btn-default">Update</button>
                    <button type="reset" class="btn btn-default">Reset</button><br/><br/>
                </form>
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