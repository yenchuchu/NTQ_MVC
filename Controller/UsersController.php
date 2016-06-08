<?php

require_once 'Model/UserModel.php';

class UsersController
{

    public function index()
    {
        $result = array('view' => 'users/index');
        $user = new UserModel();
        $ulist  = $user->getList();
        $result['ulist'] = $ulist;
        
        return $result;
    }

    public function login()
    {
        $result = array('view' => 'users/login');
        $result['message'] = "";

        if(isset($_POST['Sign-in'])) {
            $username = $_POST['username'];
            $password = $_POST['password']; 

            $user = new UserModel();
            $checkLogin = $user->checkLogin($username, $password);

            if($checkLogin['0'] === false ) { 
                $result['message'] = "User or password doesn't match"; 
            } else {
                if(isset($_POST['remember'])) {
                    $timeCookie = 60*60*24*30;
                    setcookie("remember","on",time()+$timeCookie);
                    setcookie("username",$checkLogin['0']['username'],time()+$timeCookie);
                    setcookie("id",$checkLogin['0']['id'],time()+$timeCookie);
                } else {
                    $_SESSION['username'] = $checkLogin['0']['username']; 
                    $_SESSION['id'] = $checkLogin['0']['id'];
                }
                
                header('Location: ?controller=Products&action=index'); 
            }
        }

        return $result;
    }

    public function logout()
    {
        if(isset($_COOKIE['remember'])) {
            $timeCookie = 60*60*24*30;
            setcookie("remember","on",time()-$timeCookie);
            setcookie("username",$_COOKIE['username'],time()-$timeCookie);
            setcookie("id",$_COOKIE['id'],time()-$timeCookie);
        }
        session_destroy();
        header('Location: ?controller=Users&action=login'); 
    }
}
?>