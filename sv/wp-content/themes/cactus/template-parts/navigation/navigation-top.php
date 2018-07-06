<?php
	global $allowedtags;
	$header_style = cactus_option('header_style');
	$display_custom_main_menu = cactus_option('display_custom_main_menu');
	$display_shopping_cart_icon = cactus_option('display_shopping_cart_icon');
	$display_search_icon = cactus_option('display_search_icon');
	if($header_style=='')
		$header_style = 'default';
	$class = 'cactus-navigation';
	if($header_style=='classic')
		$class .= ' cactus-style-top-line-full';
	$header_menu_hover_style = cactus_option('header_menu_hover_style');
	$header_menu_hover_style .= ' cactus-main-nav cactus-nav-main';
	$addClass = '';
	
?>

<?php
	$icons_by_menu = '<div class="cactus-f-microwidgets">';
	if ($display_shopping_cart_icon == '1' && $header_style !== 'split')
    	$icons_by_menu .= '<div class="cactus-microwidget cactus-shopping-cart" style="z-index:9999;">
							<a href="#" class="cactus-shopping-cart-label"></a>
                        <div class="cactus-shopping-cart-wrap right-overflow">
                            <div class="cactus-shopping-cart-inner">
                                <ul class="cart_list product_list_widget empty">
                                    <li>'.apply_filters('cactus_shopping_cart',esc_html__( 'No products in the cart.', 'cactus' )).'</li>
                                </ul>
                            </div>
                        </div>
                    </div>';
	if ($display_search_icon == '1' )
        $icons_by_menu .= '<div class="cactus-microwidget cactus-search" style="z-index:9999;">
                        <div class="cactus-search-label"></div>
                        <div class="cactus-search-wrap right-overflow" style="display:none;">
                            <form action="" class="search-form">
                                <div>
                                        <span class="screen-reader-text">'.esc_html__( 'Search for', 'cactus' ).':</span>
                                        <input type="text" class="search-field" placeholder="'.esc_html__( 'Search', 'cactus' ).' …" value="" name="s">
                                        <input type="submit" class="search-submit" value="'.esc_html__( 'Search', 'cactus' ).'">
                                </div>                                    
                            </form>
                        </div>
                    </div>';
      $icons_by_menu .= '</div>';

?>
<?php if( (is_page_template('template-sections.php') && $display_custom_main_menu == '1') /*|| is_customize_preview()*/ ){
	$addClass .= ' frontpage_menu_selective';
	//if(!is_page_template('template-sections.php') || $display_custom_main_menu != '1')
		//$addClass .= ' hide';
	?>
<nav class="<?php echo $class.$addClass;?>" role="navigation">
  <?php
	
			$frontpage_menu = cactus_option('frontpage_menu');
			echo '<ul id="top-menu" class="'.$header_menu_hover_style.'">';
			
			if( is_customize_preview() ):
      echo '<span class="customize-partial-edit-shortcut customize-partial-edit-shortcut-frontpage_menu_selective"><button aria-label="'.esc_html__( 'Click to edit this element.', 'cactus' ).'" title="'.esc_html__( 'Click to edit this element.', 'cactus' ).'" class="customize-partial-edit-shortcut-button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button></span>';
      endif;
      
			if(is_array($frontpage_menu) && !empty($frontpage_menu)):
  				foreach($frontpage_menu as $item):
					$icon = '';
					if( isset($item['icon']) && trim( $item['icon'] )!='')
						$icon = '<i class="fa '.esc_attr($item['icon']).'"></i>';
					if(trim( $item['title'] )!='')
					echo '<li><a href="' . esc_url( trim($item['link']) ) . '"><span>' . $icon.' '.wp_kses( $item['title'], $allowedtags ) . '</span></a></li>';
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
	 // if( is_page_template('template-sections.php') && $display_custom_main_menu == '1')
	  //	$addClass .= ' hide';
	  ?>
<nav class="<?php echo $class.$addClass;?>" role="navigation">
  <?php
	
		   wp_nav_menu( array(
			'theme_location' => 'top',
			'menu_id'        => 'top-menu',
			'menu_class' => $header_menu_hover_style,
			'fallback_cb'    => 'cactus_menu_fallback',
			'container' =>'',
			'link_before' => '<span>',
   			'link_after' => '</span>',
			'walker' => new Cactus_Menu_Walker,
		) );

	?>
    <?php
echo $icons_by_menu;
?>

</nav>

<?php }