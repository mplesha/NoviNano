<?php

class VisualDeveloperEntityPageVersionConversion extends VisualDeveloperAbstractDatabase {

  private $_table_name = 'page_version_conversion';

  public function init() {
    $this->_table_name  = $this->tablePrefix . $this->_table_name;
  }

  public function getTableName() {
    return $this->_table_name;
  }

  public function getAll() {
    $sql = 'SELECT conversion.*
                   FROM `' . $this->_table_name . '` conversion';

    $information = $this->databaseConnection->getResults($sql);

    return $information === null ? array() : $information;
  }

  public function getAllByCampaignID($campaignID) {
    $sql = 'SELECT *
                   FROM `' . $this->_table_name . '`
                   WHERE `page_version_id` = "' . intval($campaignID) . '"';

    $information = $this->databaseConnection->getResults($sql);

    return $information === null ? array() : $information;
  }

  public function getAllUniqueByPostID($postID) {
    $sql = 'SELECT *
                   FROM `' . $this->_table_name . '`
                   WHERE `post_id` = "' . intval($postID) . '"
                   GROUP BY ip_address';

    $information = $this->databaseConnection->getResults($sql);

    return $information === null ? array() : $information;
  }

  public function getById($id) {
    $sql = 'SELECT conversion.*
                   FROM `' . $this->_table_name . '` conversion
                   WHERE `conversion`.`id` = "' . intval($id) . '"';

    $information = $this->databaseConnection->getRow($sql);

    return $information === null ? false : $information;
  }

  public function getByStatsByCampaignID($campaignID) {
    $sql = 'SELECT count(mainTable.id) as conversion_count,
                   IFNULL((SELECT count(distinct innerTable.ip_address) FROM `' . $this->_table_name . '` innerTable
                           WHERE innerTable.link        = mainTable.link
                             AND innerTable.page_version_id = mainTable.page_version_id
                           ), 0) as unique_count,
                   link
                   FROM `' . $this->_table_name . '` mainTable
                   WHERE mainTable.`page_version_id` = "' . $campaignID . '"
                   GROUP BY mainTable.link';

    $information = $this->databaseConnection->getResults($sql);

    return $information === null ? array() : $information;
  }

  public function getLastConversionByCampaignIDAndIPAddress($campaignID, $ipAddress) {
    $sql = 'SELECT conversion.*
                   FROM `' . $this->_table_name . '` conversion
                   WHERE `conversion`.`page_version_id` = "' . intval($campaignID) . '"
                     AND `conversion`.`ip_address`  = "' . htmlentities($ipAddress) . '"
                   ORDER BY `conversion`.`creation_date` DESC';

    $information = $this->databaseConnection->getRow($sql);

    return $information === null ? false : $information;
  }

  public function getConversionCountMAPForInterval($from_time, $to_time, $version_id = false) {
    $sql = 'SELECT id, page_version_id, DATE(creation_date) as creation_date FROM ' . $this->_table_name . ' version_conversion
                     WHERE DATE(version_conversion.creation_date) >= "' . date ("Y-m-d", $from_time). '"
                       AND DATE(version_conversion.creation_date) <= "' . date ("Y-m-d", $to_time). '" ';

    if($version_id != false)
      $sql .= ' AND version_conversion.page_version_id = ' . intval($version_id);

    $information = $this->databaseConnection->getResults($sql);

    $return = array();

    for($i = $from_time; $i <= $to_time; $i += 86400)
      $return[date("Y-m-d", $i)] = 0;

    foreach($information as $info)
      $return[$info->creation_date]++;

    return $return;
  }

  public function getUniqueConversionCountMAPForInterval($from_time, $to_time, $version_id = false) {
    $sql = 'SELECT id, page_version_id, DATE(creation_date) as creation_date FROM ' . $this->_table_name . ' version_conversion
                     WHERE DATE(version_conversion.creation_date) >= "' . date ("Y-m-d", $from_time). '"
                       AND DATE(version_conversion.creation_date) <= "' . date ("Y-m-d", $to_time). '"
                       GROUP BY DATE(version_conversion.creation_date), version_conversion.ip_address';

    if($version_id != false)
      $sql .= ' AND version_conversion.page_version_id = ' . intval($version_id);

    $information = $this->databaseConnection->getResults($sql);

    $return = array();

    for($i = $from_time; $i <= $to_time; $i += 86400)
      $return[date("Y-m-d", $i)] = 0;

    foreach($information as $info)
      $return[$info->creation_date]++;

    return $return;
  }

  public function deleteAllByCampaignID($campaignID) {
    $this->delete(array('page_version_id' => $campaignID));
  }

}