<?php
/*
Plugin Name: Visual Developer Custom CSS
Plugin URI: http://visual-developer.net
Description: Visual Developer
Version: 1.0.2
Author: Andrei-Robert Rusu
Author URI: http://www.easy-development.com
*/

require_once("visual-developer-core.php");

class VisualDeveloperWordPress extends VisualDeveloper {

  protected static $_instance;

  public static function getInstance() {
    if(self::$_instance == null)
      self::$_instance = new self();

    return self::$_instance;
  }

  public static function resetInstance() {
    self::$_instance = null;
  }

  /**
   * @var VisualDeveloperWordpressDatabaseConnection
   */
  private $_databaseConnectionImplementation = false;

  public $scriptBasePath              = '';
  public $adminAccessOptionName       = 'manage_options';
  public $displayRequestParam         = 'display-visual-developer';
  public $resetRequestParam           = 'reset-visual-developer';

  public $actionQuickAccessRegistration = 'visual_developer_register_quick_access_element';

  public function init() {
    $this->scriptBasePath = dirname(__FILE__) . DIRECTORY_SEPARATOR;

    add_action("init", array($this, 'wordPressInit'));
    add_action( 'admin_bar_menu', array($this, 'toolbarLink'), 999 );
    add_action( 'wp_ajax_' . $this->namespace . 'getLayout', array($this, 'ajaxGetLayoutInformation') );
    add_action( 'wp_ajax_' . $this->namespace . 'setLayout', array($this, 'ajaxSetLayoutInformation') );
    add_action( 'wp_ajax_' . $this->namespace . 'addPageVersion', array($this, 'ajaxAddPageVersion') );
    add_action( 'wp_ajax_' . $this->namespace . 'deletePageVersion', array($this, 'ajaxDeletePageVersion') );

    if( $this->getOptionStorage('welcome_message_confirmed') != true  )
      add_action( 'admin_notices', array( $this, 'gettingStartedNotice' ) );
  }

  public function gettingStartedNotice() {
    echo '<div class="updated">';
    echo  '<h2>' . __( 'Thank you for activating Visual Developer!', 'visual_developer' ) . '</h2>';
    echo  '<p>' . __( "You can notice the 'Toggle Visual Developer' button in the WP Admin Bar." ) . '</p>';
    echo  '<p><a class="button button-primary" href="' . get_home_url() . '?display-visual-developer=1">' . __( "Start Customizing" ) . '</a> ' . __( "( this message will go away once you start customizing )" ) . '</p>';
    echo '</div>';
  }

  public function getVDLibraryFilePath() {
    if($this->scriptBasePath == '')
      return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vd-library' . DIRECTORY_SEPARATOR;

    return $this->scriptBasePath . 'vd-library' . DIRECTORY_SEPARATOR;
  }

  public function hasAdminAccess() {
    return current_user_can( $this->adminAccessOptionName );
  }

  public function allowVisualDeveloperInThisSection() {
    return !is_admin();
  }

  public function getPluginAssetsURLPath() {
    return plugins_url("assets", __FILE__);
  }

  public function getOptionStorage($optionName, $optionDefault = null) {
    return get_option($optionName, $optionDefault);
  }

  public function setOptionStorage($optionName, $optionValue) {
    update_option($optionName, $optionValue);
  }

  public function deleteOptionsStorageByOptionPrefix($optionPrefix) {
    global $wpdb;
    $wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '{$optionPrefix}%'" );
  }

  /**
   * @return string
   */
  public function getUploadsDirectoryFilePath() {
    $uploadDirectory = wp_upload_dir();

    return $uploadDirectory['basedir'] . DIRECTORY_SEPARATOR;
  }

  /**
   * @return string
   */
  public function getUploadsDirectoryURLPath() {
    $uploadDirectory = wp_upload_dir();

    return $uploadDirectory['baseurl'] . DIRECTORY_SEPARATOR;
  }

  /**
   * @return VisualDeveloperWordpressDatabaseConnection
   */
  public function getDatabaseConnectionImplementation() {
    if($this->_databaseConnectionImplementation == false) {
      if(!class_exists('VisualDeveloperWordpressDatabaseConnection'))
        require_once($this->scriptBasePath . 'vd-implementation/databaseConnection.php');

      $this->_databaseConnectionImplementation = new VisualDeveloperWordpressDatabaseConnection();
    }

    return $this->_databaseConnectionImplementation;
  }

  public function wordPressInit() {
    if( $this->hasAdminAccess() && isset($_GET[$this->resetRequestParam]) && $_GET[$this->resetRequestParam] == 1) {
      global $wp;
      $currentURL = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
      $currentURL = str_replace(array("&" . $this->resetRequestParam . '=1', "&" . $this->resetRequestParam . '=0'), '', $currentURL);
      $currentURL = str_replace(array($this->resetRequestParam . '=1', $this->resetRequestParam . '=0'), '', $currentURL);

      $this->resetVisualDeveloper();

      wp_redirect($currentURL);exit;
    }

    $isAdminActive = false;

    if($this->hasAdminAccess()
        && $this->allowVisualDeveloperInThisSection()) {
      if(isset($_GET[$this->displayRequestParam]) && $_GET[$this->displayRequestParam] == true) {
        add_action('wp_enqueue_scripts', array($this, '_initJavascriptLibrary'));
        add_action('wp_footer', array($this, '_initStylesheetsOfLibrary'));

        $isAdminActive = true;

        $this->setOptionStorage( 'welcome_message_confirmed', 1 );
      }
    }

    if($this->allowVisualDeveloperInThisSection() && !$isAdminActive) {
      $postID = intval(url_to_postid( "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ));

      if(isset($_GET['vdv']) && file_exists($this->getCSSFilePath($postID, intval($_GET['vdv']))))
        wp_enqueue_style($this->namespace . 'front-' . $postID . intval($_GET['vdv']), $this->getCSSURLPath($postID, intval($_GET['vdv'])));
      else if(file_exists($this->getCSSFilePath($postID)))
        wp_enqueue_style($this->namespace . 'front-' . $postID, $this->getCSSURLPath($postID));
      else if(file_exists($this->getCSSFilePath()))
        wp_enqueue_style($this->namespace . 'front', $this->getCSSURLPath());
    }
  }

  public function toolbarLink( $wpAdminBar ) {

    $currentURL = $this->_getCurrentPageURL();
    $currentURL .= strpos($currentURL, "?") === false ? '?' : '&';

    if(!isset($_GET[$this->displayRequestParam])
        || (isset($_GET[$this->displayRequestParam]) && $_GET[$this->displayRequestParam] == false))
      $currentURL .= $this->displayRequestParam . '=1';

    if($currentURL[strlen($currentURL) - 1] == "?")
      $currentURL = substr($currentURL, 0, strlen($currentURL) - 1);

    $wpAdminBar->add_node( array(
        'id'    => $this->namespace . 'menu',
        'title' => 'Toggle Visual Developer',
        'href'  => $currentURL
    ) );

    $wpAdminBar->add_node(array(
        'parent' => $this->namespace . 'menu',
        'id'     => $this->namespace . 'menu_reset',
        'title'  => "Reset All Changes",
        'href'   => $currentURL . (strpos($currentURL, "?") === false ? '?' : '&') . $this->resetRequestParam . '=1'
    ));
  }

  private function _getCurrentPageURL() {
    global $wp;

    $currentURL = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
    $currentURL = str_replace(array("&" . $this->displayRequestParam . '=1', "&" . $this->displayRequestParam . '=0'), '', $currentURL);
    $currentURL = str_replace(array($this->displayRequestParam . '=1', $this->displayRequestParam . '=0'), '', $currentURL);

    return $currentURL;
  }

  public function _initJavascriptLibrary() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('colpick', plugins_url( 'assets/colpick.js', __FILE__), array("jquery"), false, true);
    wp_enqueue_script($this->namespace . 'core', plugins_url( 'assets/visualDeveloper-min.js', __FILE__), array("jquery"), false, true);
    wp_localize_script( $this->namespace . 'core', 'WordpressAjax', array(
        'target'   => admin_url( 'admin-ajax.php' ),
        'security' => wp_create_nonce( $this->namespace )
    ));
    wp_localize_script( $this->namespace . 'core', 'PluginInfo', array(
        'post_id'          => intval(url_to_postid( "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] )),
        'post_version_id'  => (isset($_GET[$this->pageVersionID]) ? $_GET[$this->pageVersionID] : 0),
        'core_css_file'    => $this->getCSSURLPath(),
        'current_page_url' => $this->_getCurrentPageURL()
    ));

    $this->_initThirdPartyIntegrations();

    wp_enqueue_script("crypto-js-md5", plugins_url( 'assets/crypto-md5.js', __FILE__), array(), false, true);
    wp_enqueue_script("fileSaver", plugins_url( 'assets/fileSaver.min.js', __FILE__), array(), false, true);
    wp_enqueue_script("jszip", plugins_url( 'assets/jszip.js', __FILE__), array(), false, true);

    do_action($this->actionQuickAccessRegistration, array("script" => $this->namespace . 'core'));
  }

  public function _initStylesheetsOfLibrary() {
    wp_enqueue_style($this->namespace . 'core', plugins_url( 'assets/visualDeveloper.css', __FILE__));
    wp_enqueue_style('hint', plugins_url( 'assets/hint.css', __FILE__));
    wp_enqueue_style('colpick', plugins_url( 'assets/colpick.css', __FILE__));
  }

  private function _initThirdPartyIntegrations() {
    if ( class_exists( 'WooCommerce' ) )
      wp_enqueue_script($this->namespace . 'woocommerce', plugins_url( 'assets/third-party/visual-developer-woocommerce.js', __FILE__), array( $this->namespace . 'core' ), false, true);
  }

}

VisualDeveloperWordPress::getInstance();