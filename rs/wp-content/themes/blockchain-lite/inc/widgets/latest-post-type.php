<?php
if ( ! class_exists( 'CI_Widget_Latest_Post_Type' ) ) :
	class CI_Widget_Latest_Post_Type extends WP_Widget {

		protected $defaults = array(
			'title'     => '',
			'post_type' => 'post',
			'random'    => false,
			'count'     => 3,
		);

		function __construct() {
			$widget_ops  = array( 'description' => esc_html__( 'Displays a number of the latest (or random) posts from a specific post type.', 'blockchain-lite' ) );
			$control_ops = array();
			parent::__construct( 'ci-latest-post-type', __( 'Theme - Latest Post Type', 'blockchain-lite' ), $widget_ops, $control_ops );
		}

		function widget( $args, $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );

			$id            = isset( $args['id'] ) ? $args['id'] : '';
			$before_widget = $args['before_widget'];
			$after_widget  = $args['after_widget'];

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$post_type = $instance['post_type'];
			$random    = $instance['random'];
			$count     = $instance['count'];

			if ( 0 === $count ) {
				return;
			}

			$q_args = array(
				'post_type'           => $post_type,
				'ignore_sticky_posts' => true,
				'orderby'             => 'date',
				'order'               => 'DESC',
				'posts_per_page'      => $count,
			);

			if ( $random ) {
				$q_args['orderby'] = 'rand';
				unset( $q_args['order'] );
			}

			$q = new WP_Query( $q_args );

			echo $before_widget;

			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}

			while ( $q->have_posts() ) {
				$q->the_post();

				get_template_part( 'template-parts/widgets/sidebar-item', get_post_type() );
			}
			wp_reset_postdata();

			echo $after_widget;

		} // widget

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title']     = sanitize_text_field( $new_instance['title'] );
			$instance['post_type'] = sanitize_key( $new_instance['post_type'] );
			$instance['random']    = isset( $new_instance['random'] );
			$instance['count']     = absint( $new_instance['count'] );

			return $instance;
		} // save

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );

			$title     = $instance['title'];
			$post_type = $instance['post_type'];
			$random    = $instance['random'];
			$count     = $instance['count'];

			$post_types = $this->get_available_post_types();

			?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'blockchain-lite' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" class="widefat"/></p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php esc_html_e( 'Select a post type to display the latest post from:', 'blockchain-lite' ); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>">
					<?php foreach ( $post_types as $key => $type ) : ?>
						<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $post_type, $key ); ?>>
							<?php echo wp_kses( $type->labels->name, 'strip' ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'random' ) ); ?>"><input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'random' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'random' ) ); ?>" value="1" <?php checked( $random, 1 ); ?> /><?php esc_html_e( 'Show random posts.', 'blockchain-lite' ); ?></label></p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'blockchain-lite' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="number" min="1" step="1" value="<?php echo esc_attr( $count ); ?>" class="widefat"/></p>
			<?php

		} // form

		protected function get_available_post_types( $return = 'objects' ) {
			$return = in_array( $return, array( 'objects', 'names' ), true ) ? $return : 'objects';

			$post_types = get_post_types( array(
				'public' => true,
			), $return );

			unset( $post_types['attachment'] );

			$post_types = apply_filters( 'blockchain_lite_widget_post_types_dropdown', $post_types, __CLASS__ );

			return $post_types;
		}

	} // class

endif;
