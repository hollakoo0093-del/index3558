<?php get_header(); ?>
<main class="page-shell"><article class="flyer"><section class="section">
<?php while(have_posts()): the_post(); ?><article <?php post_class(); ?>><h1><?php the_title(); ?></h1><div class="hero-copy"><?php the_content(); ?></div></article><?php endwhile; ?>
</section></article></main>
<?php get_footer(); ?>
