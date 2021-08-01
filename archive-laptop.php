<?php get_header();?>
    <!-- s-content
    ================================================== -->
    <section class="s-content">
        
        <div class="row masonry-wrap">
            <div class="masonry">

                <div class="grid-sizer"></div>

                <?php
                while(have_posts()){
                    the_post();
                    get_template_part("template-parts/post-format/post",get_post_format());
                }
                ?>

            </div> <!-- end masonry -->
        </div> <!-- end masonry-wrap -->

     

        <div class="row">
            <div class="col-full">
                <nav class="pgn">
                    <ul>
                      <?php philosophy_pagination();?>
                    </ul>
                </nav>
            </div>
        </div>

    </section> <!-- s-content -->

<?php get_footer();?>
