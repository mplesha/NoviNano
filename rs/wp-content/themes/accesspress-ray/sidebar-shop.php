<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package AccessPress Ray
 */
?>

<?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
	<?php dynamic_sidebar( 'shop-sidebar' ); ?>
<?php endif; ?>
