<?php


class DB {

    private static $pdo;

    public static function connection() {

        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO('mysql:host=127.0.0.1;dbname=blog;charset=utf8','root','10109914');
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $exc) {
                echo $exc->getMessage();
            }
        }
        return self::$pdo;
    }
    public static function prepare($sql) {
        return self::connection()->prepare($sql);
    }

}


?>

