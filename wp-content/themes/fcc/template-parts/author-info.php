<?php
/**
 * Template part for displaying the author info
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shed_village
 */
?>
<div class="author-info d-flex align-items-center">
    <?= get_avatar(get_the_author_meta('ID'), 48, '', '', ['class' => 'rounded-circle']); ?>
    <div class="d-flex flex-column ps-10"><small class="fw-bold">Written by</small> <?= get_the_author() ?></div>
</div>