<?php

include_once('DbConnect.php');

class Register extends DbConnect
{
    const SALT = 'xWpgc?$e23R4@K*}|nmsQ9q~j:He+&qj7vbP8ns0WssRtL9!';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Register new user
     */
    public function userRegister()
    {
        $db = $this->db;
        $firstName = $_POST['first_name'];
        $username = $_POST['last_name'];
        $email = $_POST['email'];
        $date = date('Y-m-d', strtotime($_POST['dob']) );
        $password = $_POST['password'];
        $hashPassword = md5($password . self::SALT);

        // Query for validation of email-id
        $ret = "SELECT * FROM users where (email=:uemail)";
        $queryt = $db->prepare($ret);
        $queryt->bindParam(':uemail', $email, PDO::PARAM_STR);
        $queryt->execute();
        $results = $queryt->fetchAll(PDO::FETCH_OBJ);

        if ($queryt->rowCount() == 0) {

            $sql = "INSERT INTO users(`first_name`, `last_name`, `email`, `dob`, `password`) VALUES(:fname, :lname, :uemail, :udob, :upassword)";
            $query = $db->prepare($sql);

            // Binding Post Values
            $query->bindParam(':fname', $firstName, PDO::PARAM_STR);
            $query->bindParam(':lname', $username, PDO::PARAM_STR);
            $query->bindParam(':uemail', $email, PDO::PARAM_STR);
            $query->bindParam(':udob', $date, PDO::PARAM_STR);
            $query->bindParam(':upassword', $hashPassword, PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $db->lastInsertId();

            if ($lastInsertId) {
                session_start();
                $_SESSION['email'] = $_POST['email'];
                header("Location:dashboard.php");
            } else {
                $error = "Something went wrong.Please try again";
            }

        } else {
            $error = "Email already exist. Please try again";
        }
    }

    /**
     * Check registered user is logging in
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function checkValidLogin(string $email, string $password)
    {
        $password = md5($password . self::SALT);
        $query = 'SELECT COUNT(`id`) FROM  `users` WHERE `email`= :email AND `password`=:password';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->execute();
        return $statement->fetchColumn() > 0;
    }

    /**
     * Check user email is already registered
     *
     * @param string $email
     * @return bool
     */
    public function checkEmailAvailibility(string $email)
    {
        $sql ="SELECT `email` FROM  `users` WHERE `email`=:email";
        $query= $this->db->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        return $query->rowCount() > 0;
    }

    /**
     * Get user name
     *
     * @param string $email
     * @return mixed
     */
    public function getUserName(string $email)
    {
        $query = 'SELECT `first_name` FROM `users` WHERE `email`=:email';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        return $statement->fetchcolumn();
    }



}
