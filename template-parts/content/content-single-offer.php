<?php $acf_fields = get_fields();
//  Pass ACF fields to templates
set_query_var('acf_fields', $acf_fields);
$is_mobile = wp_is_mobile();

// Define taxonomies with their labels
$top_taxonomies_with_labels = [
    'department' => 'WYDZIAŁ',
    'program' => 'KIERUNEK STUDIÓW',
];
?>
    <section class="section_header left_space">
        <div class="container">

            <?php if ($is_mobile) : ?>
                <div class="offer_header my-3">
                    <!-- Breadcrumbs -->
                    <?php the_breadcrumb(); ?>
                    <div class="top_details">
                        <div class="row">
                            <?php
                            // Call the function to display taxonomies
                            render_taxonomy_info($top_taxonomies_with_labels);
                            ?>
                        </div>
                    </div>
                    <div class="main_title">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="d-flex flex-column-reverse flex-lg-row">
                <!-- Content Column -->
                <div class="col-lg-6">
                    <div class="offer_body">

                        <?php if (!$is_mobile) : ?>
                            <div class="offer_header my-3">
                                <!-- Breadcrumbs -->
                                <?php the_breadcrumb(); ?>
                                <div class="top_details">
                                    <div class="row">
                                        <?php
                                        // Call the function to display taxonomies
                                        render_taxonomy_info($top_taxonomies_with_labels);
                                        ?>
                                    </div>
                                </div>
                                <div class="main_title">
                                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="offer_details_wrapper">
                            <?php
                            // Define taxonomies with their labels
                            $taxonomies_with_labels = [
                                'degree' => 'RODZAJ STUDIÓW',
                                'obtained_title' => 'UZYSKANY TYTUŁ',
                                'duration' => 'CZAS TRWANIA',
                                'language' => 'JĘZYK STUDIÓW',
                                'mode' => 'FORMA STUDIÓW',
                            ];

                            // Call the function to display taxonomies
                            render_taxonomy_details($taxonomies_with_labels, __('oferta', 'akademiata'));
                            ?>

                        </div>
                        <?php
                        $offer_partners = !empty($acf_fields['offer_partners']) ? $acf_fields['offer_partners'] : [];
                        set_query_var('offer_partners', $offer_partners);
                        locate_template('template-parts/single-offer/offer_partners.php', true, true);
                        ?>
                    </div>
                </div>
                <!-- Featured Image Column -->
                <div class="col-lg-6">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php
                        // Get post thumbnail ID
                        $thumbnail_id = get_post_thumbnail_id(get_the_ID());

                        // Set custom image sizes
                        $desktop_size = 'program_banner';
                        $mobile_size = 'specialization_card_thumb';

                        // Get image URLs (with fallback)
                        $image_url_mobile = wp_get_attachment_image_src($thumbnail_id, $mobile_size)[0] ?? '';
                        $image_url_desktop = wp_get_attachment_image_src($thumbnail_id, $desktop_size)[0] ?? '';
                        ?>

                        <!-- Display the Image as Background -->
                        <div class="image_bg responsive-image" role="img"
                             data-mobile="<?php echo esc_url($image_url_mobile); ?>"
                             data-desktop="<?php echo esc_url($image_url_desktop); ?>"
                             style="background-image: url('<?php echo esc_url($image_url_desktop); ?>');">
                        </div>

                    <?php endif; ?>

                </div>
            </div>
    </section>

<?php
//   Dynamically Load Sections
$sections = [
    'section_why_study',
    'section_student_testimonials',
    'section_after_studies',
    'section_after_graduation',
    'section_for_you_if',
    'section_study_program',
    'section_tuition_fees',
    'section_discounts',
    'section_recruitment_rules'
];

foreach ($sections as $section) {
    get_template_part("template-parts/single-offer/{$section}");
}
?>