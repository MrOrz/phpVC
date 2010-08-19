<?php
class BookController extends Controller{
  static private function login_required(){
    if(!isset($_SESSION['uid']))
      parent::redirect('login/index', array('msg'=>'請重新登入')); 
      // redirect to default page (login page)
  }
  static function index($p){
    self::login_required();
    $db = new Database();
    
    parent::render('book', 'index', $p);
  }
};
?>
