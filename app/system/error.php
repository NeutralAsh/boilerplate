<?php

class Error {

  public function __construct() {
    $this->Loader = new Loader();
  }

  public function error_404() {
    $this->Loader->view('system/error');
  }

}
