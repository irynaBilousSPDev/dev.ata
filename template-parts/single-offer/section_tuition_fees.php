<?php
$acf_fields = get_query_var('acf_fields', []);
$tuition_fees = !empty($acf_fields['tuition_fees']) ? $acf_fields['tuition_fees'] : [];
// Check if section data exists before rendering
if (!empty($tuition_fees)) :
    $sub_title = $tuition_fees['sub_title'] ?? '';
    $title = $tuition_fees['title'] ?? '';
    $payments = $tuition_fees['payments'] ?? [];
    $description = $tuition_fees['description'] ?? '';
    $table_price = $tuition_fees['table_price'] ?? [];
    ?>
    <section class="section_tuition_fees">
        <div class="container">
            <?php if (!empty($sub_title)) : ?>
                <h2 class="small_title primary_color mb-3">
                    <?php echo esc_html($sub_title); ?>
                </h2>
            <?php endif; ?>
            <?php if (!empty($title)) : ?>
                <h3 class="title_section mb-3">
                    <?php echo $title; ?>
                </h3>
            <?php endif; ?>

            <div class="small_container py-5">
                <div class="row">
                    <?php foreach ($payments as $item) :
                        $title = $item['title'] ?? '';
                        $price = $item['price'] ?? '';
                        $currency = $item['currency'] ?? '';
                        ?>
                        <div class="row payments_item">
                            <?php if (!empty($title)) : ?>
                                <div class="col-md-6 small_title">
                                    <?php echo $title; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($title)) : ?>
                                <div class="col-md-6 col-xl-3">
                                    <span><?php echo esc_html($price); ?>&nbsp;<?php echo $currency; ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php if (!empty($description)) : ?>
                <div class="description py-3 mb-3">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($table_price)) :
                $title = $table_price['title'] ?? ''; ?>

                <div class="small_container">
                    <?php if (!empty($title)) : ?>
                        <h4 class="small_title pb-3 mb-5">
                            <?php echo esc_html($title); ?>
                        </h4>
                    <?php endif; ?>

                    <div class="price_table">

                        <?php get_template_part('./template-parts/tabs_container'); ?>

                        <div class="description  pb-5 mb-5">
                            Opłat należy dokonywać na konto ATA:<br><br>
                            Akademia Techniczno-Artystyczna Nauk Stosowanych w Warszawie<br><br>
                            ul. Olszewska 12, 00-792 Warszawa <br>
                            <strong>Nr rachunku
                                <span title='Copy to clipboard'
                                      class="copy_account_number">43 1030 1508 0000 0008 0061 1008</span>
                            </strong>
                        </div>

                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
