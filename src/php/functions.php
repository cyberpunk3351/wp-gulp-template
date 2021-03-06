<?php

function breakbeat01_scripts() {
	wp_enqueue_style( 'breakbeat01-style', get_stylesheet_uri());

	// wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css');
	wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/style.min.css');

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.5.1.min.js');
	wp_enqueue_script( 'jquery' );

	// wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.min.js', array(), null, true);
	wp_enqueue_script( 'my-script', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), null, true);
	wp_enqueue_script( 'my-script2', get_template_directory_uri() . '/assets/js/script.min.js', array('jquery'), null, true);

}

add_action( 'wp_enqueue_scripts', 'breakbeat01_scripts' );
add_action( 'widgets_init', 'main_widget' );

add_theme_support( 'post-thumbnails', array( 'post' ) );
add_image_size('my-custom-thumb', 260, 150, true);

add_theme_support( 'custom-logo', array('width' => 200));
add_theme_support( 'custom-background' );

require get_template_directory() . '/inc/template-tags.php';

add_filter( 'excerpt_length', function(){
	return 20;
} );
add_image_size('my-custom-thumb-post', 9999, 350, true);

function main_widget(){

	register_sidebar( array(
		'name' => "Main Sidebar",
		'id' => "main-sidebar",
		'description' => "Main Sidebar",
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => "</div>\n",
	) );
}

/**
 * Generate breadcrumbs
 * @author CodexWorld
 * @authorURL www.codexworld.com
 */
function get_breadcrumb() {
    echo '<a href="'.home_url().'" rel="nofollow">Главная</a>';
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        the_category(' &bull; ');
            if (is_single()) {
                echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
                the_title();
            }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}

?>