<?php 



class Controller{

  public function view($view){
    require_once '../app/views/' . $view . '.php';
  }

}





