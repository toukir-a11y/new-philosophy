<?php do_action ("category_page_title", single_cat_title('','false'));?>

<?php get_header();?>
    <!-- s-content
    ================================================== -->
    <section class="s-content">

    
    <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">

                <?php do_action ("before_title");?>
                <h1>
                    <?php single_cat_title();?>
                </h1>
                <?php do_action ("after_title");?>

                <?php do_action ("before_des_title");?>

                <p class="lead">
                    <?php echo  category_description();?>
                </p>

                <?php do_action ("after_des_title");?>
            </div>
        </div>
        
        <div class="row masonry-wrap">
            <div class="masonry">

                <div class="grid-sizer"></div>
                <?php 
                if(! have_posts() ):
                ?>
                <h3 class=text-center> <?php _e("no post available in this category","philosophy");?></h3>
                
                <?php
                endif;
                ?>
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
