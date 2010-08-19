<?php
class Database{
  const DATABASE_URL  = 'localhost';
  const DATABASE_NAME = '' ;
  const USER          = '';
  const PASSWORD      = '';
  
  const DEBUG = true;
  
  private  $_link;
  
  private function _err($msg){  // error handling function of sql_query
    if(self::DEBUG)die('['.$msg.'] '.mysql_error());
    else die('database error');
  }

  function __construct(){
    $this->_link = mysql_connect(self::DATABASE_URL,self::USER,self::PASSWORD)
      or $this->_err('mysql_connect fail');
  	mysql_select_db(self::DATABASE_NAME, $this->_link)
			or $this->_err("mysql_select_db failed");

		mysql_query("SET CHARACTER SET 'utf8'", $this->_link);
  }
  
  function __destruct(){
    mysql_close($this->_link);
    
  }
  function getArr($sql){ // return row result as a 2-D array
    $table = mysql_query($sql, $this->_link) 
      or $this->_err($sql);
      
    $arr = array();               // the 2-d array to be returned
    if(mysql_num_rows($table)){
      while($row = mysql_fetch_assoc($table))
        array_push($arr, $row);   // push the entire row as one element in $arr
    }
    return $arr;
  }
  public function query($query){
    return mysql_query($query, $this->_link) or $this->_err($query);
  }
  public function getInsertId(){
    return mysql_insert_id($this->_link);
  }
  public function escape($text){
    //return $text;
    return mysql_real_escape_string($text ,$this->_link);
  }
};
    
?>