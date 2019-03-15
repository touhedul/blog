
<?php

class Theme {

    private $table = "theme";


    public function updateTheme($theme_name) {
        $sql = "UPDATE $this->table set theme_name = :theme_name where theme_id = 1";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':theme_name', $theme_name);
        $stmt->execute();
    }
    
    public function getTheme() {
        $sql = "SELECT * FROM $this->table where theme_id = 1";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    

}
?>

