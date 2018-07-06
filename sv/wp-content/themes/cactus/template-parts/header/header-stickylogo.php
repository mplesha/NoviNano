<?php

$logo = cactus_option('sticky_logo');
if (is_numeric($logo)) {
			$image_attributes = wp_get_attachment_image_src($logo, 'full');
			$logo    = $image_attributes[0];
		  }
if ( $logo || get_theme_mod( 'custom_logo' ) ) {
		if(!$logo){
			$image_attributes = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
			$logo = $image_attributes[0];
		}
		$logo = '<a href="'.esc_url( home_url( '/' ) ).'"><img src="' . esc_url( $logo ) . '"></a>';
		echo $logo;
	}else{
?>
<?php
	$header_text_color = get_header_textcolor();

?>
<?php if ( 'blank' != $header_text_color ) :?>

  <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
  <h2 class="site-name">
    <?php bloginfo( 'name' ); ?>
  </h2>
  </a>
<?php endif;?>

<?php	
		}		
?>

