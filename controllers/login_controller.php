<?php
class LoginController extends Controller{

  const SERVER_DOWN = 0;      // pop3 / ftp server is down
  const VALID       = 1;      // login correct (pop3/ftp/in user list).
  const INVALID     = 2;      // login failed on pop3 / ftp server

  static private function special_login($user, $password){
    // the 'user'=>'setted password' hash.
    $u = array('b98901196'=>'a0701', 'b96901068'=>'123456789', 'b98901126'=>'good20661', 'b98901188'=>'297da4i5', 'b96202046'=>'ca8479','b97902002'=>'','b98209009'=>'','b98501012'=>'','b98501022'=>'','b98501035'=>'','b98501057'=>'','b98502062'=>'','b98502134'=>'','b98504030'=>'','b98504065'=>'','b98504082'=>'','b98505009'=>'','b98505033'=>'','b98505044'=>'','b98507041'=>'','b98611016'=>'','b98613006'=>'','b98902008'=>'','b98902030'=>'','b97502079'=>'','b97504030'=>'','b96504028'=>'','b97207003'=>'','b97209026'=>'','b98501023'=>'','b98501082'=>'','b96502034'=>'');

    if(isset($u[$user]) && $u[$user] === $password){
      return self::VALID;
    }else
      return self::INVALID;
  }
  
  static function index($p){
    if(isset($_SESSION['uid']))
      parent::redirect('choice/index');
    else
      parent::render('login' , 'index', $p);
  }
  
  static function login(){
    $validate = self::pop3_login($_POST['user'], $_POST['password']);
    if($validate == self::INVALID)
      $validate = self::special_login($_POST['user'], $_POST['password']);
      
    switch($validate){
    case self::SERVER_DOWN :
      parent::render('login', 'index', array('msg'=>'連不上登入伺服器，請稍後再試'));
      break;
    case self::INVALID :
      parent::render('login', 'index', array('msg'=>'帳號密碼錯誤'));
      break;
    case self::VALID :
      $db = new Database();
      $school_id = $db->escape($_POST['user']);
      $user = $db->getArr("SELECT `id` FROM `user` WHERE `school_id` = '$school_id' ;");
      if( count($user)!=1 )
        parent::render('login', 'index', array('msg'=>'您不在選課名單中'));
      $_SESSION['school_id'] = $school_id;
      $_SESSION['uid']       = $user[0]['id'];
      parent::redirect('choice/index');
    }
  }
  
  static function logout(){
    unset($_SESSION['uid']);
    parent::redirect('login/index');
  }
  
  private static function pop3_put($pop3, $cmd = '') {
    if ($cmd != '') 
      @fputs($pop3, "$cmd\r\n");
    $result = @fgets($pop3, 100);
    if (strncmp('+OK ', $result, 4) != 0) 
      return false;
    else
      return true;
  }
  
  private static function pop3_login($user_name, $user_password) {  
    $server = "140.112.18.70"; // mail.ee.ntu.edu.tw
    $port = 110;
    $pop3 = @fsockopen($server, $port);
    if (!$pop3) return self::SERVER_DOWN;
    
    self::pop3_put($pop3); // Get Greetings.
    if (!self::pop3_put($pop3, "USER $user_name")) 
      $ToReturn = self::SERVER_DOWN;
    else if (!self::pop3_put($pop3, "PASS $user_password")) 
      $ToReturn = self::INVALID;
    else 
      $ToReturn = self::VALID;
      
    self::pop3_put($pop3, "QUIT");
    @fclose($pop3);
    return $ToReturn;
  }
};
?>