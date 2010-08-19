<?php
class Dispatcher{

  const DEBUG = true;
  const DEFAULT_CONTROLLER = 'login';
  const DEFAULT_ACTION     = 'index';
  
  private static function error($controller, $action, $params, $msg){
    echo "<h1>Error occurred</h1><p>$msg</p>";
    if(DEBUG){
      echo "
      <h2>Routes</h2>
        <p>reqiest uri:{$_SERVER['REQUEST_URI']} <br /> script name: {$_SERVER['SCRIPT_NAME']}</p>
        <p>controller: $controller <br /> action: $action </p>";
      echo "<h2>Params</h2>";
      print_r($params);
    }
    exit(0);
  }

  static function dispatch(){

    /* parse the url */
    $__script_path = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/')+1);
    $__uri = preg_split('/[\/?&]+/', substr($_SERVER['REQUEST_URI'], strlen($__script_path)));
    
    //var_dump($__script_path);
    //print_r($__uri);    
    //exit(0);  
    
    /* parse result */
    $__controller = $__uri[0] === '' ? self::DEFAULT_CONTROLLER : $__uri[0];
    $__controller_obj = ucfirst($__controller).'Controller';
    $__action      = $__uri[1] == ''  ? self::DEFAULT_ACTION     : $__uri[1];
    $__params      = array_slice($__uri, 2);
    
    /* dispatch */
    
    // check if the controller exists
    if( !file_exists("controllers/{$__controller}_controller.php") )
      self::error($__controller, $__action, $__params,
        "No such controller called '$__controller'. ");
    
    // include the model and the controller
    session_start();    
    require('db.php');
    require('controller.php');
    require("controllers/{$__controller}_controller.php");
    
    // check if the controller object exists
    if( !class_exists($__controller_obj) )
      self::error($__controller, $__action, $__params,
        "$__controller has no class called '$__controller_obj'. ");
    
    // check if the action exists
    if( !method_exists($__controller_obj, $__action) )
      self::error($__controller, $__action, $__params,
        "$__controller has no action (static method) called '$__action'. ");
    
    // invoke the action
    //$__controller_obj::$__action($__params);  // php 5.3.x or later
    call_user_func(array($__controller_obj, $__action), $__params);

  }
};
?>
