<?php

class VisualDeveloperWordpressDatabaseConnection extends VisualDeveloperAbstractDatabaseConnection {

  private $_wordPressDB;

  public function __construct() {
    global $wpdb;

    $this->_wordPressDB = $wpdb;
  }

  /**
   * @return string
   */
  public function getDatabasePrefix() {
    return $this->_wordPressDB->base_prefix;
  }

  /**
   * Runs an MySQL Query
   * @param string $sqlQuery
   * @return mixed
   */
  public function query($sqlQuery) {
    $this->_wordPressDB->query($sqlQuery);
  }

  /**
   * Returns the last inserted entry id.
   * @return mixed
   */
  public function getLastInsertID() {
    return $this->_wordPressDB->insert_id;
  }

  /**
   * Get the Query Results Array.
   * @param string $sqlQuery
   * @return mixed
   */
  public function getResults($sqlQuery) {
    $information = $this->_wordPressDB->get_results($sqlQuery);

    return $information === null ? false :
        (method_exists($this, '_beforeGet') ? $this->_beforeGet($information) : $information);
  }

  /**
   * Get the Query Result Row Object.
   * @param string $sqlQuery
   * @return mixed
   */
  public function getRow($sqlQuery) {
    $information = $this->_wordPressDB->get_row($sqlQuery);

    return $information === null ? false :
        (method_exists($this, '_beforeGet') ? $this->_beforeGet($information) : $information);
  }

}
