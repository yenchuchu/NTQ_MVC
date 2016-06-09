<?php
require_once 'Model/ProductModel.php';
require_once 'Model/UserModel.php';
require_once 'Model/CategoryModel.php';  

class ProductsController {

    public function index(){
        $result = array('view' => 'products/index');
        $product = new ProductModel();
 
        if(isset($_POST['btn-search'])) {
            $likeProducts = $_POST['search-name'];
            $Plists = $product->search($likeProducts);
        } else {
            $Plists = $product->getList();
        }

        $pages = $product->getTotalPage('products', '10');
        $result['pages'] = $pages;
        $current_page = 1;
        
        if (isset($_GET['page'])) { 
            $Plists = $product->paging('products', '10') ;
            if ($_GET['page'] > $pages || $_GET['page'] < 1) {
                $current_page = 1;
            } else {
                $current_page = $_GET['page'];
            } 
        }

        $result['current_page'] = $current_page;
 
        $result['Plists'] = $Plists;

        $categories = new CategoryModel();
        $allCategories = $categories->getAllIdCategory(); 
        $arrayCate = array();

        foreach ($allCategories as $cate) {
            $name= $categories->getNameCategoryById($cate['id']);
            $arrayCate[$cate['id']] = array($cate['id'] => $name[0]['category_name']);
        }

        $result['category'] = $arrayCate; 
        $result['message'] = "";

        return $result;
    }

    public function add($id=null)
    {
        $result = array('view' => 'products/add');
        $product = new ProductModel();

        if(isset($_COOKIE['remember'])){
            $idAuth =  $_COOKIE['id'];
        }

        if (isset($_SESSION['username'])) {
            $idAuth =  $_SESSION['id'];
        }

        $categories = new CategoryModel();
        $allCategories = $categories->getListActivate();
        $result['categories'] = $allCategories;
        $result['message'] = "";
  
         if(isset($_POST['create-product'])) {
            $product_name = $_POST['product-name'];
            $category = $_POST['select-category'];
            $price = $_POST['price'];
            $description =  $_POST['description'];
            $activate = $_POST['select-activate'];

            // upload image
            $target_dir = "img/products/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $image = basename($_FILES["fileToUpload"]["name"]); 
            $result['add-image'] = $image;

            if(!empty($_FILES["fileToUpload"]["tmp_name"])) {
                $checkImage = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($checkImage !== false) {
                    $uploadOk = 1; // 
                } else {
                    $uploadOk = 0; // File is not an image
                }
            } 

            $check = $product->add($idAuth, $product_name, $category, $price, $description, $image, $activate); 
            if(!empty($check['message-price'])) {
                $result['message-price'] = $check['message-price'];

            } elseif (!empty($check['message-prName'])) {
                $result['message-prName'] = $check['message-prName'];

            } elseif (!empty($check['message-category'])) {
                $result['message-category'] = $check['message-category'];
                
            } elseif (!empty($check['message-activate'])) {
                $result['message-activate'] = $check['message-activate'];

            } elseif($check == false) {
                $result['message-prName'] = "Product name existed!"; 
            } else {
                if($checkImage != 0) {
                    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) ;
                }
                header('Location: ?controller=Products&action=index');
            }
        }

        return $result;
    }

    public function edit($id=null)
    {
        $id = $_GET['id'];
        $result = array('view' => 'products/edit');

        $product = new ProductModel();
        $productDetail = $product->findProductId($id); 
        $result['Clist'] = $productDetail;
        $result['message'] = "";
        
        if(isset($_POST['Update'])) { 
            $productName = $_POST['edit-product-name'];
            $description = $_POST['description'];
            $price = $_POST['edit-price'];
            $activate = $_POST['select-activate'];
            $queryImage = mysql_query("SELECT image FROM products WHERE id ='".$id."'");

            if(!empty(basename($_FILES["fileToUpload"]["name"]))) {
                $target_dir = "img/products/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                $image = basename($_FILES["fileToUpload"]["name"]);
                
                if(!empty($_FILES["fileToUpload"]["tmp_name"])) {
                    $checkImage = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($checkImage !== false) {
                        $uploadOk = 1; // 
                    } else {
                        $uploadOk = 0; // File is not an image
                    }
                }
            } else {
                $image = "";
            }
            
            $check = ProductModel::edit($id, $productName, $activate, $price, $description, $image);
            if(!empty($check['message-price'])) {
                $result['message-price'] = $check['message-price'];

            } elseif (!empty($check['message-prName'])) {
                $result['message-prName'] = $check['message-prName'];

            } elseif (!empty($check['message-category'])) {
                $result['message-category'] = $check['message-category'];
                
            } elseif (!empty($check['message-activate'])) {
                $result['message-activate'] = $check['message-activate'];

            } elseif($check == false) {
                $result['message-prName'] = "Product name existed!"; 
            } else{
                if($checkImage != 0) {
                    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) ;
                }
                header('Location: ?controller=Products&action=index');
            }
        }

        return $result;
    }

    public function delete($id=null)
    {
        $itemProduct = new ProductModel();
        $ids = $_POST['ids'];  

        if ($itemProduct->delete($ids) == true ) { 
            echo json_encode(['status' => 0, 'message' => 'Delete success!']);
            exit;
           }

        echo json_encode(['status' => 1, 'message' => 'Save not success']);
        exit;
    }

 }
?>