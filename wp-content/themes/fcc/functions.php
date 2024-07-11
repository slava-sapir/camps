<?php
/**
 * Forest Cliff Camps functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Forest_Cliff_Camps
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function forest_cliff_camps_setup()
{
    /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * If you're building a theme based on Forest Cliff Camps, use a find and replace
        * to change 'forest-cliff-camps' to the name of your theme in all the template files.
        */
    load_theme_textdomain('forest-cliff-camps', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

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

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'forest-cliff-camps'),
        )
    );

    /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        )
    );
}

add_action('after_setup_theme', 'forest_cliff_camps_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function forest_cliff_camps_content_width()
{
    $GLOBALS['content_width'] = apply_filters('forest_cliff_camps_content_width', 640);
}

add_action('after_setup_theme', 'forest_cliff_camps_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function forest_cliff_camps_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'forest-cliff-camps'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'forest-cliff-camps'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}

add_action('widgets_init', 'forest_cliff_camps_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function forest_cliff_camps_scripts()
{
    wp_enqueue_style('forest-cliff-camps-style', get_template_directory_uri() . '/public/css/theme.min.css', array(), _S_VERSION);

    wp_enqueue_script('forest-cliff-camps-scripts', get_template_directory_uri() . '/public/js/theme.min.js', array(), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'forest_cliff_camps_scripts');

add_action('enqueue_block_editor_assets','forest_cliff_camps_add_block_editor_assets',10,0);
function forest_cliff_camps_add_block_editor_assets(){
  wp_enqueue_style('block_editor_css', get_template_directory_uri() . '/public/css/theme.min.css');
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// Disable Theme File Editor
define( 'DISALLOW_FILE_EDIT', true );

// Disable comments on all post types
function disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'disable_comments_post_types_support');

// Close comments on the front-end
function disable_comments_status() {
	return false;
}
add_filter('comments_open', 'disable_comments_status', 20, 2);
add_filter('pings_open', 'disable_comments_status', 20, 2);

// Hide existing comments
function disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function disable_comments_admin_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'disable_comments_admin_menu');

// Redirect any user trying to access comments page
function disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'disable_comments_admin_menu_redirect');

function my_acf_json_save_point( $path ) {
    return get_stylesheet_directory() . '/acf_json';
}
add_filter( 'acf/settings/save_json', 'my_acf_json_save_point' );

function fcc_register_acf_blocks() {
    /**
     * We register our block's with WordPress's handy
     * register_block_type();
     *
     * @link https://developer.wordpress.org/reference/functions/register_block_type/
     */
    $directories = scandir(__DIR__ . '/blocks/');

    foreach ($directories as $directory) {
        if ($directory === '.' || $directory === '..') {
            continue;
        }

        register_block_type(__DIR__ . '/blocks/' . $directory);
    }
}
// Here we call our tt3child_register_acf_block() function on init.
add_action( 'init', 'fcc_register_acf_blocks' );

add_image_size( 'blog-thumb', 447, 278, true );