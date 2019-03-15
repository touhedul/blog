
<?php

class Contact {

    private $table = "contact";

    public function createContact($data) {
        $name = Validation::validate($data['name']);
        $email = Validation::validate($data['email']);
        $message = Validation::validate($data['message']);
        $msg = "";
        if ($name == "" || $email == "" || $message == "") {
            $msg = $msg = "<span style='color : red'>ERROR! Field cannot be Empty!!!</span>";
        } elseif (strlen($name) > 50 || strlen($email) > 50) {
            $msg = "<span style='color : red'>ERROR! Mismatch Length!!!</span>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "<span style='color : red'>ERROR! Invalid Email!!!</span>";
        } else {
            $sql = "INSERT INTO $this->table(contact_name,contact_email,contact_message) values(:n,:e,:m)";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':n', $name);
            $stmt->bindParam(':e', $email);
            $stmt->bindParam(':m', $message);
            $stmt->execute();
            $msg = "<span style='color : green'>Send Successful.</span>";
        }
        return $msg;
    }

    public function getContactById($contact_id) {
        $sql = "SELECT * FROM $this->table where  contact_id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $contact_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getAll() {
        $sql = "SELECT * FROM $this->table where  contact_status = 0 order by contact_id desc";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllSeenMessage() {
        $sql = "SELECT * FROM $this->table where  contact_status = 1 order by contact_id desc";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateSeen($contact_id) {
        $sql = "UPDATE $this->table set contact_status = 1 where  contact_id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $contact_id);
        $stmt->execute();
    }

    public function deleteMessage($contact_id) {
        $sql = "DELETE FROM $this->table  where contact_id = :id AND contact_status = 1";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $contact_id);
        $stmt->execute();
    }
    
    public function count() {
        $sql = "SELECT COUNT(*) from $this->table where contact_status = 0";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $contact_id);
        $stmt->execute();
        return $stmt->fetch();
    }

}
