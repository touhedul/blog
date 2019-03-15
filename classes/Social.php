<?php

class Social {

    private $table = "social";

    public function updateLink($data) {
        $fb = Validation::validate($data['fb']);
        $tw = Validation::validate($data['tw']);
        $ln = Validation::validate($data['ln']);
        $gp = Validation::validate($data['gp']);
        $msg = "";
        if ($fb == "" || $tw == "" || $ln == "" || $gp == "") {
            $msg = "<span style='color : red'>ERROR! Field cannot be Empty!!!</span>";
        } elseif (strlen($fb) > 200 || strlen($tw) > 200 || strlen($ln) > 200 || strlen($gp) > 200) {
            $msg = "<span style='color : red'>ERROR! Invalid Length</span>";
        } else {
            $sql = "UPDATE social set fb=:fb,tw=:tw,ln=:ln,gp=:gp where social_id = 1";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':fb',$fb);
            $stmt->bindParam(':tw',$tw);
            $stmt->bindParam(':ln',$ln);
            $stmt->bindParam(':gp',$gp);
            $stmt->execute();
            $msg = "<span style='color : green'> Update Successful.</span>";
        }
        return $msg;
    }

    public function getSocial() {
        $sql = "SELECT * FROM $this->table where  social_id = 1";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

}

?>
