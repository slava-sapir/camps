<?php
/**
 * FAQs with Search Block Template.
 *
* @param array $block The block settings and attributes.
* @param string $content The block inner HTML (empty).
* @param bool $is_preview True during backend preview render.
* @param int $post_id The post ID the block is rendering content against.
*        This is either the post ID currently being displayed inside a query loop,
*        or the post ID of the post hosting this block.
* @param array $context The context provided to the block by the post or it's parent block.
* 
* @package Forest_Cliff_Camps
*/

$categories = get_terms( array(
    'taxonomy' => 'faq_category',
    'hide_empty' => false,
));
$displayed_category = get_field('displayed_category');
?>

<section id="faqs" style="padding-top: <?= get_field('padding_top'); ?>px; padding-bottom: <?= get_field('padding_bottom'); ?>px;">
    <div class="container">
        <div class="row gx-lg-50 gx-xxl-120">
            <div class="col-lg-4">
                <h2 class="mb-10">FAQs</h2>
                <form role="search" method="get" id="search-form" class="search-form inline-submit" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="position-relative">
                        <label for="s" class="d-block mb-5"><small>Search Your Question</small></label>
                        <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Input keywords" class="form-control pe-40" />
                        
                        <button type="submit" class="position-absolute end-0 border-0 outline-0 bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none"><path d="M10 18.2793C11.775 18.2789 13.4988 17.6847 14.897 16.5913L19.293 20.9873L20.707 19.5733L16.311 15.1773C17.405 13.779 17.9996 12.0547 18 10.2793C18 5.8683 14.411 2.2793 10 2.2793C5.589 2.2793 2 5.8683 2 10.2793C2 14.6903 5.589 18.2793 10 18.2793ZM10 4.2793C13.309 4.2793 16 6.9703 16 10.2793C16 13.5883 13.309 16.2793 10 16.2793C6.691 16.2793 4 13.5883 4 10.2793C4 6.9703 6.691 4.2793 10 4.2793Z" fill="#58616B"/><path d="M11.4121 8.86538C11.7911 9.24538 12.0001 9.74738 12.0001 10.2794H14.0001C14.001 9.75381 13.8977 9.23328 13.6961 8.74787C13.4946 8.26246 13.1989 7.82181 12.8261 7.45138C11.3121 5.93938 8.68707 5.93938 7.17407 7.45138L8.58607 8.86738C9.34607 8.10938 10.6561 8.11138 11.4121 8.86538Z" fill="#58616B"/></svg>
                        </button>
                    </div>
                    
                </form>
                <p class="my-10"><small>FAQ Categories</small></p>
                <ul class="list-unstyled">
                <?php foreach ( $categories as $category ) : ?>
                    <li class="<?php echo $category->term_id == $displayed_category ? 'h5 fw-bold mb-0' : ''; ?>">
                        <a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="p-10 d-block">
                            <?php echo esc_html( $category->name ); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
                </ul>
                
                
            </div>
            <div class="col-lg-8">
                <!-- FAQ Accordion -->
                <?php
                // Get posts from the selected category
                if ( $displayed_category ) :
                    $i = 1;
                    $query = new WP_Query( array(
                        'post_type' => 'faq',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'faq_category',
                                'field'    => 'term_id',
                                'terms'    => $displayed_category,
                            ),
                        ),
                    ));

                    get_template_part('template-parts/faq-accordion', null, array('query' => $query));
                endif; ?>
            </div>
        </div>
    </div>
</section>