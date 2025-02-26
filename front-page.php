<?php
get_header();
$acf_fields = get_fields();// Get all ACF fields
//$acf_fields = get_cached_acf_fields(); // Get all ACF fields from cache

?>
<?php $main_slider = !empty($acf_fields['main_slider']) ? $acf_fields['main_slider'] : [];
if (!empty($main_slider)) : ?>
    <section class="section_main_banner" style="overflow: hidden">
        <div class="main_slider">
            <div class="main_slider_active">
                <?php foreach ($main_slider as $slide) :
                    $image_url = '';

                    if (!empty($slide['image'])) {
                        if (wp_is_mobile()) {
                            //  Load mobile-optimized image
                            $image_url = !empty($slide['image']['sizes']['mobile_slider_banner'])
                                ? esc_url($slide['image']['sizes']['mobile_slider_banner'])
                                : esc_url($slide['image']['url']); // Fallback to original
                        } else {
                            //  Load desktop-optimized image
                            $image_url = !empty($slide['image']['sizes']['main_slider_banner'])
                                ? esc_url($slide['image']['sizes']['main_slider_banner'])
                                : esc_url($slide['image']['url']); // Fallback to original
                        }
                    }
//                var_dump($slide['image']);
                    $title = !empty($slide['title']) ? $slide['title'] : '';
                    // Ensure the button field exists within the slide
                    $button = !empty($slide['button']) ? $slide['button'] : null;
//                    var_dump($button);
                    ?>
                    <div class="slide_item">
                        <div class="image_bg" role="img" aria-label="<?php echo $title; ?>"
                             style="background-image: url('<?php echo $image_url; ?>')">
                            <div class="details w-100">
                                <!-- Include ACF Button Component -->
                                <?php if (!empty($button)) : ?>
                                    <?php render_acf_button($button); ?>
                                <?php else : ?>
                                    <p style="color: red;">Button field is missing!</p>
                                <?php endif; ?>
                                <h2 class="small_title"><?php echo $title; ?></h2>
                            </div>
                            <img src="<?php echo get_template_directory_uri() ?>/static/img/logo_ata_compact.webp"
                                 alt="<?php echo _e('Logo ATA compact'); ?>">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="main_slider_nav_wrapper">
                <div class="main_slider_nav">
                    <?php foreach ($main_slider as $slide) :
                        $image = $slide['image']["sizes"]["program_banner"];
                        $image_url = !empty($image) ? $image : '';
                        $title = !empty($slide['title']) ? $slide['title'] : '';
                        ?>
                        <div class="slide_item">
                            <div class="image_bg" role="img" aria-label="<?php echo $title; ?>"
                                 style="background-image: url('<?php echo $image_url; ?>')">
                                <img src="<?php echo get_template_directory_uri() ?>/static/img/logo_ata_compact.webp"
                                     alt="<?php echo _e('Logo ATA compact'); ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="container">
                <div class="main_slider_controls"></div>
            </div>
        </div>
    </section>
<?php endif; ?>

    <!-- offers sliders -->
<?php $post_types = $acf_fields['offers'];
if (!empty($post_types)) : ?>
    <?php
//$post_types = ['bachelor', 'master'];
    set_query_var('post_types', $post_types);
    locate_template('./template-parts/offers_sliders.php', true, true);
    ?>
<?php endif; ?>
<?php $our_students = $acf_fields['our_students'];
if (!empty($our_students)) :
    $title = $our_students['title'];
    $data_youtube_playlist = $our_students['data_youtube_playlist'];
    ?>
    <section class="section_our_students left_space gray_arrows my-5">
        <h2 class="small_title mb-5"><?php echo $title; ?></h2>
        <?php
        //        $data_youtube_playlist = 'PLBNZMb9x9JdM2o10KZEDwX8SKM_VMBMYP';
        set_query_var('data_youtube_playlist', $data_youtube_playlist);
        locate_template('./template-parts/youtube_slider.php', true, true);
        ?>
    </section>
<?php endif; ?>
<?php $your_interests = $acf_fields['your_interests'];
if (!empty($your_interests)) :
    $title = $your_interests['title'];
    $interests = $your_interests['interests'];
    ?>
    <section class="section_study_your_interests p-5">
        <?php if (!empty($title)) : ?>
            <h2 class="small_title mb-5"><?php echo $title; ?></h2>
        <?php endif; ?>
        <div class="interests">
            <div class="row">
                <?php foreach ($interests as $item) :
                    $title = $item['title'];
                    $link = $item['link'];
                    // Ensure $item['image'] exists before accessing its keys
                    $image = $item['image'] ?? [];

                    // Get the original image URL as a fallback
                    $fallback_image_url = !empty($image['url']) ? esc_url($image['url']) : '';

                    // Get Both Mobile & Desktop Image URLs
                    $image_url_mobile = !empty($image['sizes']['interests_image_mobile'])
                        ? esc_url($image['sizes']['interests_image_mobile'])
                        : $fallback_image_url;

                    $image_url_desktop = !empty($image['sizes']['interests_image'])
                        ? esc_url($image['sizes']['interests_image'])
                        : $fallback_image_url;

                    //  Get Alt Text (with a safe fallback)
                    $image_alt = !empty($image['alt']) ? esc_attr($image['alt']) : __('Interests Image', 'akademiata');
                    ?>
                    <div class="col-md-6">
                        <a title="<?php echo $title; ?>" href="<?php echo $link['url']; ?>">
                            <div class="item image_bg responsive-image" role="img"
                                 aria-label="<?php echo $image_alt; ?>"
                                 data-mobile="<?php echo esc_url($image_url_mobile); ?>"
                                 data-desktop="<?php echo esc_url($image_url_desktop); ?>"
                                 style="background-image: url('<?php echo esc_url($image_url_desktop); ?>');">
                                <h3><?php echo $title; ?></h3>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
    </section>
<?php endif; ?>

    <section class="section_hybrid_studies px-5  pb-5" style="display: none">

        <?php $image_url = esc_url(get_template_directory_uri()) . '/static/img/hybrid_studies.webp';
        $image_alt = 'image'; ?>
        <div class="image_bg"
             style="background-image: url('<?php echo $image_url; ?>');">

            <div class="text-center">
                <img src="<?php echo esc_url(get_template_directory_uri()) . '/static/img/hybrid_studies_title.png'; ?>"
                     alt="<?php _e('Studia hybrydowe') ?>">
                <h3 class="banner_title">ONLINE/OFFLINE</h3>
                <a href="/" class="button-primary">SPRAWDŹ</a>
            </div>
        </div>

    </section>
    <section class="section_additional_for_you p-5 mb-5" style="display: none">
        <div class="row">
            <div class="col-md-6">
                <?php $image_url = esc_url(get_template_directory_uri()) . '/static/img/win_index.webp';
                $image_alt = 'image'; ?>
                <div class="image_bg"
                     style="background-image: url('<?php echo $image_url; ?>');">

                    <div class="text-center">
                        <h2 class="banner_title">STUDIUJ BEZ OPŁAT</h2>
                        <h3 class="banner_title">WYGRAJ INDEKS</h3>
                        <a href="/" class="button-primary">SPRAWDŹ</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <?php $image_url = esc_url(get_template_directory_uri()) . '/static/img/tailored_studies.webp';
                $image_alt = 'image'; ?>
                <div class="image_bg"
                     style="background-image: url('<?php echo $image_url; ?>');">
                    <div class="text-center">
                        <h2 class="banner_title">NIE WIESZ JAKIE STUDIA WYBRAĆ?</h2>
                        <h3 class="banner_title">DOPASUJ STUDIA DO SIEBIE</h3>
                        <a href="/" class="button-primary">Rozpocznij test</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
