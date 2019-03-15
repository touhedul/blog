
<?php

class Category {

    private $table = "category";

    public function insertCategory($category_name) {
        $sql = "INSERT INTO $this->table(category_name) values(:c_n)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':c_n', $category_name);
        $stmt->execute();
        return true;
    }

    public function getCategoryById($c_id) {
        $sql = "SELECT * FROM $this->table where category_id = :c_id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':c_id', $c_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateCategory($c_id, $c_name) {
        $sql = "UPDATE category set category_name = :c_name where category_id = :c_id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':c_name', $c_name);
        $stmt->bindParam(':c_id', $c_id);
        $stmt->execute();
    }
    
    public function deleteCategory($c_id) {
        $sql = "DELETE FROM $this->table where category_id = :c_id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':c_id', $c_id);
        $stmt->execute();
    }

}
?>

