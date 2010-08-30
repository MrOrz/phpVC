<?php
/// Defines Controller class
/**
  Controller provides common static methods such as render the views, 
  redirect to another url and some helper functions that helps with
  the view.
*/

/// Controller class will be inherited by other controllers.
/**
  Inherited controllers, or Derived controllers, must follow the naming rule
  of {Controllername}Controller, for example, UserController. the name of the 
  controller is followed by the word 'Controller' with the first letter
  capitalized. Notice that in PHP, class names are case-sensitive.
*/
class Controller{
  /// prints error message
  private static function error($controller, $action, $msg=NULL){
    echo "<h1>Error occurred</h1><p>$msg</p>";
    exit(0);
  }

  /* ------------------------------------------------------------------
     methods for derived controllers, called with parent:: namespace */
  
  /// renders a view of the specific action, with the layout for the specific controller.
  /**
    @param $controller  layout to use
    @param $action      view to put in layout
    @param $params      params passed into the layout and the view
  */
  public static function render($controller, $action, $params=NULL){
    $__script_path = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/')+1); 
    /// $__script_path specifies the current script path (to the root of the app). It can be used inside views and layouts.
    $__view__ = "views/$controller/$action.php";

    if(!file_exists("views/layouts/$controller.php")){ // a controller without layout
      if(!file_exists($__view__))
        self::error($controller, $action, "$__view__ does not exist.");
        require($__view__);       // directly includes the view
        // $params can be used within the layout and view.
    }else{
      // include the layout
      require("views/layouts/$controller.php");
      
      /// A layout should contain "require($__view__);" to call the view.
      // $params can be used within the layout and view.
    }
    exit(0);
  }
  
  /* redirect(url, $_GET array)*/
  ///  redirect to a specific url, which will invoke the controller method call
  /**
  @param $url   an url like login/index
  @param $_get  the $_GET[] array to attach on the layout
  */
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
  
  /// returns a string representing an URL path pointing to an action
  /**
  @param $controller  controller name
  @param $action      action name
  @param $_get        the $_GET[] array to attach on the layout
  */
  public static function path_to($controller, $action, $_get=NULL){
    $script_path = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/')+1);
    if(is_array($_get))
      return $script_path.$controller.'/'.$action.'?'.http_build_query($_get);
    else
      return $script_path.$controller.'/'.$action;
  }

  /// returns a string of a link tag
  public static function stylesheet_link_tag($file_name){
    $script_path = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/')+1);
    srand(); $salt = rand();
    return "<link href=\"$script_path$file_name?$salt\" rel=\"stylesheet\" type=\"text/css\" />\n";
  }
  
  /// returns a string of a script tag
  public static function javascript_include_tag($file_name){
    $script_path = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/')+1);
    srand(); $salt = rand();
    return "<script type=\"text/javascript\" src=\"$script_path$file_name?$salt\"></script>\n";
  }
};
?>
