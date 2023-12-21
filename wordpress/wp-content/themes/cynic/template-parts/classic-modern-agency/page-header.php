<?php
$showtitle = cynic_get_meta('cynic_page_title');
if($showtitle == 1 || $showtitle === FALSE || $showtitle == ''){
	if(has_post_thumbnail() && is_page() && !is_front_page()){
		$headingbg = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
	?>
        <!-- ++++ banner ++++ -->
	<section class="banner o-hidden banner-inner" data-bg="<?php echo esc_url($headingbg)?>">
	  <div class="container"> 
		<!--banner text-->
		<div class="banner-txt">
			<?php
					$title = get_the_title();
					if(!empty($title)) { ?>
							<h1><?php the_title(); ?></h1>
							<?php
					}
					do_action('cynic_breadcrumb');
			?>
		</div>
		<!--end banner text--> 
	  </div>
	</section>
	<!-- ++++ end banner ++++ -->
	<?php }else{ if(!is_page(array('Under Construction', '404 Error Page', '404', '404 Error'))) { ?>
			<section class="blog-title">
				<div class="container">
				<div class="row">
					<div class="col-xs-12">
					<?php cynic_page_title()?>
					</div>
				</div>
				</div>
			</section>
			<?php } }?>
<?php }?>