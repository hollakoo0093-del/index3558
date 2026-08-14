<?php get_header(); ?>
<main class="page-shell"><article class="flyer"><section class="section"><div class="section-heading"><h2>المقالات</h2><p>أحدث المقالات والنصائح.</p></div>
<?php if(have_posts()): while(have_posts()): the_post(); ?><article class="review" style="margin-bottom:14px"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><p><?php echo esc_html(wp_trim_words(get_the_excerpt(),28)); ?></p></article><?php endwhile; the_posts_pagination(); else: ?><p>لا توجد مقالات بعد.</p><?php endif; ?>
</section></article></main>
<?php get_footer(); ?>
