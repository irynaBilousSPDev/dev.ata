<?php
$acf_fields = get_query_var('acf_fields', []);
$recruitment_rules = !empty($acf_fields['recruitment_rules']) ? $acf_fields['recruitment_rules'] : [];
// Check if section data exists before rendering
if (!empty($recruitment_rules)) :
    $title = $recruitment_rules['title'] ?? '';
    $sub_title = $recruitment_rules['sub_title'] ?? '';
    $steps = $recruitment_rules['steps'] ?? '';
    ?>
    <section class="section_recruitment_rules">
        <div class="container">
            <?php if (!empty($title)) : ?>
                <h2 class="title_section mb-5"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
        </div>
        <?php
        $image = $recruitment_rules['image'] ?? [];

        $image_url_fallback = !empty($image['url']) ? esc_url($image['url']) : '';

        $image_url_mobile = !empty($image['sizes']['program_image_mobile']) ? esc_url($image['sizes']['program_image_mobile']) : $image_url_fallback;
        $image_url_desktop = !empty($image['sizes']['program_image']) ? esc_url($image['sizes']['program_image']) : $image_url_fallback;

        $alt_text = !empty($image['alt']) ? esc_attr($image['alt']) : __('Recruitment rules Image', 'akademiata');

        ?>
        <div class="image_bg mb-5 responsive-image" role="img"
             aria-label="<?php echo $alt_text; ?>"
             data-mobile="<?php echo $image_url_mobile; ?>"
             data-desktop="<?php echo $image_url_desktop; ?>"
             style="background-image: url('<?php echo $image_url_desktop; ?>');">
            <div class="container">
                <div class="recruitment_rules">
                    <?php if (!empty($sub_title)) : ?>
                        <h3 class="primary_color mb-5"><?php echo esc_html($sub_title); ?></h3>
                    <?php endif; ?>
                    <div class="steps">
                        <?php foreach ($steps as $key => $step) :
                            $text = $step['text'] ?? '';
                            ?>
                            <div class="step">
                                <span class="step_number primary_color"><?php echo $key + 1; ?></span> <br>
                                <?php echo $text; ?>
                                <?php
                                if ($key === 0) : ?>
                                    <a class="button-sing_up" href="/"><?php echo __('ZAPISZ SIĘ') ?></a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="portfolio py-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-2">
                        <h2 class="title_section mb-5">Portfolio</h2>
                    </div>
                    <div class="col-xl-9">
                        <h3 class="title px-5 mb-5">Na portfolio powinno składać się od 5 do 10 prac w formacie co
                            najmniej
                            A3, wykonanych ołówkiem, w tym:</h3>

                        <div class="portfolio_works">

                            <div class="item">
                                <div class="details">
                                    min. 3 rysunki z natury przedstawiające architekturę,
                                </div>
                                <?php $image_url = esc_url(get_template_directory_uri()) . '/static/img/Portfolio1.png';
                                $image_alt = 'image'; ?>
                                <div class="images">
                                    <img src="<?php echo esc_url($image_url); ?>" alt=" ">
                                    <img src="<?php echo esc_url($image_url); ?>" alt=" ">
                                    <img src="<?php echo esc_url($image_url); ?>" alt=" ">
                                </div>
                            </div>
                            <div class="item">
                                <div class="details">
                                    min. 2 rysunki martwej natury stanowiące kompozycje z prostych brył geometrycznych,
                                    sprzętów, tkanin.
                                </div>
                                <?php $image_url = esc_url(get_template_directory_uri()) . '/static/img/Portfolio2.png';
                                $image_alt = 'image'; ?>
                                <div class="images">
                                    <img src="<?php echo esc_url($image_url); ?>" alt=" ">
                                    <img src="<?php echo esc_url($image_url); ?>" alt=" ">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="description">
                    Prace możesz wgrać w systemie online podczas rekrutacji
                    <a class="button-sing_up" href="/">ZAPISZ SIĘ</a> <span>(fromat: pdf, jpg, tiff.) </span>
                    lub osobiście złożyć w Rektoracie lub osobiście złożyć w Rektoracie
                </div>

                <h2 class="title my-5">
                    więcej o portfolio dowiesz się z filmu:
                </h2>
                <?php $portfolio_image_url = esc_url(get_template_directory_uri()) . '/static/img/portfolio_video.webp';
                $image_alt = 'image'; ?>
                <div class="portfolio_video">
                    <img src="<?php echo esc_url($portfolio_image_url); ?>" alt=" ">
                </div>
                <?php

                $video_id = !empty($acf_fields['youtube_video_id']) ? esc_attr($acf_fields['youtube_video_id']) : '';
//                $video_id = 'x6NUZ8dc9Qg';
                if (!empty($video_id)): ?>
                    <div class="youtube-wrapper">
                        <div class="youtube-video" data-video-id="<?php echo $video_id; ?>"></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>