<?php

class VisualDeveloperVersionControl {

  /**
   * @var VisualDeveloperAbstractDatabaseConnection
   */
  public $databaseConnection;
  /**
   * @var VisualDeveloper
   */
  public $visualDeveloper;

  public $tablePrefix = '';
  public $tableInitialPrefix = '';

  public $versionOptionName       = 'database_version';
  public $currentDatabaseVersion  = '1.0';

  public $databaseUpdateVersion = array(
    '1.0' => 'initial.sql'
  );

  public function __construct(
      VisualDeveloperAbstractDatabaseConnection $databaseConnection,
      VisualDeveloper $visualDeveloperCore
  ) {
    $this->databaseConnection = $databaseConnection;
    $this->visualDeveloper    = $visualDeveloperCore;

    $this->versionOptionName  = $this->visualDeveloper->namespace . $this->versionOptionName;

    $this->tablePrefix = $this->databaseConnection->getDatabasePrefix() .
                         $this->visualDeveloper->namespace;
    $this->tableInitialPrefix = $this->visualDeveloper->namespace;

    $this->init();
  }

  public function init() {
    if(get_option($this->versionOptionName) != $this->currentDatabaseVersion) {
      foreach($this->databaseUpdateVersion as $versionAlias => $versionFile) {
        if(floatval($versionAlias) > floatval(get_option($this->versionOptionName))) {
          $query = file_get_contents(
            $this->visualDeveloper->getVDLibraryFilePath()
                . '_version-control-files/'
                . $versionFile
          );

          if($query == false)
            throw new Exception('Visual Developer, missing DB UPDATE File');

          $query = str_replace($this->tableInitialPrefix ,
                               $this->tablePrefix,
                               $query);

          $queries = explode(';', $query);

          foreach($queries as $query)
            if(strlen($query)> 20)
              $this->databaseConnection->query($query);

          $this->setCurrentDatabaseVersion($versionAlias);
        }
      }
    }
  }

  public function setCurrentDatabaseVersion($currentVersion) {
    $this->currentDatabaseVersion = $currentVersion;
    update_option($this->versionOptionName, $this->currentDatabaseVersion);
  }

}