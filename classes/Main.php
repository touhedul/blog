<?php

class Main{
    
    public static function readAll($table){
        $sql = "SELECT * FROM $table";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    
    
    
    
    public static function chkRowNumber($sql){
        $result = DB::prepare($sql);
        $result->execute();
        $number_of_rows = $result->rowCount();
        return $number_of_rows;
    }
}
?>

