<?php
include_once 'classes/Pages.php';
?>
<div class="footersection templete clear">
    <div class="footermenu clear">
        <ul>
            <li><a href="#">Home</a></li>
            <?php
            $page1 = new Pages();
            $getAllPage = $page1->getPage();
            foreach ($getAllPage as $s) {
                 echo '<li><a  href="page.php?page_id=' . $s['page_id'] . '">' . $s['page_name'] . '</a></li>';
            }
            ?>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>
    <?php
    $getCopyright = $copyright->getCopyrightText();
    ?>
    <p>&copy; <?php echo $getCopyright['copyright_text']; ?>.</p>
</div>

<div class="fixedicon clear">
    <a href="http://www.facebook.com"><img src="images/fb.png" alt="Facebook"/></a>
    <a href="http://www.twitter.com"><img src="images/tw.png" alt="Twitter"/></a>
    <a href="http://www.linkedin.com"><img src="images/in.png" alt="LinkedIn"/></a>
    <a href="http://www.google.com"><img src="images/gl.png" alt="GooglePlus"/></a>
</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
<script id="dsq-count-scr" src="//myfirstblog-2.disqus.com/count.js" async></script>
</body>
</html>
