<?php 

class App{
  protected $controller = 'home';
  protected $method = 'index';
  protected $params = [];

    public function __construct()
    {
      
      // Look at url
      $url = $this->parseUrl();

      // Set Controller
      if(!empty($url)):
        if( file_exists('../app/controllers/' . $url[0] . '.php') ):
          $this->controller = $url[0];
          unset($url[0]);
        endif;
      endif;

      // Call Class Of Controller
      require_once '../app/controllers/' . $this->controller . '.php';
      $this->controller = new $this->controller;

      // set default method or take from url
      if( isset($url[1]) ):
        if( method_exists($this->controller,$url[1]) ):
          $this->method = $url[1];
          unset($url[1]);
        endif;
      endif;

      // Send Params
      if( !empty($url) ):
        $this->params = array_values($url);
      endif;

      // Call the views using this class
      call_user_func_array([$this->controller,$this->method],$this->params);
    }



    public function parseUrl(){
      if(isset($_GET['url'])){
        $url = rtrim($_GET['url'],'/');
        $url = filter_var($url,FILTER_SANITIZE_URL);
        $url = explode('/',$url);
        return $url;
      }
    }



}


