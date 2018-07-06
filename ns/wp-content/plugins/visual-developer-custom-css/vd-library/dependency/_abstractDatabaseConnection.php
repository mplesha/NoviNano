<?php

abstract class VisualDeveloperAbstractDatabaseConnection {

  /**
   * Return the current website's database prefix, if existent.
   * @return string
   */
  abstract public function getDatabasePrefix();

  /**
   * Runs an MySQL Query
   * @param string $sqlQuery
   * @return mixed
   */
  abstract public function query($sqlQuery);

  /**
   * Returns the last inserted entry id.
   * @return mixed
   */
  abstract public function getLastInsertID();

  /**
   * Get the Query Results Array.
   * @param string $sqlQuery
   * @return mixed
   */
  abstract public function getResults($sqlQuery);

  /**
   * Get the Query Result Row Object.
   * @param string $sqlQuery
   * @return mixed
   */
  abstract public function getRow($sqlQuery);

}
