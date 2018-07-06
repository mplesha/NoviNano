<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<?php
	$body_class = 'page blog';
	$scheme = cactus_option('scheme');
	
	if ( is_page_template('template-sections.php') )
		$body_class .= ' frontpage';

		$body_class .= ' '.$scheme;
	
	
?>
<body <?php body_class( $body_class ); ?>>

  <div class="wrapper">
        <!--Header-->
        <?php get_template_part( 'template-parts/header/header', 'image' ); ?>
        <?php 
		$header_style = cactus_option('header_style');
		if($header_style=='' || $header_style=='default' )
			$header_style = 'inline';
		
		$hide_header = apply_filters('cactus_hide_header',0);
		if( $hide_header != '1' )
			get_template_part( 'template-parts/header/header', $header_style ); 
		
		?>