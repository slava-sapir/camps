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

    wp_enqueue_script('forest_cliff_camps_scripts', get_template_directory_uri() . '/public/js/theme.min.js', array('jquery'), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    global $wp_query;
    wp_localize_script(
        'forest_cliff_camps_scripts',
        'forest_cliff_params',
        array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'posts' => json_encode( $wp_query->query_vars ),
            'cur_page' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
            'max_page' => $wp_query->max_num_pages,
        )
    );
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
require get_template_directory() . '/inc/camp.php';

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
add_image_size( 'staff-thumb', 466, 670, true );
add_image_size( 'review-thumb', 112, 112, true );
add_image_size( 'experience-thumb', 695, 450, true );

// FAQs CPT
// Register Custom Post Type FAQs
function create_faqs_cpt() {
    $labels = array(
        'name'          => 'FAQs',
        'singular_name' => 'FAQ',
        'menu_name'     => 'FAQs',
    );
    
    $args = array(
        'label'         => 'FAQs',
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array( 'slug' => 'faqs' ),
        'supports'      => array( 'title', 'editor', 'thumbnail' ),
    );
    
    register_post_type( 'faq', $args );
}
add_action( 'init', 'create_faqs_cpt', 0 );

// Register Custom Taxonomy FAQ Categories
function create_faq_categories_taxonomy() {
    $labels = array(
        'name'          => 'FAQ Categories',
        'singular_name' => 'FAQ Category',
        'menu_name'     => 'FAQ Categories',
    );
    
    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'hierarchical'  => true,
        'rewrite'       => array( 'slug' => 'faq-category' ),
        'supports'      => array( 'title', 'editor' ),
    );
    
    register_taxonomy( 'faq_category', array( 'faq' ), $args );
}
add_action( 'init', 'create_faq_categories_taxonomy', 0 );

// Reviews CPT
// Register Custom Post Type Reviews
function create_reviews_cpt() {
    $labels = array(
        'name'          => 'reviews',
        'singular_name' => 'Review',
        'menu_name'     => 'Reviews',
    );

    $args = array(
        'label'         => 'Reviews',
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array( 'slug' => 'reviews' ),
        'supports'      => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'review', $args );
}
add_action( 'init', 'create_reviews_cpt', 0 );

// Add ACF Options Page
if( function_exists('acf_add_options_page') ) {
    acf_add_options_sub_page(array(
        'page_title'  => 'FAQ Settings',
        'menu_title'  => 'Settings',
        'parent_slug' => 'edit.php?post_type=faq',
    ));
}

// Add custom columns to FAQ CPT and reorder them
function set_custom_edit_faq_columns($columns) {
    $new_columns = array();

    // Reorder columns
    foreach ($columns as $key => $value) {
        if ($key == 'date') {
            $new_columns['faq_category'] = __('FAQ Categories', 'text_domain');
        }
        $new_columns[$key] = $value;
    }

    return $new_columns;
}
add_filter('manage_faq_posts_columns', 'set_custom_edit_faq_columns');

// Populate custom columns in FAQ CPT
function custom_faq_column($column, $post_id) {
    switch ($column) {
        case 'faq_category':
            $terms = get_the_term_list($post_id, 'faq_category', '', ', ');
            if (is_string($terms)) {
                echo $terms;
            } else {
                echo __('No FAQ Categories', 'text_domain');
            }
            break;
    }
}
add_action('manage_faq_posts_custom_column', 'custom_faq_column', 10, 2);

// Make FAQ Categories column sortable
function set_sortable_faq_columns($columns) {
    $columns['faq_category'] = 'faq_category';
    return $columns;
}
add_filter('manage_edit-faq_sortable_columns', 'set_sortable_faq_columns');

// Ensure sorting works for FAQ Categories column
function faq_category_column_orderby($query) {
    if (!is_admin()) {
        return;
    }

    $orderby = $query->get('orderby');

    if ('faq_category' == $orderby) {
        $query->set('meta_key', 'faq_category');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'faq_category_column_orderby');


add_action( 'wp_ajax_loadmore', 'forest_cliff_ajax_handler' ); // wp_ajax_{action}
add_action( 'wp_ajax_nopriv_loadmore', 'forest_cliff_ajax_handler' ); // wp_ajax_nopriv_{action}

function forest_cliff_ajax_handler(){

    // prepare our arguments for the query
    $args = json_decode( stripslashes( $_POST[ 'query' ] ), true );
    $args[ 'paged' ] = $_POST[ 'page' ] + 1; // we need next page to be loaded
    $args[ 'post_status' ] = 'publish';

    // it is always better to use WP_Query but not here
    query_posts( $args );

    if( have_posts() ) :
        ob_start();
        // run the loop
        while( have_posts() ): the_post();
            get_template_part( 'template-parts/blog-card' );
        endwhile;
        $output = ob_get_clean();
        echo $output;

    endif;
    die; // here we exit the script and even no wp_reset_query() required!
}