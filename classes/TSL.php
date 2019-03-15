<?php

class TSL {

    private $table = "tsl";

    public function updateTSL($data) {
        //image validation
        $i = "";
        if ((($_FILES["img"]["type"] == "image/gif") || ($_FILES["img"]["type"] == "image/jpeg") ||
                ($_FILES["img"]["type"] == "image/png")) && ($_FILES["img"]["size"] < 2000000)) {
            if ($_FILES["img"]["error"] > 0) {
                echo "Return Code: " . $_FILES["img"]["error"] . "<br />";
            } else {
                if (file_exists("upload/" . $_FILES["img"]["name"])) {
                    echo $_FILES["img"]["name"] . " already exists. ";
                } else {
                    $tt = uniqid();
                    $t = 1;
                    $i = $tt . $t . $_FILES["img"]["name"];
                    move_uploaded_file($_FILES["img"]["tmp_name"], "upload/$i");
                }
            }
        }
        if($i == ""){
            $tsl = self::getTSL();
            $i = $tsl['tsl_logo'];
        }

        //image validation
        $w_title = Validation::validate($data['w_title']);
        $w_slogan = Validation::validate($data['w_slogan']);
        $msg = "";

        if ($w_title == "" || $w_slogan == "") {
            $msg = "<span style='color : red'>ERROR! Field cannot be Empty!!!</span>";
        } else if (strlen($w_title) > 100 || strlen($w_slogan) > 200) {
            $msg = "<span style='color : red'>ERROR! Invalid Length</span>";
        } else {
            $sql = "UPDATE tsl set tsl_title = :t , tsl_slogan = :s , tsl_logo = :l where tsl_id = 1";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':t',$w_title);
            $stmt->bindParam(':s',$w_slogan);
            $stmt->bindParam(':l',$i);
            $stmt->execute();
            $msg = "<span style='color : green'> Update Successful.</span>";
        }
        return $msg;
    }
    
    public function getTSL() {
        $sql = "SELECT * FROM $this->table where  tsl_id = 1";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

}
?>

