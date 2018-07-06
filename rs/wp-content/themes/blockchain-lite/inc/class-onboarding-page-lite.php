<?php
	class Blockchain_Lite_Onboarding_Page_Lite extends Blockchain_Lite_Onboarding_Page {
		/**
		 * Populate the support tab
		 *
		 * @return void
		 */
		public function upgrade_pro() {
			?>
			<h3><?php echo wp_kses( __( 'Did you know there is a <strong>pro</strong> version?', 'blockchain-lite' ), blockchain_lite_get_allowed_tags() ); ?></h3>
			<div class="three-col">
				<table class="blockchain-lite-onboarding-table">
					<tr>
						<th class="blockchain-lite-onboarding-feature"></th>
						<th class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'Lite', 'blockchain-lite' ); ?></th>
						<th class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Pro', 'blockchain-lite' ); ?></th>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( '24/7 Support', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Responsive Layout', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Documentation', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Upload Your Own Logo', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Social Networking Options', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'WooCommerce Support', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Color Customization Options', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'Limited', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Extended', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Translation Ready', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Portfolio Post Type', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'No', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Services Post Type', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'No', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Case Studies Post Type', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'No', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Team Post Type', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'No', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Jobs Post Type', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'No', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Events Post Type', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'No', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Testimonials Post Type', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'No', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( '1, 2, 3 & 4 Column Layout Options With Masonry Support For All Post Types', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'No', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Custom Widgets', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite">1</td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro">14</td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Cryptocurrency Widgets', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'No', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Cryptocurrency Shortcodes', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'No', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Cryptocurrency Custom Elementor Modules', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'No', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Widgetized Homepage template', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'No', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"><?php esc_html_e( 'Page Builder Support', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"><?php esc_html_e( 'No', 'blockchain-lite' ); ?></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-pro"><?php esc_html_e( 'Yes', 'blockchain-lite' ); ?></td>
					</tr>
					<tr>
						<td class="blockchain-lite-onboarding-feature"></td>
						<td class="blockchain-lite-onboarding-col blockchain-lite-onboarding-lite"></td>
						<td class="blockchain-lite-onboarding-col">
							<a href="https://www.cssigniter.com/themes/blockchain/" class="button button-primary button-action" target="_blank"><?php esc_html_e( 'Upgrade Today!', 'blockchain-lite' ); ?></a>
						</td>
					</tr>
				</table>
			</div>
			<?php
		}
	}

