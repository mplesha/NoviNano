<?php
/**
 * Hero Section for our theme
 *
 * @package WordPress
 * @subpackage Integral
 * @since Integral 1.0
 */
?>
<section id="welcome" class="hero default">

    <div class="blacklayer"></div>

    <div class="container">
        
        <div class="row">
            
            <div class="col-md-12">
                
                <h1><?php echo get_theme_mod( 'integral_default_header_title1', 'Elegant' ); ?></h1>
                
                <h2><?php echo get_theme_mod( 'integral_default_header_title2', 'Business Theme' ); ?></h2>
                
                <div class="lead text-center">
                    <p><?php echo get_theme_mod( 'integral_default_header_tagline', 'A one-page theme for professionals, agencies and businesses.<br />Create a stunning website in minutes.' ); ?></p>
                </div>              
                
                <?php if ( get_theme_mod( 'integral_default_header_btn1_toggle' ) == '' && get_theme_mod( 'integral_default_header_btn2_toggle' ) == '1' ) { ?>
                <div class="col-md-12 text-center">
                    <a href="<?php echo get_theme_mod( 'integral_default_header_btn1url', 'https://www.themely.com/themes/integral/' ); ?>" class="btn btn-lg btn-secondary"><?php echo get_theme_mod( 'integral_default_header_btn1', 'View Features' ); ?></a>
                </div>
                <?php } else if ( get_theme_mod( 'integral_default_header_btn1_toggle' ) == '') { ?>
                <div class="col-md-6 text-right">
                    <a href="<?php echo get_theme_mod( 'integral_default_header_btn1url', 'https://www.themely.com/themes/integral/' ); ?>" class="btn btn-lg btn-secondary"><?php echo get_theme_mod( 'integral_default_header_btn1', 'View Features' ); ?></a>
                </div>
                <?php } ?>
                
                <?php if ( get_theme_mod( 'integral_default_header_btn2_toggle' ) == '' && get_theme_mod( 'integral_default_header_btn1_toggle' ) == '1' ) { ?>
                <div class="col-md-12 text-center">
                    <a href="<?php echo get_theme_mod( 'integral_default_header_btn2url', 'https://www.themely.com/themes/integral/' ); ?>" class="btn btn-lg btn-primary"><?php echo get_theme_mod( 'integral_default_header_btn2', 'Download Now' ); ?></a>
                </div>
                <?php } else if ( get_theme_mod( 'integral_default_header_btn2_toggle' ) == '') { ?>
                <div class="col-md-6 text-left">
                    <a href="<?php echo get_theme_mod( 'integral_default_header_btn2url', 'https://www.themely.com/themes/integral/' ); ?>" class="btn btn-lg btn-primary"><?php echo get_theme_mod( 'integral_default_header_btn2', 'Download Now' ); ?></a>
                </div>
                <?php } ?>
            
            </div>
        
        </div>
    
    </div>

</section><!--hero-->