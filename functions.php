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
add_theme_support ("custom-logo");
add_theme_support('html-5',array('search-form','comment-list'));
add_theme_support("post-formats",array ("image","gallery","link","quote","audio","video"));
add_theme_support("/assets/css/editor-style.css");


register_nav_menu( "top_menu", __( 'top_menu', 'philosophy' ) );
register_nav_menus(array(
    "left_footer"   =>__("left_footer_menu","philosophy"),
    "center_footer" =>__("center_footer_menu","philosophy"),
    "right_footer"  =>__("right_footer_menu","philosophy"),

));

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
        'mid_size'=> apply_filters("change_mid_size",2),
    ));

    $links = str_replace("page-numbers", "pgn__num", $links);
    $links = str_replace("<ul class='pgn__num'>", "<ul>", $links);
    $links = str_replace("next pgn__num", "pgn__next", $links);
    $links = str_replace("prev pgn__num", "pgn__prev", $links);
    echo $links;
}

remove_action ("term_description","wpautop");

function philosophy_widgets(){
    register_sidebar( array(
    'name'          => __('about us', 'philosophy'),
    'id'            => 'about-us',
    'description'   => __('widgets of about page','philosophy'),
    'before_widget' => '<div id="%1$s", class="col-block %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="quarter-top-margin">',
    'after_title'   => '</h3>',
) );

register_sidebar( array(
    'name'          => __('contact page ', 'philosophy'),
    'id'            => 'google-map',
    'description'   => __('widgets of contact page','philosophy'),
    'before_widget' => '<div id="%1$s", class=" %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '',
    'after_title'   => '', 
) );
register_sidebar( array(
    'name'          => __('contact-form', 'philosophy'),
    'id'            => 'contact-form',
    'description'   => __('widgets of contact page','philosophy'),
    'before_widget' => '<div id="%1$s", class="col-block %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="quarter-top-margin">',
    'after_title'   => '</h3>',
) );

register_sidebar( array(
    'name'          => __('footer-right_popular_post', 'philosophy'),
    'id'            => 'popular_post_footer',
    'description'   => __('widgets of popular_post','philosophy'),
    'before_widget' => '<div id="%1$s", class="%2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
) );

register_sidebar( array(
    'name'          => __('footer-right_footer_menu', 'philosophy'),
    'id'            => 'footer-right_footer_menu',
    'description'   => __('widgets of footer_menu','philosophy'),
    'before_widget' => '<div id="%1$s", class="%2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
) );


register_sidebar( array(
    'name'          => __('footer-right_copyright', 'philosophy'),
    'id'            => 'popular_post_copyright',
    'description'   => __('widgets of copyright','philosophy'),
    'before_widget' => '<div id="%1$s", class="%2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '',
    'after_title'   => '',
) );

}

add_filter("widgets_init","philosophy_widgets");

function search_form($form){
    $home_url= home_url("/");
    $title = __("search for:","philosophy");
    $value = __("Search","philosophy");
    $post_type= <<<PT
<input type= "hidden" name="post_type" value="post">
PT;
    if(is_post_type_archive('laptop')){
   $post_type= <<<PT
<input type= "hidden" name="post_type" value="laptop">
PT;
    }

    $new_form= <<<FORM
    <form role="search" method="get" class="header__search-form" action="{$home_url}">
    <label>
        <span class="hide-content">{$value}</span>
        <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="{$title}" autocomplete="off">
        </label>
        {$post_type}
        <input type="submit" class="search-submit" value="{$value}">
    </form>
    FORM;

    return $new_form;
}
add_filter("get_search_form","search_form");

function before_cat_title(){
    echo "<h4>hello world</h4>";
}
add_action ("before_title","before_cat_title");

function after_cat_title(){
    echo "<h4>hello world</h4>";
}
add_action ("after_title","after_cat_title");

function before_des_title(){
    echo "<h5> hello wppool</h5>";
}
add_action("before_des_title", "before_des_title");

function after_des_title(){
    echo "<h5> hello wppool</h5>";
}
add_action("after_des_title", "after_des_title");

function beginning_category_page( $category_title ) {
    if ( "New" == $category_title ) {
        $visit_count = get_option( "category_new" );
        $visit_count = $visit_count ? $visit_count : 0;
        $visit_count ++;
        update_option( "category_new", $visit_count );
    }
}

function modify_filter($text,$text2){
    return strtoupper($text)." ".strtoupper($text2);
}

add_filter("philosophy_filters","modify_filter", 10,3);
function change_mid_size($abc){
return 1;
}
add_filter("change_mid_size","change_mid_size");
?>