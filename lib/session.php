<?php
/**
*Session Class
**/
class Session{
public static function init(){
if (version_compare(phpversion(), '5.4.0', '<')) {
if (session_id() == '') {
session_start();
}
} else {
if (session_status() == PHP_SESSION_NONE) {
session_start();
}
}
}

public static function set($key, $val){
$_SESSION[$key] = $val;
}

public static function get($key){
if (isset($_SESSION[$key])) {
return $_SESSION[$key];

} else {
return false;
}
}

public static function checkSession(){
self::init();
if (self::get("loginadmin")== false) {
self::destroy();
if(!headers_sent()){
	header("Location:login.php");
}else{
	echo '<script type="text/javascript">window.location.href="login.php";</script>';
} 
}
}

public static function checkLogin(){
self::init();
if (self::get("loginadmin")== true) {
if(!headers_sent()){
	header("Location:login.php");
}else{
	echo '<script type="text/javascript">window.location.href="login.php";</script>';
} 
}
}

public static function destroy(){
session_destroy();
if(!headers_sent()){
	header("Location:dang-nhap");
}else{
	echo '<script type="text/javascript">window.location.href="dang-nhap";</script>';
} 
}
public static function destroy_admin(){
session_destroy();
if(!headers_sent()){
	header("Location:login.php");
}else{
	echo '<script type="text/javascript">window.location.href="login.php";</script>';
} 
}
}

?>
