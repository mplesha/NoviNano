<?php

abstract class VisualDeveloperAbstractDatabase {

  /**
   * @var VisualDeveloperAbstractDatabaseConnection
   */
  public $databaseConnection;
  /**
   * @var VisualDeveloper
   */
  public $visualDeveloper;
  public $lastInsertID;
  public $tablePrefix;

  final public function __construct(
      VisualDeveloperAbstractDatabaseConnection $databaseConnection,
      VisualDeveloper $visualDeveloperCore
  ) {
    $this->databaseConnection = $databaseConnection;
    $this->visualDeveloper    = $visualDeveloperCore;

    $this->tablePrefix = $this->databaseConnection->getDatabasePrefix() .
                         $this->visualDeveloper->namespace;

    if(method_exists($this, 'init'))
      $this->init();
  }

  abstract public function getTableName();

  /**
   *  @param array $data
   *  @uses wrap_my_array
   *  @uses array_implode
   *  @return bool
   */
  public function insert($data){
    if(is_array($data) && !empty($data)){

      if(method_exists($this, '_beforeInsert'))
        $this->_beforeInsert($data);
      if(method_exists($this, '_beforeSave'))
        $this->_beforeSave($data);

      $keys = array_keys($data);

      $sql = 'INSERT INTO '. $this->getTableName() .' ('
          .implode("," , $this->_wrapMyArray($keys , '`'))
          .') VALUES ('
          .implode("," , $this->_wrapMyArray($data))
          .')';
      $this->databaseConnection->query($sql);

      $this->lastInsertID = $this->databaseConnection->getLastInsertID();
      return true;
    }
    return false;
  }

  public function getMySQLInsertID() {
    return $this->lastInsertID;
  }

  /**
   *  @param array $data
   *  @param array/string $where
   *  @uses wrap_my_array
   *  @uses array_implode
   * @return bool
   */
  public function update($data = array() , $where = array()) {
    if(is_array($data) && !empty($data)){
      if(method_exists($this, '_beforeSave'))
        $this->_beforeSave($data);

      $data = $this->_wrapMyArray($data);

      $sql = 'UPDATE '. $this->getTableName() .' SET ';
      $sql .= $this->_arrayImplode("=" , "," , $data);

      if(!empty($where)){
        $sql .= ' WHERE ';
        if(is_array($where)){
          $where = $this->_wrapMyArray($where);
          $sql  .= $this->_arrayImplode("=" , "AND" , $where);
        }else{
          $sql  .= $where;
        }
      }

      $this->databaseConnection->query($sql);
      return true;
    }
    return false;
  }

  public function increaseFieldValue($fieldName, $value, $where = array()) {
    $sql = 'UPDATE ' . $this->getTableName() .
             ' SET ' . $fieldName . '  = ' . $fieldName . ' + ' . intval($value);

    if(!empty($where)){
      $sql .= ' WHERE ';
      if(is_array($where)){
        $where = $this->_wrapMyArray($where);
        $sql  .= $this->_arrayImplode("=" , "AND" , $where);
      }else{
        $sql  .= $where;
      }
    }

    $this->databaseConnection->query($sql);

    return true;
  }

  /**
   *  @param array/string where
   *  @uses wrap_my_array
   *  @uses array_implode
   */
  public function delete($where = array()){
    $sql = 'DELETE FROM ' . $this->getTableName() .' ';

    if(!empty($where)){
      $sql .= ' WHERE ';
      if(is_array($where)){
        $where = $this->_wrapMyArray($where);
        $sql  .= $this->_arrayImplode("=" , "AND" , $where);
      }else{
        $sql  .= $where;
      }
    }

    $this->databaseConnection->query($sql);
  }

  /**
   * @param $array
   * @param string $wrapper
   * @return array
   */
  private function _wrapMyArray($array , $wrapper = '"') {
    $new_array = array();
    foreach($array as $k=>$element){
      if(!is_array($element)){
        $new_array[$k] = $wrapper . $element . $wrapper;
      }
    }
    return $new_array;

  }
  /**
   * Implode an array with the key and value pair giving
   * a glue, a separator between pairs and the array
   * to implode.
   * @param string $glue The glue between key and value
   * @param string $separator Separator between pairs
   * @param array $array The array to implode
   * @return string The imploded array
   */
  private function _arrayImplode( $glue, $separator, $array ) {
    if ( ! is_array( $array ) ) return $array;
    $string = array();
    foreach ( $array as $key => $val ) {
      if ( is_array( $val ) )
        $val = implode( ',', $val );
      $string[] = "{$key}{$glue}{$val}";

    }
    return implode( $separator, $string );
  }

}