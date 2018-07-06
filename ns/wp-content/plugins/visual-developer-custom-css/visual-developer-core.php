<?php

abstract class VisualDeveloper {

  public $namespace                   = 'visual_developer_';
  public $storageOption               = 'storage';
  public $settingsStorageOption       = 'settings_storage';
  public $optionsStorageOption        = 'options_storage';
  public $selectorsStorageOptions     = 'selectors_storage';

  public $pageVersionID               = 'page_version_id';

  /**
   * @var VisualDeveloperEntityPageVersion
   */
  public $entityPageVersion;
  /**
   * @var VisualDeveloperEntityPageVersionAssign
   */
  public $entityPageVersionAssign;
  /**
   * @var VisualDeveloperEntityPageVersionDisplay
   */
  public $entityPageVersionDisplay;
  /**
   * @var VisualDeveloperEntityPageVersionConversion
   */
  public $entityPageVersionConversion;
  /**
   * @var VisualDeveloperVersionControl
   */
  public $modelVersionControl;

  final public function __construct() {
    $this->_namespaceOptions();
    $this->_includeVisualDeveloperLibrary();
    $this->_initializeVisualDeveloperLibrary();

    $this->init();
  }

  private function _namespaceOptions() {
    $this->storageOption             = $this->namespace . $this->storageOption;
    $this->settingsStorageOption     = $this->namespace . $this->settingsStorageOption;
    $this->optionsStorageOption      = $this->namespace . $this->optionsStorageOption;
    $this->selectorsStorageOptions   = $this->namespace . $this->selectorsStorageOptions;
  }

  private function _includeVisualDeveloperLibrary() {
    require_once($this->getVDLibraryFilePath() . "dependency/_abstractDatabaseConnection.php");
    require_once($this->getVDLibraryFilePath() . "entity/_abstractDatabase.php");

    require_once($this->getVDLibraryFilePath() . "entity/pageVersion.php");
    require_once($this->getVDLibraryFilePath() . "entity/pageVersionAssign.php");
    require_once($this->getVDLibraryFilePath() . "entity/pageVersionDisplay.php");
    require_once($this->getVDLibraryFilePath() . "entity/pageVersionConversion.php");

    require_once($this->getVDLibraryFilePath() . "model/versionControl.php");
  }

  private function _initializeVisualDeveloperLibrary() {
    $this->entityPageVersion = new VisualDeveloperEntityPageVersion(
      $this->getDatabaseConnectionImplementation(),
      $this
    );
    $this->entityPageVersionAssign = new VisualDeveloperEntityPageVersionAssign(
      $this->getDatabaseConnectionImplementation(),
      $this
    );
    $this->entityPageVersionDisplay = new VisualDeveloperEntityPageVersionDisplay(
      $this->getDatabaseConnectionImplementation(),
      $this
    );
    $this->entityPageVersionConversion = new VisualDeveloperEntityPageVersionConversion(
      $this->getDatabaseConnectionImplementation(),
      $this
    );

    $this->modelVersionControl = new VisualDeveloperVersionControl(
        $this->getDatabaseConnectionImplementation(),
        $this
    );
  }

  /**
   *
   * @return string
   */
  abstract public function getVDLibraryFilePath();

  abstract public function init();

  /**
   * @return bool
   */
  abstract public function hasAdminAccess();

  /**
   * @return bool
   */
  abstract public function allowVisualDeveloperInThisSection();

  /**
   * @return string
   */
  abstract public function getPluginAssetsURLPath();

  /**
   * @param $optionName
   * @param null $optionDefault
   * @return mixed
   */
  abstract public function getOptionStorage($optionName, $optionDefault = null);

  /**
   * @param $optionName
   * @param $optionValue
   * @return null
   */
  abstract public function setOptionStorage($optionName, $optionValue);

  /**
   * @param $optionPrefix
   * @return bool
   */
  abstract public function deleteOptionsStorageByOptionPrefix($optionPrefix);

  /**
   * @return string
   */
  abstract public function getUploadsDirectoryFilePath();

  /**
   * @return string
   */
  abstract public function getUploadsDirectoryURLPath();

  /**
   * @return VisualDeveloperAbstractDatabaseConnection
   */
  abstract public function getDatabaseConnectionImplementation();

  final public function resetVisualDeveloper() {
    $this->deleteOptionsStorageByOptionPrefix($this->storageOption);
    $this->deleteOptionsStorageByOptionPrefix($this->settingsStorageOption);
    $this->deleteOptionsStorageByOptionPrefix($this->optionsStorageOption);
    $this->deleteOptionsStorageByOptionPrefix($this->selectorsStorageOptions);

    if(file_exists($this->getCSSFilePath()))
      unlink($this->getCSSFilePath());
  }

  final public function getCSSFilePath($pageAlias = false, $pageVersionAlias = false) {
    return $this->getUploadsDirectoryFilePath() . $this->_getCSSFileName($pageAlias, $pageVersionAlias);
  }

  final public function getCSSURLPath($pageAlias = false, $pageVersionAlias = false) {
    return $this->getUploadsDirectoryURLPath() . $this->_getCSSFileName($pageAlias, $pageVersionAlias);
  }

  private function _getCSSFileName($pageAlias, $pageVersionAlias = false) {
    return $this->namespace .
      ( $pageAlias != false && $pageAlias != ''
          ? $pageAlias . '_'
          : ($pageAlias == false ? '' : $pageAlias )
      ) .
      ( $pageVersionAlias != false && $pageVersionAlias != ''
          ? $pageVersionAlias . '_'
          : ($pageVersionAlias == false ? '' : $pageVersionAlias )
      ) .
      'front.css';
  }


  final public function getJSONOptionStorage($optionName, $optionDefault = null) {
    $optionValue = json_decode($this->getOptionStorage($optionName, $optionDefault));

    return ($optionValue == null ? array() : $optionValue);
  }

  final public function setJSONOptionStorage($optionName, $optionValue) {
    $this->setOptionStorage($optionName, json_encode($optionValue));
  }

  public function ajaxGetLayoutInformation() {
    if(!$this->hasAdminAccess()) {
      echo json_encode(array("status" => "error", "error" => "Access Denied"));
      exit;
    }

    $optionSuffix       = (isset($_POST['post_id']) ? "_" . intval($_POST['post_id']) : '');
    $optionSecondSuffix = (isset($_POST['version_id']) ? "_" . intval($_POST['version_id']) : '');

    $pluginAssetsPath = $this->getPluginAssetsURLPath();

    $optionInformation         =  $this->getJSONOptionStorage($this->storageOption . $optionSuffix . $optionSecondSuffix);
    $optionSettingsInformation =  $this->getJSONOptionStorage($this->settingsStorageOption);
    $optionsJSONInformation    =  $this->getJSONOptionStorage($this->optionsStorageOption);
    $selectorsJSONInformation  =  $this->getJSONOptionStorage($this->selectorsStorageOptions);

    $ret = array(
        'layout_information'      => $optionInformation,
        'settings'                => $optionSettingsInformation,
        'optionsJSON'             => $optionsJSONInformation,
        'selectorOptionsJSON'     => $selectorsJSONInformation,
        'dependency'              => array(
            'Macro'             => array(
                'Background'  => array(
                    'textureURLPrefix' => $pluginAssetsPath . "/textures/",
                    'format' => array(
                        'texture' => array(
                            'fieldOptions' => array(
                                '0.png', '1.png', '2.png', '3.jpg',
                                '4.jpg', '5.jpg', '6.jpg', '7.jpg'
                            )
                        )
                    )
                ),
                'Padding'  => array(
                    'cssModel'     => 'image-select',
                    'optionImages' => array(
                        'Inactive'          => $pluginAssetsPath . "/img/inactive.png",
                        'Center'            => $pluginAssetsPath . "/img/spacing-center.png",
                        'Right Bottom'      => $pluginAssetsPath . "/img/spacing-right-bottom.png",
                        'Top Left'          => $pluginAssetsPath . "/img/spacing-top-left.png",
                        'Top'               => $pluginAssetsPath . "/img/spacing-top.png",
                        'Right'             => $pluginAssetsPath . "/img/spacing-right.png",
                        'Bottom'            => $pluginAssetsPath . "/img/spacing-bottom.png",
                        'Left'              => $pluginAssetsPath . "/img/spacing-left.png"
                    )
                ),
                'Margin'  => array(
                    'cssModel'     => 'image-select',
                    'optionImages' => array(
                        'Inactive'          => $pluginAssetsPath . "/img/inactive.png",
                        'Center'            => $pluginAssetsPath . "/img/margin-center.png",
                        'Top Bottom'        => $pluginAssetsPath . "/img/margin-top-bottom.png",
                        'Left Right'        => $pluginAssetsPath . "/img/margin-left-right.png",
                        'Top'               => $pluginAssetsPath . "/img/margin-top.png",
                        'Right'             => $pluginAssetsPath . "/img/margin-right.png",
                        'Bottom'            => $pluginAssetsPath . "/img/margin-bottom.png",
                        'Left'              => $pluginAssetsPath . "/img/margin-left.png"
                    )
                ),
                'BorderRadius'  => array(
                    'cssModel'     => 'image-select',
                    'optionImages' => array(
                        'Inactive'          => $pluginAssetsPath . "/img/inactive.png",
                        'All'               => $pluginAssetsPath . "/img/border-radius-all.png",
                        'Bottom'            => $pluginAssetsPath . "/img/border-radius-bottom.png",
                        'Top'               => $pluginAssetsPath . "/img/border-radius-top.png",
                        'Top Right'         => $pluginAssetsPath . "/img/border-radius-top-right.png",
                        'Top Left'          => $pluginAssetsPath . "/img/border-radius-top-left.png",
                        'Bottom Right'      => $pluginAssetsPath . "/img/border-radius-bottom-right.png",
                        'Bottom Left'       => $pluginAssetsPath . "/img/border-radius-bottom-left.png"
                    )
                ),
                'TextAlign'  => array(
                    'cssModel'     => 'image-select',
                    'optionImages' => array(
                        'inherit' => $pluginAssetsPath . "/img/inactive.png",
                        'left'    => $pluginAssetsPath . "/img/text-align-left.png",
                        'center'  => $pluginAssetsPath . "/img/text-align-center.png",
                        'right'   => $pluginAssetsPath . "/img/text-align-right.png"
                    )
                )
            )
        ),
        'supportStylesheet'       => (
            isset($_POST['post_id']) && file_exists($this->getCSSFilePath()) ?
                $this->getCSSURLPath() :
                0
        ),
        'supportFooterStylesheet' => (
            isset($_POST['support_post_id']) && file_exists($this->getCSSFilePath($_POST['support_post_id'])) ?
                $this->getCSSURLPath($_POST['support_post_id']) :
                0
        ),
        'pageVersions'  => $this->_getPageVersionsInformation(
            (isset($_POST['post_id']) ? intval($_POST['post_id']) : (isset($_POST['support_post_id']) ? intval($_POST['support_post_id']) : 0))
        )
    );

    echo json_encode($ret);
    exit;
  }

  public function ajaxSetLayoutInformation() {
    if(!$this->hasAdminAccess()) {
      echo json_encode(array("status" => "error", "error" => "Access Denied"));
      exit;
    }

    $optionSuffix       = (isset($_POST['post_id']) ? "_" . intval($_POST['post_id']) : '');
    $optionSecondSuffix = (isset($_POST['version_id']) ? "_" . intval($_POST['version_id']) : '');

    $this->setJSONOptionStorage(
        $this->storageOption . $optionSuffix . $optionSecondSuffix,
        isset($_POST['layoutInfoJSONPack']) ? $_POST['layoutInfoJSONPack'] : array()
    );

    $this->setJSONOptionStorage(
        $this->settingsStorageOption,
        isset($_POST['settingsArrayPack']) ? $_POST['settingsArrayPack'] : array()
    );

    $this->setJSONOptionStorage(
        $this->optionsStorageOption,
        isset($_POST['optionsJSON']) ? $_POST['optionsJSON'] : array()
    );

    $this->setJSONOptionStorage(
        $this->selectorsStorageOptions,
        isset($_POST['selectorOptionsJSON']) ? $_POST['selectorOptionsJSON'] : array()
    );

    file_put_contents(
        $this->getCSSFilePath(
            (isset($_POST['post_id'])    ? intval($_POST['post_id'])    : false),
            (isset($_POST['version_id']) ? intval($_POST['version_id']) : false)
        ),
        ($optionSuffix != '' ? '@import url("' . $this->namespace . 'front.css");' . "\n" : '') . str_replace('\"', '"', str_replace("\'", "'", $_POST['stylesheet']))
    );

    echo json_encode(array("status" => "ok"));
    exit;
  }

  public function ajaxGetPageVersionsList() {
    if(!$this->hasAdminAccess()) {
      echo json_encode(array("status" => "error", "error" => "Access Denied"));
      exit;
    }

    echo json_encode(array("status" => "ok"));
    exit;
  }

  public function ajaxAddPageVersion() {
    if(!$this->hasAdminAccess() || !isset($_POST['versionInformation'])) {
      echo json_encode(array("status" => "error", "error" => "Access Denied"));
      exit;
    }

    $this->entityPageVersion->insert($_POST['versionInformation']);

    echo json_encode(
        array(
            "status"              => "ok",
            "versionInformation"  => $this->entityPageVersion->getById($this->entityPageVersion->lastInsertID)
        )
    );
    exit;
  }

  public function ajaxDeletePageVersion() {
    if(!$this->hasAdminAccess() || !isset($_POST['versionID'])) {
      echo json_encode(array("status" => "error", "error" => "Access Denied"));
      exit;
    }

    $this->entityPageVersion->entityDelete(intval($_POST['versionID']));

    echo json_encode(array("status" => "ok", 'version_id' => intval($_POST['versionID'])));
    exit;
  }

  private function _getPageVersionsInformation($pageID) {
    if($pageID == 0)
      return array();

    $ret = array();

    foreach($this->entityPageVersion->getAllByPageID($pageID) as $pageVersion)
      $ret[$pageVersion->id] = $pageVersion;

    return $ret;
  }

}