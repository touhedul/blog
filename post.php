<?php
include 'inc/header.php';
?>
<?php
if (isset($_GET['p_id'])) {
    $post = new Posts();
    $fm = new Format();
    $post_id = Validation::validate($_GET['p_id']);
    $getPostById = $post->getPostById($post_id);
    if ($getPostById) {
        ?>
        <div class="contentsection contemplete clear">
            <div class="maincontent clear">
                <div class="about">
                    <h2><?php echo $getPostById['post_title']; ?></h2>
                    <h4><?php echo $fm->formatDate($getPostById['post_date']); ?> <a href = "#"><?php echo $getPostById['post_author']; ?></a></h4>
                    <img src="admin/upload/<?php echo $getPostById['post_image']; ?>" alt="MyImage"/>
                    <p><?php echo $getPostById['post_body']; ?></p>
                    <p><?php echo $getPostById['post_body']; ?></p>

                    <div id="disqus_thread"></div>
                    <script>

                        /**
                         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                        /*
                         var disqus_config = function () {
                         this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                         this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                         };
                         */
                        (function () { // DON'T EDIT BELOW THIS LINE
                            var d = document, s = d.createElement('script');
                            s.src = 'https://myfirstblog-2.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>


                    <div class="relatedpost clear">
                        <h2>Related articles</h2>
                        <?php
                        // related post 
                        $relatedPost = $post->relatePost($getPostById['category_id']);
                        if ($relatedPost) {
                            foreach ($relatedPost as $s) {
                                echo '<a href="#"><img src= "admin/upload/' . $s['post_image'] . '"/></a>';
                            }
                        } else {
                            echo "No related post found.";
                        }
                        ?>


                    </div>
                </div>

            </div>

            <?php include 'inc/sidebar.php'; ?>
        </div>


        <?php
    } else {
        header('location: 404.php');
    }
} else {
    header('location: 404.php');
}
?>
<?php include './inc/footer.php'; ?>