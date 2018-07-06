<?php
$tabs = apply_filters('mesmerize_info_page_tabs', array(
    'getting-started' => array(
        'title'   => __('Getting started', 'mesmerize'),
        'partial' => get_template_directory() . "/inc/infopage-parts/getting-started.php",
    ),

));

$currentTab = (isset($_REQUEST['tab']) && isset($tabs[$_REQUEST['tab']])) ? $_REQUEST['tab'] : 'getting-started';

?>


<div class="wrap about-wrap full-width-layout mesmerize-page">
    <h1><?php _e('Thanks for choosing Mesmerize!', 'mesmerize'); ?></h1>
    <p><?php _e('We\'re glad you chose our theme and we hope it will help you create a beautiful site in no time!<br> If you have any suggestions, don\'t hesitate to leave us some feedback.', 'mesmerize'); ?></p>

    <img class="site-badge" src="https://extendthemes.com/mesmerize/wp-content/uploads/2017/11/logo-mesmerize.svg">
    <h2 class="nav-tab-wrapper wp-clearfix">
        
        <?php foreach ($tabs as $tabID => $tab): ?>
            <a href="?page=mesmerize-welcome&tab=<?php echo $tabID; ?>" class="nav-tab <?php echo($tabID === $currentTab ? 'nav-tab-active' : '') ?>"><?php esc_html_e($tab['title']) ?></a>
            <?php $first = false; ?>
        <?php endforeach; ?>
    </h2>

    <div class="tab-group">
        <div class="tab-item tab-item-active">
            <?php require $tabs[$currentTab]['partial']; ?>
        </div>
    </div>
</div>
