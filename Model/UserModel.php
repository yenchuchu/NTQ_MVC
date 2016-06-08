<?php 

/**
* 
*/
class UserModel {

  // public static $TIMECOOKIE = 60*60*24*30;
  
  function __construct()
  {
    require 'config/connectDB.php';
  }

  public function getList()
  {
    $sql = "SELECT * FROM users";
    $query = mysql_query($sql);
    
    $result = array();
    while ($row = mysql_fetch_assoc($query)) {
      $result[] = $row;
    }
    return $result;
  }

  public function add($username = null, $email = null, $password = null, $avatar = null, $activate = null, $item_delete = null, $created = null)
  {
    $sql = "INSERT INTO user (username, email, password, avatar, activate, item_delete, created) 
            VALUES ('" . mysql_escape_string($username) ."',
                    '".$email."', '".$password."', '".$avatar."',
                    '".$activate."', '".$item_delete."', '".$created."' )";

    $query = mysql_query($sql);
    return $query;
  }

  public static function checkLogin($user, $pass) { 

      $sql = "SELECT * FROM users WHERE username ='".$user."' AND password ='".$pass."'";
      $query = mysql_query($sql);

      $result = array();
      $result[] = mysql_fetch_assoc($query);

      return $result; 
  } 

  public function getAuthUser()
  {
    if (isset($_COOKIE['remember'])) {
      echo "cookie";
      $id = $_COOKIE['id'];
      return $id;
    }
    if (isset($_SESSION['id'])) {
      echo "session";
      $id = $_SESSION['id'];
      return $id;
    }
  }
 
  // public function edit($username = null, $email = null, $password = null, $avatar = null, $activate = null, $item_delete = null, $created = null)
  // {
  //   # code...
  // }

}
 ?>