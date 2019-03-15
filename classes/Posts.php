
<?php

class Posts {

    protected $table = "posts";

    public function insertPost($data) {
        //image validation

        if ((($_FILES["img"]["type"] == "image/gif") || ($_FILES["img"]["type"] == "image/jpeg") ||
                ($_FILES["img"]["type"] == "image/png")) && ($_FILES["img"]["size"] < 2000000)) {
            if ($_FILES["img"]["error"] > 0) {
                echo "Return Code: " . $_FILES["img"]["error"] . "<br />";
            } else {
                if (file_exists("upload/" . $_FILES["img"]["name"])) {
                    echo $_FILES["img"]["name"] . " already exists. ";
                } else {
                    $tt = uniqid();
                    $t = $_POST['category_id'];
                    $i = $tt . $t . $_FILES["img"]["name"];
                    move_uploaded_file($_FILES["img"]["tmp_name"], "upload/$i");
                }
            }
        }

        //image validation
        $post_title = Validation::validate($data['post_title']);
        $category_id = Validation::validate($data['category_id']);
        $post_body = Validation::validate($data['post_body']);
        $post_tag = Validation::validate($data['post_tag']);
        $post_author = Validation::validate($data['post_author']);
        $user_id = Session::get("user_id");
        $msg = "";

        if ($post_title == "" || $_FILES["img"]["size"] == 0 || $category_id == "" || $post_body == "" || $post_tag == "" || $post_author == "") {
            $msg = "<span style='color : red'>ERROR! Field cannot be Empty!!!</span>";
        } else if (strlen($post_title) > 150 || strlen($post_author) > 50 || strlen($post_tag) > 150) {
            $msg = "<span style='color : red'>ERROR! Mismatch Length!!!</span>";
        } else {
            $sql = "INSERT INTO posts(post_title,post_body,post_image,post_author,post_tag,category_id,user_id) "
                    . "values(:post_title,:post_body,:post_image,:post_author,:post_tag,:category_id,:user_id)";

            $stmt = DB::prepare($sql);
            $stmt->bindParam(':post_title', $post_title);
            $stmt->bindParam(':post_body', $post_body);
            $stmt->bindParam(':post_image', $i);
            $stmt->bindParam(':post_author', $post_author);
            $stmt->bindParam(':post_tag', $post_tag);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            $msg = "<span style='color : green'>Insert Successful.</span>";
        }
        return $msg;
    }

    public function updatePost($data, $post_id) {
        //image validation
        if ($_FILES["img"]["size"] == 0) {
            $sql = "SELECT post_image FROM $this->table where post_id = :post_id";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':post_id', $post_id);
            $stmt->execute();
            $result = $stmt->fetch();
            $i = $result['post_image'];
        } else {
            if ((($_FILES["img"]["type"] == "image/gif") || ($_FILES["img"]["type"] == "image/jpeg") ||
                    ($_FILES["img"]["type"] == "image/png")) && ($_FILES["img"]["size"] < 2000000)) {
                if ($_FILES["img"]["error"] > 0) {
                    echo "Return Code: " . $_FILES["img"]["error"] . "<br />";
                } else {
                    if (file_exists("upload/" . $_FILES["img"]["name"])) {
                        echo $_FILES["img"]["name"] . " already exists. ";
                    } else {
                        $tt = uniqid();
                        $t = $_POST['category_id'];
                        $i = $tt . $t . $_FILES["img"]["name"];
                        move_uploaded_file($_FILES["img"]["tmp_name"], "upload/$i");
                    }
                }
            }
        }

        //image validation
        $post_title = Validation::validate($data['post_title']);
        $category_id = Validation::validate($data['category_id']);
        $post_body = Validation::validate($data['post_body']);
        $post_tag = Validation::validate($data['post_tag']);
        $post_author = Validation::validate($data['post_author']);
        $user_id = Session::get("user_id");
        $msg = "";

        if ($post_title == "" || $category_id == "" || $post_body == "" || $post_tag == "" || $post_author == "") {
            $msg = "<span style='color : red'>ERROR! Field cannot be Empty!!!</span>";
        } else if (strlen($post_title) > 150 || strlen($post_author) > 50 || strlen($post_tag) > 150) {
            $msg = "<span style='color : red'>ERROR! Mismatch Length!!!</span>";
        } else {
            $sql = "UPDATE $this->table set post_title=:post_title,post_body = :post_body,post_image=:post_image"
                    . ",post_tag=:post_tag,category_id=:category_id where post_id = :post_id";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':post_title', $post_title);
            $stmt->bindParam(':post_body', $post_body);
            $stmt->bindParam(':post_image', $i);
            $stmt->bindParam(':post_tag', $post_tag);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':post_id', $post_id);
            $stmt->execute();
            $msg = "<span style='color : green'>Update Successful.</span>";
        }
        return $msg;
    }

    public function allPost($start_from, $per_page) {
        $sql = "SELECT * FROM $this->table order by post_id desc limit $start_from,$per_page";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function allPostWithCategory() {
        $sql = "SELECT * FROM posts,category where posts.category_id = category.category_id";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function postWithCategoryById($p_id) {
        $sql = "SELECT * FROM posts,category where posts.category_id = category.category_id AND posts.post_id = :p_id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':p_id', $p_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getPostById($id) {
        $sql = "SELECT * FROM $this->table where  post_id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function relatePost($c_id) {
        $sql = "SELECT * FROM $this->table where  category_id = :c_id order by rand() limit 3";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':c_id', $c_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLatestPost() {
        $sql = "SELECT * FROM $this->table order by post_id desc limit 5";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function searchPost($keyword) {
        $sql = "SELECT * FROM $this->table where post_title like '%$keyword%' OR post_body like '%$keyword%'";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function deletePost($p_id) {
        $sql = "DELETE FROM $this->table where post_id = :p_id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':p_id', $p_id);
        $stmt->execute();
    }

    public function getUserIdByPostId($p_id) {
        $sql = "SELECT user_id FROM posts where post_id=:p_id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':p_id', $p_id);
        $stmt->execute();
        return $stmt->fetch();
    }

}
?>

