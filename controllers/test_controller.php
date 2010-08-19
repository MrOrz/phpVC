<?php
class TestController extends Controller{
  static function page($p){
    parent::render('test', 'page', $p);
  }
};
?>