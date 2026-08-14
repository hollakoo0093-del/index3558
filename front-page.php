<?php get_header();
$brand = get_theme_mod('brand_name','الخدمات المتكاملة');
$city = get_theme_mod('city','الرياض');
$phone_display = get_theme_mod('phone_display','057 571 1533');
$phone_tel = get_theme_mod('phone_tel','0575711533');
$wa = get_theme_mod('whatsapp_number','966575711533');
$designer = get_theme_mod('designer_name','م. نجوى إبراهيم');
$designer_wa = get_theme_mod('designer_whatsapp','201029095046');
?>
<main class="page-shell">
  <article class="flyer">
    <header class="topbar">
      <a class="brand" href="#home" aria-label="<?php echo esc_attr($brand); ?>">
        <?php if (has_custom_logo()) { $logo_id = get_theme_mod('custom_logo'); $logo = wp_get_attachment_image_src($logo_id, 'full'); if ($logo) { ?><img class="custom-logo" src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo esc_attr($brand); ?>"><?php } } else { ?><span class="brand-mark" aria-hidden="true">م</span><?php } ?>
        <span><?php echo esc_html($brand); ?></span>
      </a>
      <div class="location">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"></path><circle cx="12" cy="10" r="2.5"></circle></svg>
        <?php echo esc_html($city); ?>
      </div>
    </header>

    <section class="hero" id="home">
      <div>
        <p class="eyebrow"><?php echo esc_html(get_theme_mod('hero_eyebrow','حلول موثوقة • جودة تدوم')); ?></p>
        <h1><?php echo esc_html(get_theme_mod('hero_title_1','احمِ منزلك')); ?><br><em><?php echo esc_html(get_theme_mod('hero_title_2','من أول قطرة')); ?></em></h1>
        <p class="hero-copy"><?php echo esc_html(get_theme_mod('hero_copy','عزل احترافي لجميع أنواع الأسطح والخزنات، مع كشف تسربات المياه والإصلاح الفوري. شغل متقن يحفظ بيتك ويمنحك راحة البال.')); ?></p>
        <div class="hero-actions">
          <a class="btn btn-primary" href="tel:<?php echo esc_attr($phone_tel); ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.2 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.78.62 2.63a2 2 0 0 1-.45 2.11L8 9.73a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.85.29 1.73.5 2.63.62A2 2 0 0 1 22 16.92Z"></path></svg>
            اتصل الآن
          </a>
          <a class="btn btn-secondary" href="https://wa.me/<?php echo esc_attr($wa); ?>" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 11.5a8.4 8.4 0 0 1-12.4 7.35L3 20l1.2-4.4A8.4 8.4 0 1 1 20 11.5Z"></path><path d="M8.6 8.3c.2-.4.4-.4.7-.4h.5c.2 0 .4 0 .5.4l.6 1.5c.1.2.1.4 0 .6l-.5.7c-.1.2-.2.3 0 .5.2.4.8 1.3 1.7 1.8 1.2.7 1.2.5 1.5.2l.6-.8c.2-.2.4-.2.6-.1l1.4.7c.2.1.3.3.2.6-.1.4-.5 1.3-.9 1.5-.4.3-1 .4-1.6.1-.5-.1-1.8-.7-3-1.8-1-1-1.8-2.3-2-2.8-.3-.7-.3-1.3-.1-1.7Z"></path></svg>
            واتساب
          </a>
        </div>
      </div>
      <div class="offer-card" aria-label="عرض خاص">
        <div class="offer-inner"><span class="offer-small"><?php echo esc_html(get_theme_mod('offer_small','عرض خاص')); ?></span><strong><?php echo esc_html(get_theme_mod('offer_main_1','لمدة')); ?><br><?php echo esc_html(get_theme_mod('offer_main_2','شهر')); ?></strong><span><?php echo esc_html(get_theme_mod('offer_text','تواصل معنا لمعرفة السعر')); ?></span></div>
        <div class="floating-note"><b></b> <?php echo esc_html(get_theme_mod('floating_note','خدمة سريعة ومضمونة')); ?></div>
      </div>
    </section>

    <section class="section" id="services">
      <div class="section-heading"><h2><?php echo esc_html(get_theme_mod('services_h1','كل ما يحتاجه منزلك')); ?><br><?php echo esc_html(get_theme_mod('services_h2','في مكان واحد')); ?></h2><p><?php echo esc_html(get_theme_mod('services_intro','حلول عملية بأيدي خبراء، من المعاينة وحتى إنهاء العمل.')); ?></p></div>
      <div class="services-grid">
      <?php
      $sq = new WP_Query(array('post_type'=>'service','post_status'=>'publish','posts_per_page'=>-1,'orderby'=>array('menu_order'=>'ASC','date'=>'ASC')));
      $icons = array(
        '<path d="m3 11 9-7 9 7"></path><path d="M5 10v10h14V10M9 20v-6h6v6"></path>',
        '<path d="M5 7h14M6 7v12h12V7M8 4h8v3H8zM9 11h6M9 15h6"></path>',
        '<path d="m14.5 5.5 4-4 4 4-4 4M3 21l6.5-6.5M14 10l-4.5 4.5M12 3 3 12l9 9 9-9-9-9Z"></path>',
        '<path d="M12 3.5c3.2 4 5 6.8 5 9.5a5 5 0 0 1-10 0c0-2.7 1.8-5.5 5-9.5Z"></path><path d="M9.5 13.5a2.7 2.7 0 0 0 2.7 2.7"></path>'
      );
      $i=0; if ($sq->have_posts()): while($sq->have_posts()): $sq->the_post(); ?>
        <a class="service" href="tel:<?php echo esc_attr($phone_tel); ?>" aria-label="اتصل للاستفسار عن <?php the_title_attribute(); ?>">
          <div class="service-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><?php echo $icons[$i % count($icons)]; ?></svg></div>
          <h3><?php the_title(); ?></h3><p><?php echo esc_html(wp_strip_all_tags(get_the_content())); ?></p>
        </a>
      <?php $i++; endwhile; wp_reset_postdata(); endif; ?>
      </div>
    </section>

    <section class="section"><div class="feature-band"><div><h2><?php echo esc_html(get_theme_mod('feature_h1','شغل نظيف.')); ?><br><?php echo esc_html(get_theme_mod('feature_h2','نتيجة تلاحظها.')); ?></h2><p><?php echo esc_html(get_theme_mod('feature_intro','نهتم بالتفاصيل الصغيرة حتى تحصل على حماية كبيرة.')); ?></p></div><ul class="features-list"><li>معاينة دقيقة</li><li>تنفيذ سريع</li><li>مواد عالية الجودة</li><li>إصلاح فوري</li><li>التزام بالمواعيد</li><li>خدمة في <?php echo esc_html($city); ?></li></ul></div></section>

    <section class="section">
      <div class="section-heading"><h2><?php echo esc_html(get_theme_mod('reviews_h1','تقييمات عملائنا')); ?><br><?php echo esc_html(get_theme_mod('reviews_h2','رائعة مثل خدمتنا')); ?></h2><p><?php echo esc_html(get_theme_mod('reviews_intro','ثقة العملاء هي أجمل نتيجة لأي عمل نتقنه.')); ?></p></div>
      <div class="reviews">
      <?php $rq = new WP_Query(array('post_type'=>'review','post_status'=>'publish','posts_per_page'=>-1,'orderby'=>array('menu_order'=>'ASC','date'=>'ASC'))); if($rq->have_posts()): while($rq->have_posts()): $rq->the_post(); ?>
        <blockquote class="review"><span class="quote" aria-hidden="true">“</span><div class="stars" aria-label="5 من 5 نجوم">★★★★★</div><p><?php echo esc_html(wp_strip_all_tags(get_the_content())); ?></p><cite><?php the_title(); ?></cite></blockquote>
      <?php endwhile; wp_reset_postdata(); endif; ?>
      </div>
    </section>

    <section class="section contact" id="contact">
      <div><p class="eyebrow"><?php echo esc_html(get_theme_mod('contact_eyebrow','جاهزون لخدمتك')); ?></p><h2><?php echo esc_html(get_theme_mod('contact_h1','خلّ الحل يبدأ')); ?><br><?php echo esc_html(get_theme_mod('contact_h2','بمكالمة')); ?></h2><p><?php echo esc_html(get_theme_mod('contact_copy','اتصل بنا الآن واحصل على استشارة أولية حول احتياج منزلك.')); ?></p></div>
      <a class="phone-box" href="tel:<?php echo esc_attr($phone_tel); ?>" aria-label="الاتصال على <?php echo esc_attr($phone_display); ?>"><span><span class="phone-label">للتواصل والحجز</span><strong class="phone-number"><?php echo esc_html($phone_display); ?></strong></span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.2 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.78.62 2.63a2 2 0 0 1-.45 2.11L8 9.73a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.85.29 1.73.5 2.63.62A2 2 0 0 1 22 16.92Z"></path></svg></a>
    </section>

    <footer class="footer"><p><?php echo esc_html(get_theme_mod('copyright','© 2026 الخدمات المتكاملة — الرياض')); ?></p><p>تم التصميم بواسطة <a class="designer" href="https://wa.me/<?php echo esc_attr($designer_wa); ?>" target="_blank" rel="noopener"><?php echo esc_html($designer); ?></a></p></footer>
  </article>
</main>
<nav class="floating-actions" aria-label="التواصل السريع"><a class="float-btn float-whatsapp" href="https://wa.me/<?php echo esc_attr($wa); ?>" target="_blank" rel="noopener" aria-label="التواصل عبر واتساب"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 11.5a8.4 8.4 0 0 1-12.4 7.35L3 20l1.2-4.4A8.4 8.4 0 1 1 20 11.5Z"></path><path d="M8.6 8.3c.2-.4.4-.4.7-.4h.5c.2 0 .4 0 .5.4l.6 1.5c.1.2.1.4 0 .6l-.5.7c-.1.2-.2.3 0 .5.2.4.8 1.3 1.7 1.8 1.2.7 1.2.5 1.5.2l.6-.8c.2-.2.4-.2.6-.1l1.4.7c.2.1.3.3.2.6-.1.4-.5 1.3-.9 1.5-.4.3-1 .4-1.6.1-.5-.1-1.8-.7-3-1.8-1-1-1.8-2.3-2-2.8-.3-.7-.3-1.3-.1-1.7Z"></path></svg></a><a class="float-btn float-phone" href="tel:<?php echo esc_attr($phone_tel); ?>" aria-label="الاتصال الآن"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.2 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.78.62 2.63a2 2 0 0 1-.45 2.11L8 9.73a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.85.29 1.73.5 2.63.62A2 2 0 0 1 22 16.92Z"></path></svg></a></nav>
<?php get_footer(); ?>
