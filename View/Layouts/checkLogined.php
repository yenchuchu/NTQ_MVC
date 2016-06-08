<?php 

//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập

if (!isset($_COOKIE['remember'])) {
	if (!isset($_SESSION['username'])) {
	 	header('Location: ?controller=Users&action=login');
	}
}  



?>