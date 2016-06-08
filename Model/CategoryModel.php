<?php
class CategoryModel {
  
  function __construct()
  {
    require 'config/connectDB.php';
  }

  public function getList()
  {
    $sql = "SELECT * FROM categories WHERE item_delete = '1' ORDER BY id DESC LIMIT 10";
    $query = mysql_query($sql);
    if($query === false) {
      return array();
    }

    $result = array();
    while ($row = mysql_fetch_assoc($query)) {
      $result[] = $row;
    }
    return $result;
  }

  public function add($user_id, $category_name, $activate)
  { 
    date_default_timezone_set("Asia/Bangkok");
    $thisDay = date(" Y/m/d h:i"); 

    $sql = "INSERT INTO categories (user_id, category_name, activate, created, modified, item_delete) 
            VALUES ('" . $user_id ."', '".mysql_escape_string($category_name)."', 
                    '".$activate."', '".$thisDay."', '".$thisDay."', '1')";
    $query = mysql_query($sql);
    if ($query == false) {
      return false;
    }
    return $query; 
  }

  public function edit($id, $category_name, $activate)
    {  
      date_default_timezone_set("Asia/Bangkok");
      $thisDay = date(" Y/m/d h:i"); 

      $sql = "UPDATE categories SET  
                    category_name = '". $category_name."', 
                    activate = '". $activate."',  
                    modified = '". $thisDay."'  
                    WHERE id = '".$id."'"; 
      $query = mysql_query($sql);
      if ($query == false) {
        return false;
      }
      return $query; 
    }

    public function delete($id)
    {
      for($i=0; $i<count($id); $i++) {
       $sql = "UPDATE categories SET item_delete = '0' 
                            WHERE id = '".$id[$i]."'";
       $query = mysql_query($sql); 
      }
      return $query; 
    }

    public function findCategoryById($id) {
 
      $sql = "SELECT * FROM categories WHERE id ='".$id."'";
      
      $query = mysql_query($sql);
      if ($query === false) {
          return null;
      }
      $row   = mysql_fetch_assoc($query);
      return $row;

    }

    public function getNameCategoryById($id) {
 
      $sql = "SELECT category_name FROM categories WHERE id ='".$id."'";
      
      $query = mysql_query($sql);
      if ($query === false) {
          return null;
      }
      $result = array();
      while ( $row   = mysql_fetch_assoc($query)) {
         $result[] = $row;
      } 

      return $result;
    }

  public function search($category_name) { 

    $sql = "SELECT * FROM categories WHERE category_name like '%".$category_name."%' ";
    $query = mysql_query($sql);
    
    if($query === false) {
      return array();
    }

    $result = array();
    while ($row = mysql_fetch_assoc($query)) {
      $result[] = $row;
    }
    return $result;
  }

  public function getAllIdCategory()
  {
    $sql = "SELECT id FROM categories WHERE item_delete ='1'";
    
    $query = mysql_query($sql);
    if ($query === false) {
        return null;
    }
    $result = array();
    while ($row = mysql_fetch_assoc($query)) {
      $result[] = $row;
    }
    return $result;
  }
    
  public function paging($table, $limit) { // limit: total units on a page

    if(!$_GET['page']) {
        $current_page = 1 ; // current page
    } else {
      $current_page = $_GET['page'];
    }
    
    $start = ($current_page - 1) * $limit; 

    $sql = "SELECT * FROM ".$table." WHERE item_delete = '1' ORDER BY id DESC LIMIT ".$start.",".$limit;
    $query =mysql_query($sql); 

    $result = array();
    while ($row = mysql_fetch_assoc($query)) {
      $result[] = $row;
    }
    return $result;
  }

  public function getTotalPage($table, $limit)
  {
    $total_rows = mysql_num_rows(mysql_query("SELECT * FROM ".$table." WHERE item_delete = '1' ")); // total categories
    $item_total_page = $total_rows%$limit; // total page

    if ($item_total_page == 0) {
      $total_page = intval($total_rows/$limit);
    } else {
       $total_page = intval($total_rows/$limit) + 1;
    }

    return $total_page;
  }
}
 ?>