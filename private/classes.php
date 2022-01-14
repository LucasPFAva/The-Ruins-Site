<?php

class DB
{
    protected $connection;
    public function __construct()
    {
        $string = "mysql:host=localhost;dbname=lucaspfava_db";
        $this->connection = new PDO($string, "root", "");
    }

    public function write($query, $data = array())
    {
        $statement = $this->connection->prepare($query);
        $check = $statement->execute($data);

        if ($check) {
            return true;
        }

        return false;
    }

    public function update($query, $data = array())
    {
        $statement = $this->connection->prepare($query);
        $check = $statement->execute($data);

        if ($check) {
            return true;
        }

        return false;
    }

    public function read($query, $data = array())
    {
        $statement = $this->connection->prepare($query);
        $check = $statement->execute($data);

        if ($check) {
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            if (is_array($rows) && count($rows) > 0) {
                return $rows;
            }
        }

        return false;
    }
}

class User
{
    protected $Errors = array();
    public function create($POST)
    {
        $this->Errors = array();
        unset($POST['token']);

        $username = trim(addslashes($POST['username']));
        $email = trim(addslashes($POST['email']));
        $password = trim(addslashes($POST['password']));

        // validation
        // username
        if (empty($username) || !preg_match("/^[a-zA-Z0-9]+$/", $username)) {
            $this->Errors[] = "Please enter a valid username.";
        }

        // email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match("/^[\w\-.]+@[\w\-]+.[\w\-]+$/", $email)) {
            $this->Errors[] = "Please enter a valid email.";
        }

        // password
        if (empty($password) || strlen($password) < 4) {
            $this->Errors[] = "Password must be at least 4 characters.";
        }

        // confirmpassword
        if (trim(addslashes($POST['confirmpassword'])) != $POST['password']) {
            $this->Errors[] = "Passwords do not match.";
        }

        unset($POST['confirmpassword']);

        // check if there already exists someone with the same email or user.
        $db = new DB();
        $usernamecheck = $db->read("select * from users where username = :username limit 1", ['username' => $username]);
        $emailcheck = $db->read("select * from users where email = :email limit 1", ['email' => $email]);
        if ((is_array($usernamecheck) && count($usernamecheck) > 0) || (is_array($emailcheck) && count($emailcheck) > 0))
        {
            $this->Errors[] = "Someone is already using that email or username.";
        }

        // data saving
        if(count($this->Errors) == 0)
        {
            $POST['date'] = date("Y-m-d H:i:s");
            $POST['password'] = hash("sha256", $POST['password']);

            $query = "insert into users (username,email,password,date) values (:username,:email,:password,:date)";
            $db->write($query, $POST);
        }

        return $this->Errors;
    }

    public function login($POST)
    {
        $this->Errors = array();
        unset($POST['token']);

        // If login direct after sign up.
        unset($POST['email']);
        unset($POST['confirmpassword']);


        $POST['password'] = hash("sha256", $POST['password']);

        if (!filter_var($POST['username'], FILTER_VALIDATE_EMAIL) || !preg_match("/^[\w\-.]+@[\w\-]+.[\w\-]+$/", $POST['username'])) {
            $query = "select * from users where username = :username && password = :password limit 1";
        } else {
            $query = "select * from users where email = :username && password = :password limit 1";
        }

        $db = new DB();
        $data = $db->read($query, $POST);
        
        if (is_array($data) && count($data) > 0)
        {
            $_SESSION['id'] = $data[0]['id'];
            $_SESSION['username'] = $data[0]['username'];
        } else {
            $this->Errors[] = "Wrong username or password.";
        }

        return $this->Errors;
    }
}