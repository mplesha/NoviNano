<?php

if( is_active_sidebar( 'sidebar-woo-archives' ) ) {
		dynamic_sidebar('sidebar-woo-archives');
	}elseif( is_active_sidebar( 'sidebar-1' ) ) {
		dynamic_sidebar('sidebar-1');
	}