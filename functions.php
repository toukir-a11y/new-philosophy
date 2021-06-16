<?php

require_once get_theme_file_path( '/include/tgm.php');
require_once get_theme_file_path( '/include/attachment.php');


// version issue 

if (site_url()=="http://localhost/wptd"){
    define ("VERSION",time());
}else define("VERSION", wp_get_theme()->get("Version"));

// basic theme support and  bootstraping

function philosophy_theme_setup(){
load_theme_textdomain("philosophy");
add_theme_support("post-thumbnails");
add_theme_support( "title-tag");
add_theme_support('html-5',array('search-form','comment-list'));
add_theme_support("post-formats",array ("image","gallery","link","quote","audio","video"));
add_theme_support("/assets/css/editor-style.css");
register_nav_menu( "top_menu", __( 'top_menu', 'philosophy' ) );
add_image_size( "philosophy-square", 400,400, true);  
}
add_action("after_setup_theme","philosophy_theme_setup");


// assets load and managment 
function philosophy_assets(){
wp_enqueue_style("fontawesome-css",get_theme_file_uri("/assets/css/font-awesome/css/font-awesome.css"),null,"1.0",);
wp_enqueue_style("fonts-css",get_theme_file_uri("/assets/css/fonts.css"),null,"1.0",);
wp_enqueue_style("base-css",get_theme_file_uri("/assets/css/base.css"),null,"1.0",);
wp_enqueue_style("vendor-css",get_theme_file_uri("/assets/css/vendor.css"),null,"1.0",);
wp_enqueue_style("main-css",get_theme_file_uri("/assets/css/main.css"),"1.0",);
wp_enqueue_style("philosophy-css",get_theme_file_uri(),null,VERSION);

wp_enqueue_script("modernizr-js", get_theme_file_uri("/assets/js/modernizr.js"),null,"1.0");
wp_enqueue_script("pace-js", get_theme_file_uri("/assets/js/pace.min.js"),null,"1.0");
wp_enqueue_script("plugins-js", get_theme_file_uri("/assets/js/plugins.js"),array("jquery"),"1.0",true);
wp_enqueue_script("main-js", get_theme_file_uri("/assets/js/main.js"),array("jquery"),"1.0",true);
}
add_action("wp_enqueue_scripts","philosophy_assets");

// custom function for pagination 
function philosophy_pagination() {
    global $wp_query;
    $links = paginate_links(array(
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query ->max_num_pages,
        'type' => 'list',
        'mid_size'=>2
    ));

    $links = str_replace("page-numbers", "pgn__num", $links);
    $links = str_replace("<ul class='pgn__num'>", "<ul>", $links);
    $links = str_replace("next pgn__num", "pgn__next", $links);
    $links = str_replace("prev pgn__num", "pgn__prev", $links);
    echo $links;
}

?>