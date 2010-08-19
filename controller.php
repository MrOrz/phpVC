<?php
class Controller{
  private static function error($controller, $action, $msg=NULL){
    echo "<h1>Error occurred</h1><p>$msg</p>";
    exit(0);
  }

  /* ------------------------------------------------------------------
     methods for derived controllers, called with parent:: namespace */
  
  /* render(controller, action, params passed to layout and view) */
  /*   renders a view of the specific action, with the layout for the
       specific controller.                                           */
  public static function render($controller, $action, $params=NULL){
    $__script_path = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/')+1);
    // $__script_path: for use in layouts and views
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
  /*  redirect to a specific url, which will invoke the controller method call */
  public static function redirect($url, $_get=NULL){
    $script_path = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/')+1);
    
    if(is_array($_get))
      header( "location: $script_path$url?".http_build_query($_get) );
    else
      header( "location: $script_path$url" );
      
    exit(0);
  }
  
  /* ------------------------------------------------------------------
     methods for views and layouts. called with self:: namespace     */
  
  /* path_to(controller, action, $_GET) */
  /* returns a string representing an URL path pointing to an action */
  public static function path_to($controller, $action, $_get=NULL){
    $script_path = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/')+1);
    if(is_array($_get))
      return $script_path.$controller.'/'.$action.'?'.http_build_query($_get);
    else
      return $script_path.$controller.'/'.$action;
  }

  /* stylesheet_link_tag( file name with path ) */
  /* returns a string of a link tag */
  public static function stylesheet_link_tag($file_name){
    $script_path = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/')+1);
    srand(); $salt = rand();
    return "<link href=\"$script_path$file_name?$salt\" rel=\"stylesheet\" type=\"text/css\" />\n";
  }
  
  /* javascript_include_tag( file name with path ) */
  /* returns a string of a script tag */
  public static function javascript_include_tag($file_name){
    $script_path = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/')+1);
    srand(); $salt = rand();
    return "<script type=\"text/javascript\" src=\"$script_path$file_name?$salt\"></script>\n";
  }
};
?>
