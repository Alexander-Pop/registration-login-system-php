<?php

namespace app\src;

use PDO;
use PDOException;
use app\utility\Message;

class User
{
    public $conn = '';
    public $dbUsserName = 'root';
    public $dbPass = '';
    public $id = '';
    public $uniqueID = '';
    public $firstName = '';
    public $lastName = '';
    public $profilePic = ''; 
    public $userName = '';
    public $email = '';
    public $password = '';
    public $md5Pass = '';
    public $personalPhone ='';
    public $homePhone = '';
    public $officePhone = '';
    public $currentAddress = '';
    public $permanentAddress = '';


    /**
     * User constructor.
     */
    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:host=localhost;dbname=miniprojectreg', $this->dbUsserName, $this->dbPass);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }


    /**
     * @param array $data
     * @return $this
     */
    public function prepare($data = array())
    {
        if (is_array($data) && array_key_exists('id', $data)) {
            $this->id = $data['id'];
        }
        if (is_array($data) && array_key_exists('unique_id', $data)) {
            $this->uniqueID = $data['unique_id'];
        }

        if (is_array($data) && array_key_exists('username', $data)) {
            $this->userName = $data['username'];
        }

        if (is_array($data) && array_key_exists('email', $data)) {
            $this->email = $data['email'];
        }

        if (is_array($data) && array_key_exists('password', $data)) {
            $this->password = $data['password'];
            $this->md5Pass = md5($data['password']);
        }

        if (is_array($data) && array_key_exists('first_name', $data)) {
            $this->firstName = $data['first_name'];
        }

        if (is_array($data) && array_key_exists('last_name', $data)) {
            $this->lastName = $data['last_name'];
        }

        if (is_array($data) && array_key_exists('profile_pic', $data)) {
            $this->profilePic = $data['profile_pic'];
        }

        if (is_array($data) && array_key_exists('personal_phone', $data)) {
            $this->personalPhone = $data['personal_phone'];
        }

        if (is_array($data) && array_key_exists('home_phone', $data)) {
            $this->homePhone = $data['home_phone'];
        }

        if (is_array($data) && array_key_exists('office_phone', $data)) {
            $this->officePhone = $data['office_phone'];
        }

        if (is_array($data) && array_key_exists('current_address', $data)) {
            $this->currentAddress = $data['current_address'];
        }

        if (is_array($data) && array_key_exists('permanent_address', $data)) {
            $this->permanentAddress = $data['permanent_address'];
        }

        return $this;

    }


    /**
     * user registration method with validations
     */
    public function register()
    {
        try {

            //validation for empty fields
            if (empty($this->userName) || empty($this->email) || empty($this->password)) {
                Message::message('<span class="errorMsg">Fields must not be empty!!!</span>');
            }

            //validation for username
            elseif (preg_match('/\W/', $this->userName)) {
                Message::message('<span class="errorMsg">The username must not contain white space or special characters!!!</span>');
            }

            //validation for email
            elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                Message::message('<span class="errorMsg">This is not a valid email address!!!</span>');

            }else {
                //validation for existing user
                $ckeckUser = $this->conn->prepare("SELECT * FROM `users` WHERE username = ? OR email = ?");
                $ckeckUser->execute(array($this->userName, $this->email));
                $row = $ckeckUser->rowCount();

                if ($row == 0) {
                    //successfully data insert
                    $uniqueID = uniqid();
                    $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, unique_id) VALUES (:username, :email, :password, :uniqueID)");
                    $stmt->bindParam(':username', $this->userName);
                    $stmt->bindParam(':email', $this->email);
                    $stmt->bindParam(':password', $this->password);
                    $stmt->bindParam(':uniqueID', $uniqueID);

                    if ($stmt->execute()) {
                        Message::message('<span class="successMsg">Registration was successful!!!</span>');
                        $lastId = $this->conn->lastInsertId();
                        $stmt = $this->conn->prepare("INSERT INTO profiles (user_id) VALUES (:id)");
                        $stmt->bindParam(':id', $lastId);
                        $stmt->execute();
                        $this->conn->commit();

                    } else {
                        Message::message('<span class="errorMsg">There was a problem while registering!!!</span>');

                    }

                } else {
                    Message::message('<span class="errorMsg">Username/email address already exists!!!</span>');

                }

            }

        } catch (PDOException $e) {
            $e->getMessage();
        }

    }


    /**
     *
     */
    public function login()
    {
        try {

            //validation for empty fields
            if (empty($this->email) || empty($this->password)) {
                Message::message('<span class="errorMsg">Fields must not be empty!!!</span>');

            } else {
                $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE email =? AND password =? ");
                $stmt->execute(array($this->email, $this->password));
                $userData = $stmt->fetch();
                $row = $stmt->rowCount();
                
                if ($row == 1) {
                    session_start();
                    $_SESSION['login'] = true;
                    $_SESSION['uid'] = $userData['id'];
                    $_SESSION['uname'] = $userData['username'];
                    $_SESSION['uemail'] = $userData['email'];
                    Message::message('<span class="successMsg">Login successfully</span>');
                    //return true;
                    header('refresh:1;http://localhost/mini-project-reg/dashboard.php');
                }
                else {
                    Message::message('<span class="errorMsg">Email or password did not match!!!</span>');

                }
                
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }


    /**
     * @return array
     */
    public function getAllUser()
    {
        $stmt = $this->conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $allUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $allUsers;
    }


    /**
     * @param $id
     * @return bool
     */
    public function isAdmin($id)
    {
        $one = 1;
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE is_active =? AND id =?");
        $stmt->execute(array($one, $id));
        $stmt->fetch(PDO::FETCH_ASSOC);
        $row = $stmt->rowCount();
        
        if ($row == 1) {
            return true;

        } else {
            return false;

        }
        
    }

    /**
     * @return mixed
     */
    public function viewProfile()
    {
        $stmt = $this->conn->prepare("SELECT p.first_name, p.last_name, u.username, u.email, p.personal_phone, p.home_phone, p.office_phone, p.current_address, p.permanent_address FROM users u JOIN profiles p ON u.id = p.user_id WHERE u.id = :id");

        $stmt->execute(array(':id' => $this->id));
        $singleUser = $stmt->fetch(PDO::FETCH_ASSOC);

        return $singleUser;
        
    }



    /**
     * @return mixed
     */
    public function getSession()
    {
        return @$_SESSION['login'];
    }


    /**
     * @return mixed
     */
    public function editProfile()
    {
        $stmt = $this->conn->prepare("SELECT p.first_name, p.last_name, p.profile_pic, u.id, u.username, u.email, p.personal_phone, p.home_phone, p.office_phone, p.current_address, p.permanent_address FROM users u JOIN profiles p ON u.id = p.user_id WHERE u.id = :id");

        $stmt->execute(array(':id' => $this->id));
        $singleUser = $stmt->fetch(PDO::FETCH_ASSOC);

        return $singleUser;
    }

    public function updateProfile()
    {
        try {
            $stmt = $this->conn->prepare("UPDATE users u JOIN profiles p ON u.id = p.user_id SET p.first_name = '".$this->firstName."', p.last_name = '".$this->lastName."', p.profile_pic = '".$this->profilePic."', u.username = '".$this->userName."', u.email = '".$this->email."', p.personal_phone = $this->personalPhone, p.home_phone = $this->homePhone, p.office_phone = $this->officePhone, p.current_address = '".$this->currentAddress."', p.permanent_address = '".$this->permanentAddress."' WHERE u.id = :id");

            $stmt->bindParam(':id', $this->id);

            if ($stmt->execute()) {
                Message::message('<span class="successMsg">Profile updated successfully</span>');

            } else {
                Message::message('<span class="errorMsg">There was problem while updating user profile</span>');

            }
            
        } catch (PDOException $e) {
            $e->getMessage();
        }
        

    }

    public function logOut()
    {
        try {
            $_SESSION['login'] = false;
            unset($_SESSION['uid']);
            unset($_SESSION['uname']);
            unset($_SESSION['uemail']);
            session_destroy();
            Message::message('<span class="successMsg">Logout Successfully</span>');
            header('refresh:1;http://localhost/mini-project-reg/login.php');

        } catch (PDOException $e) {
            $e->getMessage();
        }

    }
    


}