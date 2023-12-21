<?php
class CynicRandPortfolioGrids{
    public function __construct()
    {
        add_shortcode('cynic_rand_portfolio', array($this, 'shortcodecb'));
        add_action('vc_before_init', array($this, 'addMap'));
    }
    public function addMap()
    {
        if(function_exists('vc_map')){
            $pages = get_posts(array('posts_per_page'=>-1, 'post_type'=>'page'));
			$pagearr = array('Select' => '');
			if($pages && !is_wp_error($pages)){
				foreach($pages as $page){
					$pagearr[$page->post_title] = $page->ID;
				}
			}
            $args = array(
                'base' => 'cynic_rand_portfolio',
                'name' => __('Random Portfolio Grids', 'cynic'),
                "category" => __( "Cynic Global", "cynic"),
                'class' => 'cynic-icon',
                'icon'  => 'cynic-icon',
                'params' => array(
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'More Page',
                        'type' => 'dropdown',
                        'param_name' => 'more_page',
                        'value' => $pagearr,
                    ),
					array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Order By',
                        'type' => 'dropdown',
                        'param_name' => 'orderby',
                        'value' => array(
                            'Id' => 'ID',
                            'Title' => 'title',
                            'Url Slug' => 'name',
                            'Publish Date' => 'date',
                            'Random' => 'rand',
                        ),
                    ),
                    array(
                        "holder" => "div",
                        "class" => "",
                        'heading' => 'Order',
                        'type' => 'dropdown',
                        'param_name' => 'order',
                        'value' => array(
                            'Decending' => 'DESC',
                            'Ascending' => 'ASC',
                        ),
                    ),        
                ),

            );
            vc_map($args);
        }
    }
    public function shortcodecb($atts = array(), $content = null)
    {
        $atts = shortcode_atts(
		array(
			'more_page'=> '',
			'orderby'=> 'ID',
			'order'=> 'DESC',
		), $atts);
        extract($atts);
        $args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => 4,
                'orderby' => $orderby,
                'order' => $order,
                'ignore_sticky_posts' => true,
			);
        $query = new WP_Query($args);
        $categories = array();
        ob_start();
        if($query->have_posts()){
			$counter = 0;
			?>
			<div class="portfolio">
            <div class="row">
				<div class="col-md-4 col-sm-4 col-xs-12">
                <?php while($query->have_posts()){
                        $query->the_post();
						if($counter == 1){
							?>
							</div><!--col-md-4-->
							<div class="col-md-8 col-sm-8 col-xs-12">
								<div class="row">
							<?php
						}
						$taxonomy = 'portfolio-cat';
						$categories = wp_get_post_terms( get_the_ID(), $taxonomy );
						if($counter == 0){ // first block
                        ?>
						<div class="protfolio-item small-image-width"> 
							<?php the_post_thumbnail('cynic-portfolio-vlong', array('class'=>'img-responsive'))?>
							<div class="por-overley">
								<div class="text-inner">
									<?php if($categories){?>
									<p class="extra-small-text"><?php echo esc_html( $categories[0]->name )?></p>
									<?php }?>
									<p class="semi-bold medium-text"><?php the_title()?></p>
									<div><a href="#" data-postid="<?php the_ID()?>" data-posttype="portfolio" class="btn btn-nofill proDetModal"><?php esc_html_e('DISCOVER', 'cynic')?></a></div>
								</div>
							</div>
						</div>
						<?php
						}elseif($counter % 3 == 0){
						?>
						<!-- Start Portfolio -->
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="protfolio-item"> 
								<?php the_post_thumbnail('cynic-portfolio-hlong', array('class'=>'img-responsive'))?>
								<div class="por-overley">
									<div class="text-inner">
										<?php if($categories){?>
										<p class="extra-small-text"><?php echo esc_html( $categories[0]->name )?></p>
										<?php }?>
										<p class="semi-bold medium-text"><?php the_title()?></p>
										<div><a href="#" data-postid="<?php the_ID()?>" data-posttype="portfolio" class="btn btn-nofill proDetModal"><?php esc_html_e('DISCOVER', 'cynic')?></a></div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Portfolio -->
						<?php
						}else{ // all other blocks
						?>
						<!-- Start Portfolio -->
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="protfolio-item small-image-width"> 
								<?php the_post_thumbnail('cynic-portfolio-hveq', array('class'=>'img-responsive'))?>
								<div class="por-overley">
									<div class="text-inner">
										<?php if($categories){?>
										<p class="extra-small-text"><?php echo esc_html( $categories[0]->name )?></p>
										<?php }?>
										<p class="semi-bold medium-text"><?php the_title()?></p>
										<div><a href="#" data-postid="<?php the_ID()?>" data-posttype="portfolio" class="btn btn-nofill proDetModal"><?php esc_html_e('DISCOVER', 'cynic')?></a></div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Portfolio -->
						<?php
						}
						if($counter > 0 && $counter % 2 == 0){
							?>
							</div><div class="row">
							<?php
						}
						
					$counter++;
                }
				if($counter > 1){
                ?>
					</div><!--row-->
				<?php }?>
				</div><!--col-md-8 or col-md-4-->
            </div><!--row-->
			<?php $page_for_posts = $more_page;
			if($page_for_posts){
			?>
			<!--read more blog button-->
			<div><a href="<?php echo get_permalink((int)$page_for_posts)?>" class="btn btn-fill full-width"><?php esc_html_e('Discover more', 'cynic')?></a></div>
			<?php }?>
			<!--end read more blog button--> 
		</div><!--portfolio-->
        <?php
        }
        wp_reset_postdata();
        return ob_get_clean();
        
    }
}