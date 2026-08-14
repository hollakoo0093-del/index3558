<?php
if (is_front_page()) {
    require get_template_directory() . '/front-page.php';
    return;
}
get_header();
?>
<main class="page-shell"><article class="flyer"><section class="section">
<?php if (have_posts()): while(have_posts()): the_post(); ?>
<article <?php post_class(); ?>><h1><?php the_title(); ?></h1><div class="hero-copy"><?php the_content(); ?></div></article>
<?php endwhile; else: ?><p>لا يوجد محتوى.</p><?php endif; ?>
</section></article></main>
<?php get_footer(); ?>
