<?php
class TestController extends Controller{
  static function test($p){
    parent::render('test', 'test', $p);
  }
};
?>