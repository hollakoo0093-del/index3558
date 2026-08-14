<?php
if (!defined('ABSPATH')) exit;

function is_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('custom-logo', array('height'=>80,'width'=>240,'flex-height'=>true,'flex-width'=>true));
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form','comment-form','comment-list','gallery','caption','style','script'));
}
add_action('after_setup_theme', 'is_theme_setup');

function is_enqueue_assets() {
    wp_enqueue_style('integrated-services-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'is_enqueue_assets');

function is_register_content_types() {
    register_post_type('service', array(
        'labels' => array('name'=>'الخدمات','singular_name'=>'خدمة','add_new'=>'إضافة خدمة','add_new_item'=>'إضافة خدمة جديدة','edit_item'=>'تعديل الخدمة'),
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-admin-tools',
        'supports' => array('title','editor','page-attributes'),
        'has_archive' => false,
        'rewrite' => array('slug'=>'service'),
    ));
    register_post_type('review', array(
        'labels' => array('name'=>'التقييمات','singular_name'=>'تقييم','add_new'=>'إضافة تقييم','add_new_item'=>'إضافة تقييم جديد','edit_item'=>'تعديل التقييم'),
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-star-filled',
        'supports' => array('title','editor','page-attributes'),
        'has_archive' => false,
        'rewrite' => array('slug'=>'review'),
    ));
}
add_action('init', 'is_register_content_types');

function is_seed_default_content() {
    if (get_option('is_seeded_v1')) return;
    $services = array(
        array('عزل جميع أنواع الأسطح','حماية من الحرارة والرطوبة وتسربات الأمطار.'),
        array('عزل الخزنات','عزل مائي يحافظ على الخزان ونظافة المياه.'),
        array('ترميمات عامة','إصلاح وتجديد يعيد للمكان رونقه وقوته.'),
        array('كشف التسربات','تحديد مصدر التسرب بدقة مع الإصلاح الفوري.'),
    );
    foreach ($services as $i=>$s) {
        wp_insert_post(array('post_type'=>'service','post_status'=>'publish','post_title'=>$s[0],'post_content'=>$s[1],'menu_order'=>$i));
    }
    $reviews = array(
        array('عميل من الرياض','تعامل راقٍ وسرعة في الوصول. تم اكتشاف التسرب وإصلاحه في نفس الزيارة، والنتيجة ممتازة.'),
        array('عميلة من شمال الرياض','عزلوا السطح والخزان باحتراف، شرحوا لنا كل شيء بوضوح وكان العمل مرتباً ونظيفاً جداً.'),
        array('عميل من شرق الرياض','خدمة ممتازة والتزام بالموعد. لاحظنا الفرق مباشرة بعد العزل، أنصح بالتعامل معهم بكل ثقة.'),
    );
    foreach ($reviews as $i=>$r) {
        wp_insert_post(array('post_type'=>'review','post_status'=>'publish','post_title'=>$r[0],'post_content'=>$r[1],'menu_order'=>$i));
    }
    update_option('is_seeded_v1', 1);
}
add_action('after_switch_theme', 'is_seed_default_content');

function is_sanitize_phone($value) {
    return preg_replace('/[^0-9+]/', '', (string)$value);
}
function is_sanitize_whatsapp($value) {
    return preg_replace('/[^0-9]/', '', (string)$value);
}

function is_customize_register($wp_customize) {
    $wp_customize->add_panel('is_panel', array('title'=>'إعدادات الموقع الرئيسية','priority'=>20));

    $sections = array(
        'is_identity'=>array('الهوية والتواصل',10),
        'is_hero'=>array('القسم الرئيسي',20),
        'is_offer'=>array('العرض',30),
        'is_sections'=>array('عناوين الأقسام',40),
        'is_contact'=>array('قسم التواصل',50),
        'is_footer'=>array('الفوتر والمصممة',60),
        'is_tracking'=>array('TikTok Pixel',70),
        'is_colors'=>array('الألوان',80),
    );
    foreach($sections as $id=>$data){ $wp_customize->add_section($id,array('title'=>$data[0],'panel'=>'is_panel','priority'=>$data[1])); }

    $text_fields = array(
        'brand_name'=>array('اسم النشاط','الخدمات المتكاملة','is_identity'),
        'city'=>array('المدينة','الرياض','is_identity'),
        'phone_display'=>array('رقم الهاتف الظاهر','057 571 1533','is_identity'),
        'phone_tel'=>array('رقم الاتصال للرابط','0575711533','is_identity'),
        'whatsapp_number'=>array('رقم واتساب مع كود البلد','966575711533','is_identity'),
        'hero_eyebrow'=>array('النص الصغير أعلى العنوان','حلول موثوقة • جودة تدوم','is_hero'),
        'hero_title_1'=>array('العنوان الرئيسي - السطر الأول','احمِ منزلك','is_hero'),
        'hero_title_2'=>array('العنوان الرئيسي - السطر الثاني','من أول قطرة','is_hero'),
        'hero_copy'=>array('وصف القسم الرئيسي','عزل احترافي لجميع أنواع الأسطح والخزنات، مع كشف تسربات المياه والإصلاح الفوري. شغل متقن يحفظ بيتك ويمنحك راحة البال.','is_hero'),
        'offer_small'=>array('نص العرض الصغير','عرض خاص','is_offer'),
        'offer_main_1'=>array('العرض - السطر الأول','لمدة','is_offer'),
        'offer_main_2'=>array('العرض - السطر الثاني','شهر','is_offer'),
        'offer_text'=>array('وصف العرض','تواصل معنا لمعرفة السعر','is_offer'),
        'floating_note'=>array('ملاحظة العرض','خدمة سريعة ومضمونة','is_offer'),
        'services_h1'=>array('الخدمات - السطر الأول','كل ما يحتاجه منزلك','is_sections'),
        'services_h2'=>array('الخدمات - السطر الثاني','في مكان واحد','is_sections'),
        'services_intro'=>array('وصف قسم الخدمات','حلول عملية بأيدي خبراء، من المعاينة وحتى إنهاء العمل.','is_sections'),
        'feature_h1'=>array('المميزات - السطر الأول','شغل نظيف.','is_sections'),
        'feature_h2'=>array('المميزات - السطر الثاني','نتيجة تلاحظها.','is_sections'),
        'feature_intro'=>array('وصف المميزات','نهتم بالتفاصيل الصغيرة حتى تحصل على حماية كبيرة.','is_sections'),
        'reviews_h1'=>array('التقييمات - السطر الأول','تقييمات عملائنا','is_sections'),
        'reviews_h2'=>array('التقييمات - السطر الثاني','رائعة مثل خدمتنا','is_sections'),
        'reviews_intro'=>array('وصف التقييمات','ثقة العملاء هي أجمل نتيجة لأي عمل نتقنه.','is_sections'),
        'contact_eyebrow'=>array('التواصل - النص الصغير','جاهزون لخدمتك','is_contact'),
        'contact_h1'=>array('التواصل - السطر الأول','خلّ الحل يبدأ','is_contact'),
        'contact_h2'=>array('التواصل - السطر الثاني','بمكالمة','is_contact'),
        'contact_copy'=>array('وصف التواصل','اتصل بنا الآن واحصل على استشارة أولية حول احتياج منزلك.','is_contact'),
        'copyright'=>array('نص الحقوق','© 2026 الخدمات المتكاملة — الرياض','is_footer'),
        'designer_name'=>array('اسم المصممة','م. نجوى إبراهيم','is_footer'),
        'designer_whatsapp'=>array('واتساب المصممة مع كود البلد','201029095046','is_footer'),
        'tiktok_pixel_id'=>array('TikTok Pixel ID','D7AFQF3C77U41AUTNVO0','is_tracking'),
    );
    foreach ($text_fields as $id=>$f) {
        $wp_customize->add_setting($id,array('default'=>$f[1],'sanitize_callback'=>($id==='whatsapp_number'||$id==='designer_whatsapp')?'is_sanitize_whatsapp':(($id==='phone_tel')?'is_sanitize_phone':'sanitize_text_field'),'transport'=>'refresh'));
        $wp_customize->add_control($id,array('label'=>$f[0],'section'=>$f[2],'type'=>'text'));
    }

    $wp_customize->add_setting('hero_copy',array('default'=>$text_fields['hero_copy'][1],'sanitize_callback'=>'sanitize_textarea_field'));
    $wp_customize->add_control('hero_copy',array('label'=>'وصف القسم الرئيسي','section'=>'is_hero','type'=>'textarea'));
    $wp_customize->add_setting('services_intro',array('default'=>$text_fields['services_intro'][1],'sanitize_callback'=>'sanitize_textarea_field'));
    $wp_customize->add_control('services_intro',array('label'=>'وصف قسم الخدمات','section'=>'is_sections','type'=>'textarea'));
    $wp_customize->add_setting('feature_intro',array('default'=>$text_fields['feature_intro'][1],'sanitize_callback'=>'sanitize_textarea_field'));
    $wp_customize->add_control('feature_intro',array('label'=>'وصف المميزات','section'=>'is_sections','type'=>'textarea'));
    $wp_customize->add_setting('reviews_intro',array('default'=>$text_fields['reviews_intro'][1],'sanitize_callback'=>'sanitize_textarea_field'));
    $wp_customize->add_control('reviews_intro',array('label'=>'وصف التقييمات','section'=>'is_sections','type'=>'textarea'));
    $wp_customize->add_setting('contact_copy',array('default'=>$text_fields['contact_copy'][1],'sanitize_callback'=>'sanitize_textarea_field'));
    $wp_customize->add_control('contact_copy',array('label'=>'وصف التواصل','section'=>'is_contact','type'=>'textarea'));

    $colors = array(
        'ink'=>array('اللون الأساسي','#10343b'),
        'ink_deep'=>array('اللون الداكن','#09252d'),
        'teal'=>array('التركواز','#0b6970'),
        'teal_bright'=>array('التركواز الفاتح','#13a2a0'),
        'aqua'=>array('الخلفية المائية','#c4efeb'),
        'cream'=>array('الكريمي','#fffaf0'),
        'paper'=>array('خلفية الصفحة','#f7f3e9'),
        'orange'=>array('البرتقالي','#f28a43'),
        'orange_deep'=>array('البرتقالي الداكن','#d8642b'),
        'gold'=>array('الذهبي','#efc568'),
    );
    foreach($colors as $id=>$c){
        $sid='color_'.$id;
        $wp_customize->add_setting($sid,array('default'=>$c[1],'sanitize_callback'=>'sanitize_hex_color'));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,$sid,array('label'=>$c[0],'section'=>'is_colors')));
    }
}
add_action('customize_register', 'is_customize_register');

function is_dynamic_colors() {
    $map = array(
        'ink'=>'#10343b','ink_deep'=>'#09252d','teal'=>'#0b6970','teal_bright'=>'#13a2a0','aqua'=>'#c4efeb','cream'=>'#fffaf0','paper'=>'#f7f3e9','orange'=>'#f28a43','orange_deep'=>'#d8642b','gold'=>'#efc568'
    );
    echo '<style id="is-custom-colors">:root{';
    foreach($map as $k=>$def){ echo '--'.str_replace('_','-',$k).':'.esc_html(get_theme_mod('color_'.$k,$def)).';'; }
    echo '}</style>';
}
add_action('wp_head','is_dynamic_colors',20);

function is_tiktok_pixel() {
    $pixel = get_theme_mod('tiktok_pixel_id','D7AFQF3C77U41AUTNVO0');
    if (!$pixel) return;
    ?>
<!-- TikTok Pixel Code Start -->
<script>
!function (w, d, t) {
  w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie","holdConsent","revokeConsent","grantConsent"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var r="https://analytics.tiktok.com/i18n/pixel/events.js",o=n&&n.partner;ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=r,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};n=document.createElement("script");n.type="text/javascript",n.async=!0,n.src=r+"?sdkid="+e+"&lib="+t;e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(n,e)};
  ttq.load('<?php echo esc_js($pixel); ?>');
  ttq.page();
}(window, document, 'ttq');
</script>
<!-- TikTok Pixel Code End -->
    <?php
}
add_action('wp_head','is_tiktok_pixel',5);

function is_contact_tracking_script() { ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('a[href^="https://wa.me/"]').forEach(function (link) {
    link.addEventListener('click', function () { link.setAttribute('aria-label', 'فتح محادثة واتساب'); });
  });
  document.addEventListener('click', function (e) {
    var link = e.target.closest('a');
    if (!link) return;
    var href = link.getAttribute('href') || '';
    if (href.indexOf('tel:') === 0 || href.indexOf('https://wa.me/') === 0 || link.classList.contains('btn') || link.classList.contains('phone-box') || link.classList.contains('float-btn') || link.classList.contains('service')) {
      if (window.ttq && typeof window.ttq.track === 'function') {
        window.ttq.track('Contact', {content_type: href.indexOf('tel:') === 0 ? 'phone' : (href.indexOf('wa.me') !== -1 ? 'whatsapp' : 'cta')});
      }
    }
  }, true);
});
</script>
<?php }
add_action('wp_footer','is_contact_tracking_script',50);
