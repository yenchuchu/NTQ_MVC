<?php

require_once 'Model/CategoryModel.php';
require_once 'Model/UserModel.php';

class CategoriesController {

    public function index()
    {
        $result = array('view' => 'Categories/index');
        $category = new CategoryModel();
        
        if(isset($_POST['btn-search'])) {
            $likeCategory = $_POST['search-name'];
            $Clists = $category->search($likeCategory);
        } else {
            $Clists = $category->getList();
        }
        
        $pages = $category->getTotalPage('categories', '10');
        $result['pages'] = $pages;
        $current_page = 1;

        if (isset($_GET['page'])) { 
            $Plists = $category->paging('categories', '10') ;
            if ($_GET['page'] > $pages || $_GET['page'] < 1) {
                $current_page = 1;
            } else {
                $current_page = $_GET['page'];
            }  
        }
        $result['current_page'] = $current_page;
        
        $result['Clist'] = $Clists;
        $result['message'] = "";
        return $result;
    }

    public function add() 
    {
        $result = array('view' => 'Categories/add');
        $category = new CategoryModel(); 
        
        $result['message'] = "";

        if(isset($_COOKIE['remember'])){
            $idAuth =  $_COOKIE['id'];
        }

        if (isset($_SESSION['username'])) {
            $idAuth =  $_SESSION['id'];
        } 
     
        if(isset($_POST['createCategory'])) { 
            $categoryName = $_POST['categoryName'];
            $activate = $_POST['activate'];
            
            $check = $category->add($idAuth, $categoryName, $activate);
            if($check == false) {
               $result['message'] = "Category name existed!"; 
            } else{
                header('Location: ?controller=Categories&action=index');
            }
        }

        return $result;
    }

    public function edit($id=null)
    {
        $id = $_GET['id'];
        $result = array('view' => 'Categories/edit');
        $category  = new CategoryModel();
        $Clists = $category->findCategoryById($id);
        $result['Clist'] = $Clists;
        $result['message'] = "";

        if(isset($_POST['Update'])) { 
            $categoryName = $_POST['edit-category-name'];
            $activate = $_POST['select'];

            $check = CategoryModel::edit($id, $categoryName, $activate);
            if($check == false) {
               $result['message'] = "Category name existed!"; 
            } else {
                header('Location: ?controller=Categories&action=index');
            } 
        }
        
        return $result;
    }

    public function delete($id=null)
    {
        $itemCategory = new CategoryModel();
        $ids = $_POST['ids']; 
 
        if ($itemCategory->delete($ids) == true ) { 
            echo json_encode(['status' => 0, 'message' => 'Delete sucess!']);
            exit;
           }

        echo json_encode(['status' => 1, 'message' => 'Delete not success']);
        exit;
    }

 }
?>