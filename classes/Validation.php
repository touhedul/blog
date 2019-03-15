<?php
class Validation{
    public static function validate($data){
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        $data = trim($data);
       // $data = mysqli_real_escape_string($data);
        return $data;
    }
}
?>

