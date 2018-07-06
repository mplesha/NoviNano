<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
  exit();

global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "visual_developer_page_version");
$wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "visual_developer_page_version_assign");
$wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "visual_developer_page_version_display");
$wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "visual_developer_page_version_conversion");

delete_option("visual_developer_database_version");