<?php


$preview_url = add_query_arg( 'cactus_templates', '', home_url() );

$html = '';

if ( is_array( $templates_array ) ) {
	$html .= '<div class="cactus-template-dir wrap">';
	$html .= '<h1 class="wp-heading-inline">' . __( 'Cactus Template Directory', 'cactus-companion' ) . '</h1>';
	$html .= '<div class="cactus-template-browser">';

	foreach ( $templates_array as $template => $properties ) {
		$html .= '<div class="cactus-template">';
		$html .= '<div class="more-details cactus-preview-template" data-demo-url="' . esc_url( $properties['demo_url'] ) . '" data-template-slug="' . esc_attr( $template ) . '" ><span>' . __( 'More Details', 'cactus-companion' ) . '</span></div>';
		$html .= '<div class="cactus-template-screenshot">';
		$html .= '<img src="' . esc_url( $properties['screenshot'] ) . '" alt="' . esc_html( $properties['title'] ) . '" >';
		$html .= '</div>'; // .cactus-template-screenshot
		$html .= '<h2 class="template-name template-header">' . esc_html( $properties['title'] ) . '</h2>';
		$html .= '<div class="cactus-template-actions">';

		if ( ! empty( $properties['demo_url'] ) ) {
			$html .= '<a class="button cactus-preview-template" data-demo-url="' . esc_url( $properties['demo_url'] ) . '" data-template-slug="' . esc_attr( $template ) . '" >' . __( 'Preview', 'cactus-companion' ) . '</a>';
		}
		$html .= '</div>'; // .cactus-template-actions
		$html .= '</div>'; // .cactus-template
	}
	$html .= '</div>'; // .cactus-template-browser
	$html .= '</div>'; // .cactus-template-dir
	$html .= '<div class="wp-clearfix clearfix"></div>';
}// End if().

echo $html;
?>

<div class="cactus-template-preview theme-install-overlay wp-full-overlay expanded" style="display: none;">
	<div class="wp-full-overlay-sidebar">
		<div class="wp-full-overlay-header">
			<button class="close-full-overlay"><span class="screen-reader-text"><?php _e( 'Close', 'cactus-companion' );?></span></button>
			<div class="cactus-next-prev">
				<button class="previous-theme"><span class="screen-reader-text"><?php _e( 'Previous', 'cactus-companion' );?></span></button>
				<button class="next-theme"><span class="screen-reader-text"><?php _e( 'Next', 'cactus-companion' );?></span></button>
			</div>
			<span class="cactus-import-template button button-primary"><?php _e( 'Import', 'cactus-companion' );?></span>
		</div>
		<div class="wp-full-overlay-sidebar-content">
			<?php
			foreach ( $templates_array as $template => $properties ) {
				?>
				<div class="install-theme-info cactus-theme-info <?php echo esc_attr( $template ); ?>"
					 data-demo-url="<?php echo esc_url( $properties['demo_url'] ); ?>"
					 data-template-file="<?php echo esc_url( $properties['import_file'] ); ?>"
					 data-template-title="<?php echo esc_html( $properties['title'] ); ?>" 
                     data-template-slug="<?php echo esc_html( $template ); ?>">
					<h3 class="theme-name"><?php echo esc_html( $properties['title'] ); ?></h3>
					<img class="theme-screenshot" src="<?php echo esc_url( $properties['screenshot'] ); ?>"
						 alt="<?php echo esc_html( $properties['title'] ); ?>">
					<div class="theme-details">
						<?php echo esc_html( $properties['description'] ); ?>
					</div>
					<?php
					if ( ! empty( $properties['required_plugins'] ) && is_array( $properties['required_plugins'] ) ) {
					?>
					<div class="cactus-required-plugins">
						<p><?php _e( 'Required Plugins', 'cactus-companion' );?></p>
						<?php
						foreach ( $properties['required_plugins'] as $plugin_slug => $details ) {
							$file_name = isset($details['file'])?$details['file']:'';
							
							if ( cactusTemplater::check_plugin_state( $plugin_slug,$file_name ) === 'install' ) {
								echo '<div class="cactus-installable plugin-card-' . esc_attr( $plugin_slug ) . '">';
								echo '<span class="dashicons dashicons-no-alt"></span>';
								echo $details['title'];
								echo cactusTemplater::get_button_html( $plugin_slug,$file_name );
								echo '</div>';
							} elseif ( cactusTemplater::check_plugin_state( $plugin_slug,$file_name ) === 'activate' ) {
								echo '<div class="cactus-activate plugin-card-' . esc_attr( $plugin_slug ) . '">';
								echo '<span class="dashicons dashicons-admin-plugins" style="color: #ffb227;"></span>';
								echo $details['title'];
								echo cactusTemplater::get_button_html( $plugin_slug,$file_name );
								echo '</div>';
							} else {
								echo '<div class="cactus-installed plugin-card-' . esc_attr( $plugin_slug ) . '">';
								echo '<span class="dashicons dashicons-yes" style="color: #34a85e"></span>';
								echo $details['title'];
								echo '</div>';
							}
						}
						?>
					</div>
					<?php
					}
					?>
				</div><!-- /.install-theme-info -->
			<?php } ?>
		</div>

		<div class="wp-full-overlay-footer">
			<button type="button" class="collapse-sidebar button" aria-expanded="true" aria-label="Collapse Sidebar">
				<span class="collapse-sidebar-arrow"></span>
				<span class="collapse-sidebar-label"><?php _e( 'Collapse', 'cactus-companion' ); ?></span>
			</button>
			<div class="devices-wrapper">
				<div class="devices cactus-responsive-preview">
					<button type="button" class="preview-desktop active" aria-pressed="true" data-device="desktop">
						<span class="screen-reader-text"><?php _e( 'Enter desktop preview mode', 'cactus-companion' ); ?></span>
					</button>
					<button type="button" class="preview-tablet" aria-pressed="false" data-device="tablet">
						<span class="screen-reader-text"><?php _e( 'Enter tablet preview mode', 'cactus-companion' ); ?></span>
					</button>
					<button type="button" class="preview-mobile" aria-pressed="false" data-device="mobile">
						<span class="screen-reader-text"><?php _e( 'Enter mobile preview mode', 'cactus-companion' ); ?></span>
					</button>
				</div>
			</div>

		</div>
	</div>
	<div class="wp-full-overlay-main cactus-main-preview">
		<iframe src="" title="Preview" class="cactus-template-frame"></iframe>
	</div>
</div>
