<?php
include_once 'classes/Main.php';
?>
<div class="slidersection templete clear">
    <div id="slider">
        <?php
        $allSlider = Main::readAll("slider");
        foreach ($allSlider as $s) {
           //echo ' <a href="#"><img src="admin/upload/' . $s['slider_image'] . '" alt="nature 4" title="This is slider four Title or Description" /></a>';
        }
        ?>
        <a href="#"><img src="images/slideshow/01.jpg" alt="nature 4" title="This is My First blog" /></a>
        <a href="#"><img src="images/slideshow/02.jpg" alt="nature 4" title="This is My First blog" /></a>
        <a href="#"><img src="images/slideshow/03.jpg" alt="nature 4" title="This is My First blog" /></a>
        <a href="#"><img src="images/slideshow/04.jpg" alt="nature 4" title="This is My First blog" /></a>
    </div>

</div>

