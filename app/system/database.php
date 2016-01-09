<?php

include 'app/config/db.php';

class Database {

  private static $instance;
  private $info;

  //Load the Database information in the instance
  public function __construct($info) {
    $this->info = $info;
  }

  //Get a new instance of the Database or return the existing instance.
  public static function getInstance() {
    if (is_null(self::$instance)) {
      self::$instance = new Database($GLOBALS['dbinfo']);
    }

    return self::$instance;
  }

  //Make a new PDO connection and return it
  public function connect() {
    return $datab = new PDO($this->info['engine'].':dbname='.$this->info['dbname'], $this->info['username'], $this->info['passw']);
  }

}
