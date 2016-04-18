<?php
session_start();

include_once '../../vendor/autoload.php';

use app\src\User;
use app\utility\Message;
//
//echo '<pre>';
//var_dump($_FILES);
//exit();

$user = new User();

$userPicture = $user->prepare($_GET)->editProfile();

if (!$user->getSession()) {
    header('location:login.php');
}


/**
 * Image uploading
 */
if (isset($_FILES['profile_pic'])) {
    $errors = array();

    $fileName = time().$_FILES['profile_pic']['name'];
    $fileType = $_FILES['profile_pic']['type'];
    $tmpName = $_FILES['profile_pic']['tmp_name'];
    $fileSize = $_FILES['profile_pic']['size'];

    $fileExtArrToString = explode('.', $_FILES['profile_pic']['name']);
    $fileExt = strtolower(end($fileExtArrToString));

    $formats = array('jpg', 'jpeg', 'png');

    if (in_array($fileExt, $formats) == false) {
        $errors[] = "You have entered wrong format photo";
    }

    if ($fileSize > 8097152) {
        $errors[] = "You have uploaded large size photo";
    }

    if (empty($errors) == true) {
//        unlink($_SERVER['DOCUMENT_ROOT'] . '/mini-project-reg/assets/img/' . $userPicture['profile_pic']);
        move_uploaded_file($tmpName, '../../assets/img/' . $fileName);
        $_POST['profile_pic'] = $fileName;
    } else {
        print_r($errors);
    }

}


$user->prepare($_POST)->updateProfile();

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Update profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../assets/css/bootstrap-theme.min.css" rel="stylesheet" />
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../../assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../../assets/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="../../assets/css/jquery-ui.structure.min.css" rel="stylesheet" />
    <link href="../../assets/css/jquery-ui.theme.min.css" rel="stylesheet" />
    <link href="../../assets/css/animate.css" rel="stylesheet" />
    <link href="../../assets/css/style.css" rel="stylesheet" />
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
                            <a href="../../dashboard.php">Dashboard <i class="fa fa-home"></i></a>
                        </li>
                        <li>
                            <a href="../../logout.php">Logout <i class="fa fa-user"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="jumbotron">
            <h3 class="alignCenter animated zoomIn">
                <?php echo Message::message(); ?>
            </h3>
        </div>
    </div>

    <?php
    include_once '../../content-part.php';
    footerContent();
    ?>

    <script src="../../assets/js/jquery-v2.2.2.js"></script>
    <script src="../../assets/js/jquery-migrate-v1.2.1.js"></script>
    <script src="../../assets/js/jquery-ui.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/scripts.js"></script>

</body>
</html>