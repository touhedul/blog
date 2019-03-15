
<?php

class Slider {

    private $table = "slider";

    public function addSliderImage($data) {
        $msg = "";
        //image validation
        if($_FILES["img"]["size"] == 0){
            $msg = "<span style='color : red'>ERROR! Please Insert Image.!!!</span>";
            return $msg;
        }
        if ((($_FILES["img"]["type"] == "image/gif") || ($_FILES["img"]["type"] == "image/jpeg") ||
                ($_FILES["img"]["type"] == "image/png")) && ($_FILES["img"]["size"] < 2000000)) {
            if ($_FILES["img"]["error"] > 0) {
                return "Return Code: " . $_FILES["img"]["error"] . "<br />";
            } else {
                if (file_exists("upload/" . $_FILES["img"]["name"])) {
                    return $_FILES["img"]["name"] . " already exists. ";
                } else {
                    $tt = uniqid();
                    $i = $tt . $_FILES["img"]["name"];
                    move_uploaded_file($_FILES["img"]["tmp_name"], "upload/$i");
                }
            }
        }

        //image validation
        $sql = "INSERT INTO $this->table(slider_image) values(:si)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':si', $i);
        $stmt->execute();
        $msg = "<span style='color : green'>Image Add Successful.!!!</span>";
        return $msg;
    }
    
    public function updateSliderImage($slider_id) {
        $msg = "";
        //image validation
        if($_FILES["img"]["size"] == 0){
            $msg = "<span style='color : red'>ERROR! Please Insert Image.!!!</span>";
            return $msg;
        }
        if ((($_FILES["img"]["type"] == "image/gif") || ($_FILES["img"]["type"] == "image/jpeg") ||
                ($_FILES["img"]["type"] == "image/png")) && ($_FILES["img"]["size"] < 2000000)) {
            if ($_FILES["img"]["error"] > 0) {
                return "Return Code: " . $_FILES["img"]["error"] . "<br />";
            } else {
                if (file_exists("upload/" . $_FILES["img"]["name"])) {
                    return $_FILES["img"]["name"] . " already exists. ";
                } else {
                    $tt = uniqid();
                    $i = $tt . $_FILES["img"]["name"];
                    move_uploaded_file($_FILES["img"]["tmp_name"], "upload/$i");
                }
            }
        }

        //image validation
        $sql = "UPDATE $this->table set slider_image = :si where slider_id=:slider_id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':si', $i);
        $stmt->bindParam(':slider_id', $slider_id);
        $stmt->execute();
        $msg = "<span style='color : green'>Image Update Successful.!!!</span>";
        return $msg;
    }

    public function deleteSlider($slider_id) {
        $sql = "DELETE FROM $this->table where slider_id = :si";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':si', $slider_id);
        $stmt->execute();
    }
    
    public function getSlider($slider_id) {
        $sql = "SELECT * FROM $this->table where slider_id = :si";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':si', $slider_id);
        $stmt->execute();
        return $stmt->fetch();
    }

}
?>

