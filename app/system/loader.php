<?php

class Loader {

  //include a new page, with variable if specified.
  public static function view($name, $var = array()) {
    if(!empty($var)) {
      foreach ($var as $arg => $val) {
        $$arg = $val;
      }
    }
    include 'public/views/'.$name.'.php';
  }

  //return a new model.
  public static function model($name) {
        return $name = new $name();
    }
  }
