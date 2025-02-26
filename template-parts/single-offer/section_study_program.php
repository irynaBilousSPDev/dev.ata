<?php
$acf_fields = get_query_var('acf_fields', []);
$study_program = $acf_fields['study_program'] ?? [];
$program_info = $acf_fields['program_info'] ?? [];
$subjects_study = $acf_fields['subjects_study'] ?? [];

?>

<section class="section_study_program">

    <?php if (!empty($study_program)) :
        $title = $study_program['title'] ?? '';
        $sub_title = $study_program['sub_title'] ?? '';
        $program_percentages = $study_program['program_percentages'] ?? '';
        $button = !empty($study_program['button']) ? $study_program['button'] : null;
        ?>
        <div class="container">
            <?php if (!empty($title)) : ?>
                <h2 class="title_section d-flex justify-content-between align-items-start mb-3">
                    <?php echo esc_html($title); ?>
                    <?php if (!empty($button)) : ?>
                        <?php render_acf_button($button); ?>
                    <?php endif; ?>
                </h2>
            <?php endif; ?>
            <?php if (!empty($sub_title)) : ?>
                <h3 class="small_title primary_color pb-5 mb-5">
                    <?php echo esc_html($sub_title); ?>
                </h3>
            <?php endif; ?>
            <?php if (!empty($program_percentages)) : ?>
            <div class="program_percentages py-5 my-5">
                <div class="row">
                    <?php
                    // Define Default Titles
                    $titles = [
                        'ĆWICZENIA',
                        'WYKŁADY',
                        'PRAKTYKI ZAWODOWE',
                        'NUDNE ZAJĘCIA',
                    ];
                    foreach ($program_percentages as $index => $item) :
                        // Use provided title or fallback from $titles
                        $title = !empty(trim($item['title'])) ? $item['title'] : ($titles[$index] ?? '');

                        // Ensure percentage exists
                        $percent = $item['percent'] ?? '';
                        ?>
                        <div class="col-md-6 col-xl-3">
                            <div class="item text-center">
                                <h3 class="sub_title"><?php echo esc_html($title); ?></h3>
                                <div class="number"><?php echo esc_html($percent); ?></div>
                            </div>
                        </div>
                    <?php endforeach;; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($program_info)) :

        $image = $program_info['image'] ?? [];

        $image_url_fallback = !empty($image['url']) ? esc_url($image['url']) : '';

        $image_url_mobile = !empty($image['sizes']['program_image_mobile']) ? esc_url($image['sizes']['program_image_mobile']) : $image_url_fallback;
        $image_url_desktop = !empty($image['sizes']['program_image']) ? esc_url($image['sizes']['program_image']) : $image_url_fallback;

        $alt_text = !empty($image['alt']) ? esc_attr($image['alt']) : __('Program Image', 'akademiata');

        ?>
        <div class="program_info">
            <div class="image_bg responsive-image" role="img"
                 aria-label="<?php echo $alt_text; ?>"
                 data-mobile="<?php echo $image_url_mobile; ?>"
                 data-desktop="<?php echo $image_url_desktop; ?>"
                 style="background-image: url('<?php echo $image_url_desktop; ?>');">
                <div class="container">
                    <?php
                    $post_id = get_the_ID();

                    // Get ECTS value (fallback to empty string if not set)
                    $ects = isset($program_info['ects']) ? esc_html($program_info['ects']) : '';

                    // Define multiple taxonomies to retrieve
                    $taxonomies = [
                        'program' => __('Rodzaj studiów', 'akademiata'),
                        'duration' => __('Trwają', 'akademiata'),
                        'obtained_title' => __('Uzyskany tytuł', 'akademiata'),
                    ];

                    $counter = 0; // Counter to track iteration order
                    ?>

                    <div class="program_info_details">
                        <?php foreach ($taxonomies as $taxonomy => $label) :
                            $terms = get_the_terms($post_id, $taxonomy);
                            if (!empty($terms) && !is_wp_error($terms)) :
                                // Show first taxonomy
                                ?>
                                <div class="item text-center">
                                    <h3 class="small_title"><?php echo esc_html($label); ?></h3>
                                    <h4 class="small_title">
                                        <?php echo esc_html(implode(', ', wp_list_pluck($terms, 'name'))); ?>
                                    </h4>
                                </div>
                                <?php
                                // Show ECTS section as second element
                                if ($counter === 0 && !empty($ects)) : ?>
                                    <div class="item text-center">
                                        <h3 class="small_title"><?php esc_html_e('Mają wartość', 'akademiata'); ?></h3>
                                        <h4 class="small_title">
                                            <?php echo esc_html($ects) . ' ' . esc_html__('punktów ECTS', 'akademiata'); ?>
                                        </h4>
                                    </div>
                                <?php endif;
                                $counter++;
                            endif;
                        endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($subjects_study)) :
        $title = $subjects_study['title'] ?? '';
        $accordion = $subjects_study['subjects_study_accordion'] ?? []; // Fixed Variable Reference
        ?>

        <div class="section_subjects_study py-5 my-5">
            <div class="container">

                <?php if (!empty($title)) : ?>
                    <h2 class="sub_title mb-5">
                        <?php echo esc_html($title); ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($accordion)) : ?>
                    <?php
                    set_query_var('subjects_study_accordion', $accordion);
                    get_template_part('template-parts/accordion'); //  Removed Unnecessary `./`
                    ?>
                <?php endif; ?>

            </div>
        </div>

    <?php endif; ?>


</section>
