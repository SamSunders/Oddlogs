<?php

/**
 * realest functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package realest
 */

if (!function_exists('realest_setup')):
    
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function realest_setup() {
        
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on realest, use a find and replace
         * to change 'realest' to the name of your theme in all the template files.
        */
        load_theme_textdomain('realest', get_template_directory() . '/languages');
        
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        add_editor_style();
        
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
        */
        add_theme_support('title-tag');
        
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
        add_theme_support('post-thumbnails');
        
        add_image_size('slider', 1440, 550, true);
        
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array('primary' => esc_html__('Primary Menu', 'realest'),));
        
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
        */
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption',));
        
        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
        */
        add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link',));
        
        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('realest_custom_background_args', array('default-color' => 'ffffff', 'default-image' => '',)));
    }
endif;
 // realest_setup
add_action('after_setup_theme', 'realest_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function realest_content_width() {
    $GLOBALS['content_width'] = apply_filters('realest_content_width', 640);
}
add_action('after_setup_theme', 'realest_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function realest_widgets_init() {
    register_sidebar(array('name' => esc_html__('Sidebar', 'realest'), 'id' => 'sidebar-1', 'description' => '', 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget' => '</aside>', 'before_title' => '<h3 class="widget-title">', 'after_title' => '</h3>',));
    
    register_sidebar(array('name' => esc_html__('Property Sidebar', 'realest'), 'id' => 'sidebar-2', 'description' => '', 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget' => '</aside>', 'before_title' => '<h3 class="widget-title">', 'after_title' => '</h3>',));
    
    register_sidebar(array('name' => esc_html__('Page', 'realest'), 'id' => 'page', 'description' => '', 'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="col-center">', 'after_widget' => '</div></aside>', 'before_title' => '<h2 class="widget-title">', 'after_title' => '</h2>',));
    
    register_sidebar(array('name' => esc_html__('Footer 1', 'realest'), 'id' => 'footer-1', 'description' => '', 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget' => '</aside>', 'before_title' => '<h2 class="widget-title">', 'after_title' => '</h2>',));
    
    register_sidebar(array('name' => esc_html__('Footer 2', 'realest'), 'id' => 'footer-2', 'description' => '', 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget' => '</aside>', 'before_title' => '<h2 class="widget-title">', 'after_title' => '</h2>',));
    
    register_sidebar(array('name' => esc_html__('Footer 3', 'realest'), 'id' => 'footer-3', 'description' => '', 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget' => '</aside>', 'before_title' => '<h2 class="widget-title">', 'after_title' => '</h2>',));
    
    register_sidebar(array('name' => esc_html__('Footer 4', 'realest'), 'id' => 'footer-4', 'description' => '', 'before_widget' => '<aside id="%1$s" class="widget %2$s">', 'after_widget' => '</aside>', 'before_title' => '<h2 class="widget-title">', 'after_title' => '</h2>',));
}
add_action('widgets_init', 'realest_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function realest_scripts() {
    wp_enqueue_style('realest-style', get_stylesheet_uri());
    
    //Custom Typography
    $headings_font = esc_html(get_theme_mod('headings_fonts'));
    $body_font = esc_html(get_theme_mod('body_fonts'));
    
    if ($headings_font) {
        wp_enqueue_style('realest-headings-fonts', '//fonts.googleapis.com/css?family=' . $headings_font);
    } 
    else {
        wp_enqueue_style('realest-open-sans', '//fonts.googleapis.com/css?family=Roboto:400,700');
    }
    if ($body_font) {
        wp_enqueue_style('realest-body-fonts', '//fonts.googleapis.com/css?family=' . $body_font);
    } 
    else {
        wp_enqueue_style('realest-open-body', '//fonts.googleapis.com/css?family=Montserrat:400,700');
    }
    
    wp_enqueue_style('realest-icons', get_template_directory_uri() . '/css/font-awesome.min.css');
    
    wp_enqueue_style('realest-animate', get_template_directory_uri() . '/css/animate.css');
        
    wp_enqueue_script('realest-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.3.0', true);
    
    wp_enqueue_script('realest-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true);
    
    wp_enqueue_script('realest-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true);
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'realest_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Google Fonts
 */
//require get_template_directory() . '/inc/fonts.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

//Page Titles
function realeast_page_title() {
?>
	<div class="header-image">
		<div class="overlay"></div>
		<div class="col-center">
		<header class="entry-header">
        <?php if ( !is_front_page() ) : ?>
		<h1> <?php the_title(''); ?> </h1>
        <?php endif; ?>
	</header><!-- .entry-header -->
	</div>
</div>
<?php
}

//Adjust the content that appears before the title

function realestate_before_title() {
    
    $location = Realia_Query::get_property_location_name();
    if (!empty($location)): ?>
						<div class="property-location">
						<i class="fa fa-map-marker"></i><?php
        echo wp_kses($location, wp_kses_allowed_html('post')); ?>
						</div>
					<?php
    endif;
}
add_filter('realia_before_property_box_title', 'realestate_before_title');

//Adjust the content that appears after the title

function realestate_after_title() {
    
    $type = Realia_Query::get_property_type_name();
    if (!empty($type)): ?>
	            <div class="property-type">
	                <?php
        echo wp_kses($type, wp_kses_allowed_html('post')); ?>
	            </div><!-- /.property-box-type -->
	        <?php
    endif;
}
add_filter('realia_after_property_box_title', 'realestate_after_title');

//Adjust the content that appears in the property box, after the title
function realestate_property_box_content() {
    
    $rooms = get_post_meta(get_the_ID(), REALIA_PROPERTY_PREFIX . 'rooms', true);
    if (!empty($rooms)): ?>
	            <div class="property-box-type">
	            <span><?php
        echo __('Rooms', 'realest'); ?></span><strong><?php
        echo esc_attr($rooms); ?></strong>
	                <?php// echo wp_kses( $rooms, wp_kses_allowed_html( 'post' ) ); ?>
	            </div><!-- /.property-box-type -->
	        <?php
    endif; ?>

	        <?php
    $beds = get_post_meta(get_the_ID(), REALIA_PROPERTY_PREFIX . 'beds', true); ?>
	        <?php
    if (!empty($beds)): ?>
	            <div class="property-box-type">
	            <span><?php
        echo __('Beds', 'realest'); ?></span><strong><?php
        echo esc_attr($beds); ?></strong>
	            </div><!-- /.property-box-type -->
	        <?php
    endif; ?>


	        <?php
    $baths = get_post_meta(get_the_ID(), REALIA_PROPERTY_PREFIX . 'baths', true); ?>
	        <?php
    if (!empty($baths)): ?>
	            <div class="property-box-type">
	            <span><?php
        echo __('Baths', 'realest'); ?></span><strong><?php
        echo esc_attr($baths); ?></strong>
	            </div><!-- /.property-box-type -->
	        <?php
    endif;
}
add_filter('realia_before_property_box_body', 'realestate_property_box_content');



/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'realest_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function realest_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

  

        // This is an example of how to include a plugin from a GitHub repository in your theme.
        // This presumes that the plugin code is based in the root of the GitHub repository
        // and not in a subdirectory ('/src') of the repository.


        array(
            'name'      => 'realia',
            'slug'      => 'realia',
            'required'     => false,
            'source'    => 'https://wordpress.org/plugins/realia/',
        ),

            array(
            'name'      => 'CMB2',
            'slug'      => 'cmb2',
            'required'  => false,
        ),
    );
   // Message to output right before the plugins table.

    tgmpa( $plugins);
}

function realest_upgrade_notice(){
    echo '<div class="notice notice-success is-dismissible">
       <p><b>Add Widget listings, logo, Property slider, custom Widgets, and get 24/7 dedicated support, for just $35  <a target="_blank" href="http://freewprealestatetheme.com">upgrade to PRO Today</a>.</b></p>
    </div>';
}
add_action('admin_notices', 'realest_upgrade_notice');

//removes srcset that causes issues with the slider
add_filter( 'max_srcset_image_width', create_function( '', 'return 1;' ) );