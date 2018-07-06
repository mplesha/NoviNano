<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return NULL;
}

/**
 * Customize Control for Heading
 */
class WEN_Customize_Heading_Control extends WP_Customize_Control {

  public $type = 'heading';

  public function render_content() {

    ?>
      <h3 class="wen-customize-heading"><?php echo esc_html( $this->label ); ?></h3><!-- .wen-customize-heading -->
    <?php
  }

}

/**
 * Customize Control for Radio Image
 */
class WEN_Customize_Radio_Image_Control extends WP_Customize_Control {

  public $type = 'radio-image';

  public function render_content() {

    if ( empty( $this->choices ) )
      return;

    $name = '_customize-radio-' . $this->id;

    ?>
    <label>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

      <?php
      foreach ( $this->choices as $value => $label ) :
        ?>
        <label>
          <input type="radio" value="<?php echo esc_attr( $value ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> class="stylish-radio-image" name="<?php echo esc_attr( $name ); ?>"/>
            <span><img src="<?php echo esc_url($label); ?>" alt="<?php echo esc_attr( $value ); ?>" /></span>
        </label>
        <?php
      endforeach;
       ?>

    </label>
    <?php
  }

}


/**
 * Customize Control for Taxonomy Select
 */
class WEN_Customize_Dropdown_Taxonomies_Control extends WP_Customize_Control {

  public $type = 'dropdown-taxonomies';

  public $taxonomy = '';


  public function __construct( $manager, $id, $args = array() ) {

    $our_taxonomy = 'category';
    if ( isset( $args['taxonomy'] ) ) {
      $taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
      if ( true === $taxonomy_exist ) {
        $our_taxonomy = esc_attr( $args['taxonomy'] );
      }
    }
    $args['taxonomy'] = $our_taxonomy;
    $this->taxonomy = esc_attr( $our_taxonomy );

    parent::__construct( $manager, $id, $args );
  }

  public function render_content() {

    $tax_args = array(
      'hierarchical' => 0,
      'taxonomy'     => $this->taxonomy,
    );
    $all_taxonomies = get_categories( $tax_args );

    ?>
    <label>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
         <select <?php $this->link(); ?>>
            <?php
              printf('<option value="%s" %s>%s</option>', '', selected($this->value(), '', false),__( 'Select', 'wen-business' ) );
             ?>
            <?php if ( ! empty( $all_taxonomies ) ): ?>
              <?php foreach ( $all_taxonomies as $key => $tax ) : ?>
                <?php
                  printf('<option value="%s" %s>%s</option>', $tax->term_id, selected($this->value(), $tax->term_id, false), $tax->name );
                 ?>
              <?php endforeach ?>
           <?php endif ?>
         </select>

    </label>
    <?php
  }

}
