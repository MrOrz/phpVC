<?php
class ChoiceController extends Controller{
  static private function login_required(){
    if(!isset($_SESSION['uid']))
      parent::redirect('login/index', array('msg'=>'請重新登入')); 
      // redirect to default page (login page)
  }
  static function index($p){
    self::login_required();
    $db = new Database();
    
    // 非十選二實驗：
    $rows = $db->getArr("
      SELECT `course`.`name` AS cname, `option`.`name` AS oname, `choice`.`value` 
      FROM `option`
        LEFT JOIN `choice` ON `option`.`id` = `choice`.`option_id`
        LEFT JOIN `course` ON `course`.`id`= `option`.`course_id`
      WHERE `choice`.`user_id` = {$_SESSION['uid']} AND `course`.`grade` != 8
      ORDER BY `course`.`id`, `choice`.`value`;
    ");
    
    $p = array(); // p['course_name'] = html
    $last_course = '';
    $html = '';
    foreach($rows as $r){
      if($r['cname'] != $last_course){
        if($last_course != '')
          $p[$last_course] = "<p>$html</p>";
        $html = '';
        $last_course = $r['cname'];
      }
      $html.= ' &gt; '.$r['oname'];
    }
    $p[$last_course] = "<p>$html</p>";
    
    //十選二實驗
    $rows = $db->getArr("
      SELECT `course`.`name` AS cname, `option`.`name` AS oname, `choice`.`value` 
      FROM `option`
        LEFT JOIN `choice` ON `option`.`id` = `choice`.`option_id`
        LEFT JOIN `course` ON `course`.`id`= `option`.`course_id`
      WHERE `choice`.`user_id` = {$_SESSION['uid']} AND `course`.`grade` = 8
      ORDER BY `choice`.`value`;
    ");
    if(count($rows)>0){
      $html1 = '不想選的 ';
      $html2 = '選過的 ';
      $html3 = '志願序 ';
      foreach($rows as $r){
        switch($r['value']){
        case -2:
          $html1 .= ' &gt; '.$r['oname']; break;
        case -1:
          $html2 .= ' &gt; '.$r['oname']; break;
        default:
          $html3 .= ' &gt; '.$r['oname'];
        }
      }
      $p[$r['cname']] = "<p>$html3</p><p>$html1</p>$html2</p>";
    }
    parent::render('choice', 'index', $p);
  }
};
?>