<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Forest_Cliff_Camps
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<?php
global $theme_color;
$theme_color = 'default-theme';
$camp_args = [
    'post_type' => 'page',
];
if (get_field('theme_colour')) :
    $theme_color = get_field('theme_colour');
endif;

global $post;
$camp_model = new Camp($post);

$child_pages = [];

if ($camp_model->is_camp_page()) :
    $child_pages = $camp_model->get_submenu_items();
endif;
?>
<body <?php body_class($theme_color); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

    <!-- Top Bar -->
    <div id="top-bar">
        <div class="row">
            <!-- Empty Column for Spacing -->
            <div class="col-lg-3 d-none d-lg-block"></div>

            <!-- Center Links -->
            <div class="col-lg d-none d-lg-flex justify-content-center">
                <?php if ($camp_model->is_camp_page()) : ?>
                    <ul class="list-unstyled justify-content-center center-links">
                        <?php foreach ($camp_model->parent_pages as $page_id => $page_slug) : ?>
                            <li class="d-flex"><a class="<?= $camp_model->active_camp === $page_id ? 'active' : ''; ?>"
                                                  href="/<?= $page_slug; ?>"><?= get_the_title($page_id); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <!-- Side Links -->
            <div class="col-lg-3">
                <ul class="list-unstyled side-links">
                    <li><a href="">Donate</a></li>
                    <li><a href="">Join Our Team</a></li>
                </ul>
            </div>
        </div>
    </div><!-- /#top-bar -->

    <!-- Site Header -->
    <header id="masthead" class="site-header">
        <div class="container container-ed">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col col-lg-auto col-logo">
                    <a href="<?= get_home_url(); ?>">
                        <img
                            src="<?php echo $camp_model->get_logo(); ?>"
                            alt="<?php bloginfo('name'); ?>" class="header-logo img-fluid">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="col d-none d-lg-block">
                    <ul class="nav-list">
                        <?php if ($theme_color === 'default-theme') : ?>
                            <li><a href="/day-camps" class="btn btn-text">Day Camps</a></li>
                            <li><a href="/overnight-camps" class="btn btn-text">Overnight Camps</a></li>
                            <li><a href="/schools-groups" class="btn btn-text">Schools & Groups</a></li>
                        <?php else : ?>
                            <?php foreach ($child_pages as $page) : ?>
                                <li><a href="<?= get_permalink($page->ID); ?>"
                                       class="btn btn-text text-white"><?php echo $page->post_title; ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Register Button -->
                <div class="col-auto text-end d-none d-lg-block col-register">
                    <?php if ($camp_model->is_camp_page()) : ?>
                        <a href="<?= get_field('submenu_button', $camp_model->active_camp)['url']; ?>>"
                           target="<?= get_field('submenu_button', $camp_model->active_camp)['target']; ?>"
                           class="btn"><?= get_field('submenu_button', $camp_model->active_camp)['title']; ?></a>
                    <?php else : ?>
                        <a href="https://forestcliffcamp.campbrainregistration.com/" class="btn btn-white"
                           target="_blank">Register Now</a>
                    <?php endif; ?>
                </div>

                <!-- Mobile Toggle Button -->
                <div class="col-auto d-lg-none ms-auto">
                    <button class="btn btn-white mobile-button mobile-toggle" data-bs-toggle="offcanvas"
                            data-bs-target="#mobile-navigation" aria-controls="mobile-navigation">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28"
                             fill="currentColor">
                            <path
                                d="M4.66667 7H23.3333V9.33333H4.66667V7ZM4.66667 12.8333H23.3333V15.1667H4.66667V12.8333ZM4.66667 18.6667H23.3333V21H4.66667V18.6667Z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header><!-- /#masthead -->

    <!-- Mobile Navigation -->
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="mobile-navigation"
         aria-labelledby="mobile-navigation-heading">
        <div class="container nav-header">
            <div class="row align-items-center">
                <!-- Mobile Logo -->
                <div class="col col-lg-auto">
                    <a href="<?php echo home_url(); ?>">
                        <img
                            src="<?php echo get_template_directory_uri() . '/resources/images/main-theme/logos/forest-cliff-camps-logo-original.svg'; ?>"
                            alt="<?php bloginfo('name'); ?>" class="header-logo img-fluid">
                    </a>
                </div>

                <!-- Mobile Close Button -->
                <div class="col-auto d-lg-none ms-auto">
                    <button class="btn btn-white mobile-button mobile-close" data-bs-dismiss="offcanvas"
                            aria-label="Close">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M21.35 6.66149C21.132 6.44303 20.8361 6.32026 20.5275 6.32026C20.2189 6.32026 19.923 6.44303 19.705 6.66149L14 12.3548L8.295 6.64983C8.07703 6.43137 7.7811 6.30859 7.4725 6.30859C7.16389 6.30859 6.86797 6.43137 6.65 6.64983C6.195 7.10483 6.195 7.83983 6.65 8.29483L12.355 13.9998L6.65 19.7048C6.195 20.1598 6.195 20.8948 6.65 21.3498C7.105 21.8048 7.84 21.8048 8.295 21.3498L14 15.6448L19.705 21.3498C20.16 21.8048 20.895 21.8048 21.35 21.3498C21.805 20.8948 21.805 20.1598 21.35 19.7048L15.645 13.9998L21.35 8.29483C21.7933 7.85149 21.7933 7.10483 21.35 6.66149Z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="offcanvas-body">
            <div class="container">
                <!-- Accordion Navigation for Mobile -->
                <div class="accordion" id="accordion-mobile-navigation">
                    <!-- Day Camps -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Day Camps
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse"
                             data-bs-parent="#accordion-mobile-navigation">
                            <div class="accordion-body">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="">Overview</a></li>
                                    <li><a href="">The Experience</a></li>
                                    <li><a href="">Activities</a></li>
                                    <li><a href="">Dates & Locations</a></li>
                                    <li><a href="">SK - Grade 5 Program</a></li>
                                    <li><a href="">Grade 6 - 8 Program</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Overnight Camps -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Overnight Camps
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse"
                             data-bs-parent="#accordion-mobile-navigation">
                            <div class="accordion-body">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="">Overview</a></li>
                                    <li><a href="">The Experience</a></li>
                                    <li><a href="">Activities</a></li>
                                    <li><a href="">Dates & Locations</a></li>
                                    <li><a href="">SK - Grade 5 Program</a></li>
                                    <li><a href="">Grade 6 - 8 Program</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Schools & Groups -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Schools & Groups
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse"
                             data-bs-parent="#accordion-mobile-navigation">
                            <div class="accordion-body">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="">Overview</a></li>
                                    <li><a href="">The Experience</a></li>
                                    <li><a href="">Activities</a></li>
                                    <li><a href="">Dates & Locations</a></li>
                                    <li><a href="">SK - Grade 5 Program</a></li>
                                    <li><a href="">Grade 6 - 8 Program</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Register Button -->
        <div class="container nav-footer">
            <a href="" class="btn btn-green w-100 py-20">Register Now</a>
        </div>
    </div><!-- /#mobile-navigation -->