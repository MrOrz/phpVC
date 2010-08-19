<?php
class Controller{
  private static function error($controller, $action, $msg=NULL){
    echo "<h1>Error occurred</h1><p>$msg</p>";
    exit(0);
  }

  /* offers render and redirect and etc. */
  
  /* render(controller, action, params passed to layout and view)*/
  public static function render($controller, $action, $params=NULL){
    $__view__ = "views/$controller/$action.php";
    if(!file_exists("views/layouts/$controller.php")){ // a controller without layout
      if(!file_exists($__view__))
        error($controller, $action, "$__view__ does not exist.");
        require($__view__);       // directly includes the view
        // $params can be used within the layout and view.
    }else{
      // include the layout
      require("views/layouts/$controller.php");
      
      // the layout should contain "require($__view__);"
      // $params can be used within the layout and view.
    }
    exit(0);
  }
  
  /* redirect(url, $_GET array)*/
  public static function redirect($url, $_get=NULL){
    $script_path = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/')+1);
    
    if(is_array($_get))
      header( "location: $script_path$url?".http_build_query($_get) );
    else
      header( "location: $script_path$url" );
      
    exit(0);
  }
};
?>