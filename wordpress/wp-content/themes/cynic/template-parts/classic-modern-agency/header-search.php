<?php
/**
 * Template for displaying search forms in Hoper
 *
 * @package WordPress
 * @subpackage Cynic
 * @since Cynic 1.7
 */
?>
<div class="header-search hidden-sm">
    <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <span class="search-button"><i class="fa fa-search"></i></span>
        <input type="text" name="s" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'cynic' ); ?>"/>
        <button type="submit" class="hidden"></button>
    </form>						
</div>
