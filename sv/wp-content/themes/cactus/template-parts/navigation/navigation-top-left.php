<?php
	$class = 'cactus-navigation';
	$display_custom_main_menu = cactus_option('display_custom_main_menu');
	$display_shopping_cart_icon = cactus_option('display_shopping_cart_icon');
	$header_menu_hover_style = cactus_option('header_menu_hover_style');
	$header_menu_hover_style .= ' cactus-main-nav cactus-nav-left';
	$addClass = '';
?>
<?php
	$icons_by_menu = '<div class="cactus-f-microwidgets">';

	if ($display_shopping_cart_icon == '1')
    	$icons_by_menu .= '<div class="cactus-microwidget cactus-shopping-cart" style="z-index:9999;">
						<a href="#" class="cactus-shopping-cart-label"></a>
                        <div class="cactus-shopping-cart-wrap left-overflow">
                            <div class="cactus-shopping-cart-inner">
                                <ul class="cart_list product_list_widget empty">
                                    <li>'.apply_filters('cactus_shopping_cart',esc_html__( 'No products in the cart.', 'cactus' )).'</li>
                                </ul>
                            </div>
                        </div>
                    </div>';
      $icons_by_menu .= '</div>';

?>
<?php if( (is_page_template('template-sections.php') && $display_custom_main_menu == '1') /*|| is_customize_preview()*/ ){
	$addClass .= ' frontpage_menu_left_selective split_header_left_menu_selective';
	//if(!is_page_template('template-sections.php') || $display_custom_main_menu != '1')
		//$addClass .= ' hide';
	?>

<nav class="<?php echo $class.$addClass;?>" role="navigation">
  <?php
	
			$frontpage_menu = cactus_option('split_header_left_menu');
			echo '<ul id="top-menu-left" class="'.$header_menu_hover_style.'">';
			if(is_array($frontpage_menu) && !empty($frontpage_menu)):
  				foreach($frontpage_menu as $item):
					$icon = '';
					if( isset($item['icon']) && trim( $item['icon'] )!='' )
						$icon = '<i class="fa '.esc_attr($item['icon']).'"></i>';
					if(trim($item['title'] )!='')
					echo '<li><a href="' . esc_url( trim($item['link']) ) . '"><span>' . $icon.' '  . esc_attr( $item['title'] ) . '</span></a></li>';
				endforeach;
			endif;
			echo '</ul>';

	?>
    <?php
echo $icons_by_menu;
?>

</nav>
<?php }	?>

  <?php if( !is_page_template('template-sections.php') || $display_custom_main_menu != '1' /*|| is_customize_preview()*/ ){
	  $addClass = ' cactus-wp-menu';
	  //if( is_page_template('template-sections.php') && $display_custom_main_menu == '1')
	  //	$addClass .= ' hide';
	  ?>
<nav class="<?php echo $class.$addClass;?>" role="navigation">
  <?php

		   wp_nav_menu( array(
			'theme_location' => 'top-left',
			'menu_id'        => 'top-menu-left',
			'menu_class' => $header_menu_hover_style,
			'fallback_cb'    => 'cactus_menu_fallback',
			'container' =>'',
			'link_before' => '<span>',
   			'link_after' => '</span>',
		) );
	?>
    <?php
echo $icons_by_menu;
?>

</nav>

<?php }	?>
