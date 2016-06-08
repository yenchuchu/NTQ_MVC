<?php 
/**
* 
*/ 

class ProductModel {
  
  function __construct()
  {
    require 'config/connectDB.php';
  }

  public function getList()
  {
    $sql = "SELECT * FROM products WHERE item_delete = '1' ORDER BY id DESC LIMIT 10";
    $query = mysql_query($sql);

    $result = array();
    while ($row = mysql_fetch_assoc($query)) {  // limit 10 error
      $result[] = $row;
    }

    return $result;
  }

  public function add($user_id, $product_name, $category_id, $price, $description, $image, $activate)
  { 
    date_default_timezone_set("Asia/Bangkok");
    $thisDay = date(" Y/m/d h:i"); 

    $sql = "INSERT INTO products (user_id, product_name, category_id, price, description, 
                                  activate, created, modified, image, item_delete) 
            VALUES ('" . $user_id ."', '".mysql_escape_string($product_name)."', 
                    '".$category_id."', '".$price."', 
                    '".$description."', '".$activate."', 
                    '".$thisDay."', '".$thisDay."','".$image."', '1')";
    $query = mysql_query($sql);
    if ($query == false) {
      return false;
    }
    return $query; 
  }

  public function edit($id, $product_name, $activate, $price, $description, $image)
  {   
    date_default_timezone_set("Asia/Bangkok");
    $thisDay = date(" Y/m/d h:i"); 

    if ($image == "") {
      $sql = "UPDATE products SET  
                    product_name = '".$product_name ."',
                    activate = '".$activate ."', 
                    price ='".$price."', 
                    description = '".$description."', 
                    modified = '".$thisDay ."' 
                    WHERE id = '".$id."'";
    } else {
      $sql = "UPDATE products SET  
                    product_name = '".$product_name ."',
                    activate = '".$activate ."', 
                    price ='".$price."', 
                    description = '".$description."', 
                    image = '".$image."',  
                    modified = '".$thisDay ."' 
                    WHERE id = '".$id."'";
    }
    

    $query = mysql_query($sql);
    if ($query == false) {
      return false;
    }
    return $query; 
  }

  public function delete($ids)
  {
    for($i=0; $i<count($ids); $i++) {
       $sql = "UPDATE products SET item_delete = '0' 
                            WHERE id = '".$ids[$i]."'";
       $query = mysql_query($sql); 
     }
     return $query; 
  }

  public function findProductId($id) {
    $sql = "SELECT * FROM products WHERE id ='".$id."'";
      
      $query = mysql_query($sql);
      if ($query === false) {
          return null;
      }
      $row   = mysql_fetch_assoc($query);
      return $row;
  }

  public function getAllIdProduct()
  {
    $sql = "SELECT id FROM products WHERE item_delete ='1' ORDER BY id DESC";
    
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

  public function listIdProductByIdCategory($id_product)
  {
    $sql = "SELECT ca.category_name FROM products AS pr
            INNER JOIN categories AS ca ON pr.category_id = ca.id 
            WHERE pr.item_delete ='1' AND pr.id ='".$id_product."'";

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

  public function search($product_name) { 

    $sql = "SELECT * FROM products WHERE product_name like '%".$product_name."%' ";
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