<?php
$top_sliders = cynic_get_meta('cynic_portfolio_type_image', false);
if (isset($top_sliders) && !empty($top_sliders)) { ?>
    <div id="details-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php $carouselImage = 1;
            foreach ($top_sliders as $top_slider) { ?>
                <div class="carousel-item <?php if ($carouselImage == 1) {
                    echo esc_attr('active');
                } ?>">
                    <?php echo wp_get_attachment_image($top_slider, 'full', false, array('class' => 'd-block w-100', 'atl' => '')); ?>
                </div>
                <?php $carouselImage++;
            } ?>
            <!-- End of .carousel-item -->
        </div>
        <!-- End of .carousel-inner -->
        <ol class="carousel-indicators">
            <?php $carouselList = 0;
            foreach ($top_sliders as $top_slider) { ?>
                <li data-target="#details-carousel" data-slide-to="<?php echo esc_attr($carouselList); ?>"
                    class="<?php if ($carouselList == 0) {
                        echo esc_attr('active');
                    } ?>"></li>
                <?php $carouselList++;
            } ?>
        </ol>
        <!-- End of .carousel-indicators -->
        <a class="carousel-control-prev" href="#details-carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="icon-Chevon---Left"></i></span>
        </a>
        <a class="carousel-control-next" href="#details-carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="icon-Chevron---Right"></i></span>
        </a>
    </div>
<?php } ?>
<!-- End of .carousel -->