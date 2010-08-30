<?php
/// a typical controller derives from Controller.
/**
  TestController is a controller named 'test', thus the layout for the 
  controller should be views/layout/test.php, and the views for the actions
  should be put inside views/test.
*/
class TestController extends Controller{
  /// an action called page, shows the action 'page'
  static function page($p){
    parent::render('test', 'page', $p);
  }
};
?>