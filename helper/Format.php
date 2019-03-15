<?php

class Format{
    public function formatDate($date) {
        return date('F j, Y, g:i a', strtotime($date));
    }
    
    public function formatText($text,$limit=350) {
        $text = $text." ";
        $text = substr($text,0,$limit);
        //$text = substr($text, 0, strpos($text, ' '));
        $text = $text." .....";
        return $text;
    }
    
    public function title() {
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path,'.php');
        $title = str_replace('_', ' ', $title);
        if($title == "index"){
            $title = "Home - Myblog";
        }elseif($title == "contact"){
            $title = "Contact - Myblog";
        }
        return $title;
    }
    
    public function highlight() {
        $path = $_SERVER['SCRIPT_FILENAME'];
        $name = basename($path,'.php');
        if($name == "index")
            return "Home";
        elseif($name == "contact")
            return "Contact";
        
    }
}
?>

