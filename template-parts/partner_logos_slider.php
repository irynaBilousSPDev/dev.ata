<section class="section_partner_logos left_spacee" style="background-color: white">
    <div class="partner_logos_slider">
        <?php for ($i = 0; $i < 10; $i++) : ?>
            <div class="col-md-3">
                <img width="" height=""  src="<?php echo esc_url(get_template_directory_uri()) . '/static/img/partner_logos/partner_logo'. ($i + 1) .'.webp'; ?>" alt="">
            </div>
        <?php endfor; ?>
    </div>
</section>

