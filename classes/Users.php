
<?php

include_once 'Validation.php';
include_once 'Exist.php';
include_once 'DB.php';

class Users {

    private $table = "users";

    public function userLogin($data) {
        $username = Validation::validate($data['username']);
        $password = Validation::validate($data['password']);
        $password = md5($password);
        $msg = "";
        $sql = "SELECT * from $this->table where username = :u AND password = :p";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':u', $username);
        $stmt->bindParam(':p', $password);
        $stmt->execute();
        $loginResult = $stmt->fetch(PDO::FETCH_OBJ);

        if ($loginResult) {
            Session::init();
            Session::set("login", true);
            Session::set("user_id", $loginResult->user_id);
            Session::set("username", $loginResult->username);
            Session::set("userRole", $loginResult->user_role);
            header('location: index.php');
        } else {
            $msg = "<div class='alert alert-danger'> ERROR ! Invalid Username or Password.</div>";
            return $msg;
        }
    }

    public function createUser($data) {
        $username = Validation::validate($data['username']);
        $password = Validation::validate($data['password']);
        if (strlen($password) < 8) {
            $msg = "<span style='color : red'>ERROR! Password must be at least 8 character!!!</span>";
            return $msg;
        }

        $password = md5($password);
        $role = Validation::validate($data['role']);
        $msg = "";
        if ($username == "" || $password == "" || $role == "") {
            $msg = "<span style='color : red'>ERROR! Field cannot be Empty!!!</span>";
        } elseif (strlen($username) < 3 || $role < 0 || $role > 2) {
            $msg = "<span style='color : red'>ERROR! Mismatch Length!!!</span>";
        } else {
            $sql = "INSERT INTO users(username,password,user_role) values(:u,:p,:r)";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':u', $username);
            $stmt->bindParam(':p', $password);
            $stmt->bindParam(':r', $role);
            $stmt->execute();
            $msg = "<span style='color : green'>User Create Successful.</span>";
        }
        return $msg;
    }

    public function getUserInfo($user_id) {
        $sql = "SELECT * FROM $this->table where  user_id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateUserInfo($data, $user_id) {
        $username = Validation::validate($data['username']);
        $user_name = Validation::validate($data['user_name']);
        $user_email = Validation::validate($data['user_email']);
        $user_details = Validation::validate($data['user_details']);
        $msg = "";
        if ($username == "" || $user_name == "" || $user_email == "" || $user_details == "") {
            $msg = "<span style='color : red'>ERROR! Field cannot be Empty!!!</span>";
        } elseif (strlen($username) > 50 || strlen($user_name) > 50 || strlen($user_details) < 5 || strlen($user_email) > 50) {
            $msg = "<span style='color : red'>ERROR! Mismatch Length!!!</span>";
        } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $msg = "<span style='color : red'>ERROR! Invalid Email!!!</span>";
        } else {

            $sql = "UPDATE $this->table set user_name = :u_name, username=:u, user_email = :ue,user_details = :ud where user_id = :ui";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':u', $username);
            $stmt->bindParam(':u_name', $user_name);
            $stmt->bindParam(':ue', $user_email);
            $stmt->bindParam(':ud', $user_details);
            $stmt->bindParam(':ui', $user_id);
            $stmt->execute();
            $msg = "<span style='color : green'>User Update Successful.</span>";
        }
        return $msg;
    }

    public function deleteUser($user_id) {

        $sql = "DELETE FROM $this->table where user_id=:ui";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':ui', $user_id);
        $stmt->execute();
    }

    public function getUserInfoByEmail($user_email) {

        $sql = "Select * FROM $this->table where user_email=:ue";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':ue', $user_email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function recoverPassword($data) {
        $email = Validation::validate($data['email']);
        $msg = "";
        if ($email == "") {
            $msg = "<span style='color : red'>ERROR! Field cannot be Empty!!!</span>";
        } elseif (strlen($email) > 50) {
            $msg = "<span style='color : red'>ERROR! Mismatch Length!!!</span>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "<span style='color : red'>ERROR! Invalid Email!!!</span>";
        } elseif (!Exist::chkExist("users", "user_email", $email)) {
            $msg = "<span style='color : red'>ERROR! Email Does not exist!!!</span>";
        } else {
            $userInfo = self::getUserInfoByEmail($email);
            if ($userInfo) {
                $text = substr($email, 0, 3);
                $rand = rand(10000, 99999);
                $newpass = "$text$rand";
                $password = md5($newpass);
                $sql = "UPDATE $this->table set password=:p where user_email = :ue";
                $stmt = DB::prepare($sql);
                $stmt->bindParam(':p', $password);
                $stmt->bindParam(':ue', $user_email);
                $stmt->execute();
                $to = $email;
                $from = "myfirstblog@gmail.com";
                $subject = "Your Password";
                $message = "YOUR password is " . $newpass;
                $sendmail = mail($to, $subject, $message, $from);
                if ($sendmail) {
                    $msg = "<span style='color : green'>ERROR! password send to your mail!!!</span>";
                } else {
                    $msg = "<span style='color : red'>ERROR! Something Wrond!!!</span>";
                }
            }
        }
        return $msg;
    }

    public function getLoginPass() {
        $user_id = Session::get("user_id");
        $sql = "SELECT password from $this->table where user_id=:ui";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':ui', $user_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function changePassword($data) {
        $user_id = Session::get("user_id");
        $oldPass = Validation::validate($data['oldPass']);
        $newPass = Validation::validate($data['newPass']);
        $newConPass = Validation::validate($data['newConPass']);
        $getLoginPass = self::getLoginPass();
        if (md5($oldPass) == $getLoginPass['password']) {
            if ($newPass == $newConPass) {
                if (strlen($newPass) >= 8) {
                    $password = md5($newPass);
                    $sql = "UPDATE $this->table set password = :p  where user_id=:ui";
                    $stmt = DB::prepare($sql);
                    $stmt->bindParam(':ui', $user_id);
                    $stmt->bindParam(':p', $password);
                    $stmt->execute();
                    $msg = "<span style='color : green'>Password Changed!!!</span>";
                } else {
                    $msg = "<span style='color : red'>ERROR! Password Should be at least 8 character!!!</span>";
                }
            } else {
                $msg = "<span style='color : red'>ERROR! Mismatch password!!!</span>";
            }
        } else {
            $msg = "<span style='color : red'>ERROR! Mismatch password!!!</span>";
        }
        return $msg;
    }

}
