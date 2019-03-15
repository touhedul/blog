<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css">

<?php 
include_once 'classes/Theme.php';
$theme = new Theme();
$themes = $theme->getTheme();
if($themes['theme_name'] == "default"){
    echo '<link rel="stylesheet" href="themes/default.css">';
}elseif($themes['theme_name'] == "green"){
    echo '<link rel="stylesheet" href="themes/green.css">';
}
?>