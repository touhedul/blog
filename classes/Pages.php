<?php

class Pages {

    private $table = "pages";

    public function createPage($data) {
        $page_name = Validation::validate($data['page_name']);
        $page_body = Validation::validate($data['page_body']);
        $msg = "";
        if ($page_name == "" || $page_body == "") {
            $msg = '<span style="color: red">Field cannot be empty</span>';
        } elseif (strlen($page_name) > 50) {
            $msg = '<span style="color: red">Invalid Length./span>';
        } else {
            $sql = "INSERT INTO $this->table(page_name,page_body) values(:pn,:pb)";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':pn', $page_name);
            $stmt->bindParam(':pb', $page_body);
            $stmt->execute();
            $msg = '<span style="color: green">Successful.</span>';
        }
        return $msg;
    }

    public function getPageById($page_id) {
        $sql = "SELECT * FROM $this->table where  page_id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $page_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updatePage($data, $page_id) {
        $page_name = Validation::validate($data['page_name']);
        $page_body = Validation::validate($data['page_body']);
        $msg = "";
        if ($page_name == "" || $page_body == "") {
            $msg = '<span style="color: red">Field cannot be empty</span>';
        } elseif (strlen($page_name) > 50) {
            $msg = '<span style="color: red">Invalid Length./span>';
        } else {
            $sql = "UPDATE $this->table set page_name=:pn, page_body=:pb where page_id = :pid";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':pn', $page_name);
            $stmt->bindParam(':pb', $page_body);
            $stmt->bindParam(':pid', $page_id);
            $stmt->execute();
            $msg = '<span style="color: green">Successful.</span>';
        }
        return $msg;
    }

    public function deletePage($page_id) {
        $sql = "DELETE FROM $this->table where page_id = :pid";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':pid', $page_id);
        $stmt->execute();
        $msg = '<span style="color: red">Delete Successful.</span>';
        return $msg;
    }
    
    public function getPage() {
        $sql = "SELECT page_id,page_name FROM $this->table";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}

?>
