<?php

class Exist{
    public static function chkExist($t_name,$key,$value) {
        $sql = "SELECT $key FROM $t_name where $key = :value";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':value',$value);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
?>
