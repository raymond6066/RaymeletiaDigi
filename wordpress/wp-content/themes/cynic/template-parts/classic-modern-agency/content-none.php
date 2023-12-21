<section class="no-results not-found">	
	<h2 class="page-title"><?php esc_html_e( 'Nothing Found', 'cynic' ); ?></h2>

	<div class="page-content">
		
		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'cynic' ); ?></p>
		<?php
			get_search_form();
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
