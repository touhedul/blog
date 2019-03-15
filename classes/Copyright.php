<?php

class Copyright {

    private $table = "copyright";

    public function updateCopyrightText($data) {
        $text = Validation::validate($data['copyright']);
        $msg = "";
        if ($text == "") {
            $msg = "<span style='color : red'>ERROR! Field cannot be Empty!!!</span>";
        } elseif (strlen($text)>300) {
            $msg = "<span style='color : red'>ERROR! Invalid Length</span>";
        } else {
            $sql = "UPDATE copyright set copyright_text = :text where copyright_id = 1";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':text',$text);
            $stmt->execute();
            $msg = "<span style='color : green'> Update Successful.</span>";
        }
        return $msg;
    }

    public function getCopyrightText() {
        $sql = "SELECT * FROM $this->table where  copyright_id = 1";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

}

?>
