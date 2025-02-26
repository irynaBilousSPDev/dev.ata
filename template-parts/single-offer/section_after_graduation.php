<?php
$acf_fields = get_query_var('acf_fields', []);
$after_graduation = $acf_fields['after_graduation'] ?? [];
// Check if section data exists before rendering
if (!empty($after_graduation)) :
    $title = $after_graduation['title'] ?? '';
    $idYoutube = $after_graduation['id_youtube_playlist'] ?? '';
    ?>
    <section class="section_after_graduation left_space gray_arrows pb-md-5 mb-5">
        <?php if (!empty($title)) : ?>
            <h2 class="sub_title_section mb-5">
                <?php echo esc_html($title); ?>
            </h2>
        <?php endif; ?>
        <?php
        // Pass YouTube playlist ID to template
        set_query_var('data_youtube_playlist', esc_attr($idYoutube));

        // Load YouTube Slider Template
        get_template_part('template-parts/youtube_slider');
        ?>
    </section>
<?php endif; ?>

