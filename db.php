<?php
require('passwd.php'); /* defines DATABASE_URL, DATABASE_NAME, USER, PASSWORD. */

class Database{ 
  const DEBUG = true;
  
  private  $_link;
  
  private function _err($msg){  // error handling function of sql_query
    if(self::DEBUG)die('['.$msg.'] '.mysql_error());
    else die('database error');
  }

  function __construct(){
    $this->_link = mysql_connect(DATABASE_URL,USER,PASSWORD)
      or $this->_err('mysql_connect fail');
  	mysql_select_db(DATABASE_NAME, $this->_link)
			or $this->_err("mysql_select_db failed");

		mysql_query("SET CHARACTER SET 'utf8'", $this->_link);
  }
  
  function __destruct(){
    mysql_close($this->_link);
    
  }
  // return row result as a 2-D array.
  // if $index_column is specified, the returned 2D array will be indexed by the
  // value of the specified column.
  function getArr($sql, $index_column = ''){ 
    $table = mysql_query($sql, $this->_link) 
      or $this->_err($sql);
      
    $arr = array();               // the 2-d array to be returned
    if(mysql_num_rows($table)){
      while($row = mysql_fetch_assoc($table)){
        if($index_column === '')
          $arr[] = $row;   // push the entire row as one element in $arr
        else
          $arr[$row[$index_column]] = $row;
                            // push the entire row as one element in $arr
      }
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
    return $text;
    //return mysql_real_escape_string($text ,$this->_link);
  }
};
    
?>