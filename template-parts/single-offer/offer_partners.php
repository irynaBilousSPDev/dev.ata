<?php
// Correct `get_query_var()` Usage
$offer_partners = get_query_var('offer_partners', []);

// Ensure `$offer_partners` is an array before accessing keys
$offer_partners = is_array($offer_partners) ? $offer_partners : [];

// Get Title (Use Default if Empty)
$partners_title = !empty($offer_partners['title'])
    ? esc_html($offer_partners['title'])
    : __('PARTNERZY KIERUNKU', 'akademiata');

// Get Partner Logos
$partners_logo = !empty($offer_partners['partners_logo']) && is_array($offer_partners['partners_logo'])
    ? $offer_partners['partners_logo']
    : [];
?>

<div class="offer_partners my-5">
    <h2><?php echo $partners_title; ?></h2>

    <div class="partners_logo">
        <?php if (!empty($partners_logo)) : ?>
            <?php foreach ($partners_logo as $logo) :
                // Ensure Image URL Exists
                $image_url = !empty($logo['image']['sizes']['partner_logo'])
                    ? esc_url($logo['image']['sizes']['partner_logo'])
                    : esc_url(get_template_directory_uri() . '/static/img/default-partner-logo.png'); // Fallback Image

                // Get Alt Text or Default
                $alt_text = !empty($logo['image']['alt'])
                    ? esc_attr($logo['image']['alt'])
                    : __('Partner Logo', 'akademiata');

                // Get Image ID & Metadata
                $image_id = !empty($logo['image']['ID']) ? $logo['image']['ID'] : null;
                $image_meta = $image_id ? wp_get_attachment_metadata($image_id) : [];
                $image_width = !empty($image_meta['width']) ? $image_meta['width'] : 245;
                $image_height = !empty($image_meta['height']) ? $image_meta['height'] : 56;
                ?>
                <img src="<?php echo $image_url; ?>"
                     width="<?php echo esc_attr($image_width); ?>"
                     height="<?php echo esc_attr($image_height); ?>"
                     alt="<?php echo $alt_text; ?>">
            <?php endforeach; ?>
        <?php else : ?>
            <!-- Fallback Image If No Logos Are Found -->
            <img src="<?php echo esc_url(get_template_directory_uri() . '/static/img/partner_logo_mazowiecka_okrengowa_izba_architektow_RP.webp'); ?>"
                 width="245" height="56"
                 alt="<?php echo __('Partner Logo', 'akademiata'); ?>">
        <?php endif; ?>
    </div>
</div>
