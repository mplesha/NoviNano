<?php


class VisualDeveloperEntityPageVersion extends VisualDeveloperAbstractDatabase {

  private $_table_name            = 'page_version';
  private $_table_assign_name     = 'page_version_assign';
  private $_table_display_name    = 'page_version_display';
  private $_table_conversion_name = 'page_version_conversion';

  public $conversionDisplayTroubleShoot = 1000;

  public function init() {
    $this->_table_name  = $this->tablePrefix . $this->_table_name;

    $this->_table_assign_name      = $this->tablePrefix . $this->_table_assign_name;
    $this->_table_display_name     = $this->tablePrefix . $this->_table_display_name;
    $this->_table_conversion_name  = $this->tablePrefix . $this->_table_conversion_name;
  }

  public function getTableName() {
    return $this->_table_name;
  }

  public function getAll() {
    $sql = 'SELECT display.*
                   FROM `' . $this->_table_name . '` display';

    $information = $this->databaseConnection->getResults($sql);

    return $information === null ? array() : $information;
  }

  public function getActiveDateList($pageID) {
    $sql = 'SELECT DATE(creation_date) as date
              FROM ' . $this->_table_display_name . '
              WHERE page_id = ' . $pageID . '
              GROUP BY date DESC
           ';

    $information = $this->databaseConnection->getResults($sql);
    $ret         = array();

    if($information !== null)
      foreach($information as $i)
        $ret[] = $i->date;

    return $ret;
  }

  public function getPostTitleListWithInformation($versionID) {
    $sql = 'SELECT id,
                   title,
                   IFNULL((
                     SELECT COUNT(DISTINCT`' . $this->_table_display_name . '`.`ip_address`)
                       FROM `' . $this->_table_display_name . '`
                      WHERE `' . $this->getTableName() . '`.`id` = `' . $this->_table_display_name . '`.`page_version_id`
                   ), 0) as uniqueDisplays,
                   ( SELECT COUNT(`' . $this->_table_display_name . '`.`id`)
                       FROM `' . $this->_table_display_name . '`
                      WHERE `' . $this->getTableName() . '`.`id` = `' . $this->_table_display_name . '`.`page_version_id`
                   ) as displays,
                   ( SELECT COUNT(`' . $this->_table_assign_name . '`.`id`)
                       FROM `' . $this->_table_assign_name . '`
                      WHERE `' . $this->getTableName() . '`.`id` = `' . $this->_table_assign_name . '`.`page_version_id`
                   ) as assigns,
                   ( SELECT COUNT(`' . $this->_table_conversion_name . '`.`id`)
                       FROM `' . $this->_table_conversion_name . '`
                      WHERE `' . $this->getTableName() . '`.`id` = `' . $this->_table_conversion_name . '`.`page_version_id`
                   ) as conversions
              FROM `' . $this->getTableName() . '`
             WHERE version_id = ' . $versionID . '
           ';

    $information = $this->databaseConnection->getResults($sql);

    return $information === null ? array() : $information;
  }

  public function getPostTitleListWithInformationByDate($pageID, $date) {
    $sql = 'SELECT id,
                   title,
                   IFNULL((
                     SELECT COUNT(DISTINCT`' . $this->_table_display_name . '`.`ip_address`)
                       FROM `' . $this->_table_display_name . '`
                      WHERE `' . $this->getTableName() . '`.`id` = `' . $this->_table_display_name . '`.`page_version_id`
                        AND DATE(`' . $this->_table_display_name . '`.`creation_date`) = "' . $date . '"
                   ), 0) as uniqueDisplays,
                   ( SELECT COUNT(`' . $this->_table_display_name . '`.`id`)
                       FROM `' . $this->_table_display_name . '`
                      WHERE `' . $this->getTableName() . '`.`id` = `' . $this->_table_display_name . '`.`page_version_id`
                        AND DATE(`' . $this->_table_display_name . '`.`creation_date`) = "' . $date . '"
                   ) as displays,
                   ( SELECT COUNT(`' . $this->_table_assign_name . '`.`id`)
                       FROM `' . $this->_table_assign_name . '`
                      WHERE `' . $this->getTableName() . '`.`id` = `' . $this->_table_assign_name . '`.`page_version_id`
                        AND DATE(`' . $this->_table_assign_name . '`.`creation_date`) = "' . $date . '"
                   ) as assigns,
                   ( SELECT COUNT(`' . $this->_table_conversion_name . '`.`id`)
                       FROM `' . $this->_table_conversion_name . '`
                      WHERE `' . $this->getTableName() . '`.`id` = `' . $this->_table_conversion_name . '`.`page_version_id`
                        AND DATE(`' . $this->_table_conversion_name . '`.`creation_date`) = "' . $date . '"
                   ) as conversions
              FROM `' . $this->getTableName() . '`
             WHERE page_id = ' . $pageID . '
           ';

    $information = $this->databaseConnection->getResults($sql);

    return $information === null ? array() : $information;
  }

  public function getAllByPageID($pageID) {
    $sql = 'SELECT *
                   FROM `' . $this->_table_name . '`
                   WHERE page_id = "' . intval($pageID) . '"';

    $information = $this->databaseConnection->getResults($sql);

    return $information === null ? array() : $information;
  }

  public function getNaturalDeliveryTitle($versionID) {
    $sql = 'SELECT *,
                   IFNULL((
                     SELECT COUNT(DISTINCT`' . $this->_table_display_name . '`.`ip_address`)
                       FROM `' . $this->_table_display_name . '`
                      WHERE `' . $this->getTableName() . '`.`id` = `' . $this->_table_display_name . '`.`page_version_id`
                   ), 1) as uniqueDisplays,
                   IFNULL(( SELECT COUNT(`' . $this->_table_conversion_name . '`.`id`)
                       FROM `' . $this->_table_conversion_name . '`
                      WHERE `' . $this->getTableName() . '`.`id` = `' . $this->_table_conversion_name . '`.`page_version_id`
                   ), 1) as conversions
                   FROM `' . $this->_table_name . '`
                   WHERE version_id = "' . intval($versionID) . '"
                   ORDER BY IF(uniqueDisplays > ' . $this->conversionDisplayTroubleShoot . ', uniqueDisplays / conversions, uniqueDisplays ) ASC';

    $information = $this->databaseConnection->getRow($sql);

    return $information === null ? array() : $information;
  }

  public function getById($id) {
    $sql = 'SELECT *
                   FROM `' . $this->_table_name . '`
                   WHERE id = "' . intval($id) . '"';

    $information = $this->databaseConnection->getRow($sql);

    return $information === null ? false : $information;
  }

  public function entityDelete($pageID) {
    $this->delete(array('id' => $pageID));
  }

  public function deleteAllByPageID($pageID) {
    $this->delete(array('page_id' => $pageID));
  }

}