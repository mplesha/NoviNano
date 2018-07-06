<?php
if( is_active_sidebar( 'sidebar-woo-single' ) ) {
		dynamic_sidebar('sidebar-woo-single');
	}elseif( is_active_sidebar( 'sidebar-1' ) ) {
		dynamic_sidebar('sidebar-1');
	}