<?php
/**
* Format Class
*/
class Format{
public function formatDate($date){
return date('d/m/Y', strtotime($date));
}
public function formatDate_Details($date){
return date('d/m/Y h:m', strtotime($date));
}

public function textShorten($text, $limit = 400){
$text = $text. " ";
$text = substr($text, 0, $limit);
$text = substr($text, 0, strrpos($text, ' '));
$text = $text.".....";
return $text;
}

public function validation($data){
$data = trim($data);
$data = stripcslashes($data);
$data = htmlspecialchars($data);
return $data;
}

public function title(){
$path = $_SERVER['SCRIPT_FILENAME'];
$title = basename($path, '.php');
//$title = str_replace('_', ' ', $title);
if ($title == 'index') {
$title = 'home';
}elseif ($title == 'contact') {
$title = 'contact';
}
return $title = ucfirst($title);
}
public function format_currency($n=0){
	$n=(string)$n;
	$n=strrev($n);
	$res='';
	for($i=0;$i<strlen($n);$i++){
		if($i%3==0 && $i!=0){
			$res.='.';
		}
		$res.=$n[$i];
	}
	$res=strrev($res);
	return $res;
}
function generateSeoURL($string, $wordLimit = 0){ 
    $separator = '-'; 
     
    if($wordLimit != 0){ 
        $wordArr = explode(' ', $string); 
        $string = implode(' ', array_slice($wordArr, 0, $wordLimit)); 
    } 
 
    $quoteSeparator = preg_quote($separator, '#'); 
 
    $trans = array( 
        '&.+?;'                 => '', 
        '[^\w\d _-]'            => '', 
        '\s+'                   => $separator, 
        '('.$quoteSeparator.')+'=> $separator 
    ); 
 
    $string = strip_tags($string); 
    foreach ($trans as $key => $val){ 
        $string = preg_replace('#'.$key.'#iu', $val, $string); 
    } 
 
    $string = strtolower($string); 
 
    return trim(trim($string, $separator)); 
}
function vn_to_str ($str){
 
$unicode = array(
 
'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
 
'd'=>'đ',
 
'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
 
'i'=>'í|ì|ỉ|ĩ|ị',
 
'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
 
'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
 
'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
 
'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
 
'D'=>'Đ',
 
'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
 
'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
 
'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
 
'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
 
'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
 
);
 
foreach($unicode as $nonUnicode=>$uni){
 
$str = preg_replace("/($uni)/i", $nonUnicode, $str);
 
}
$str = str_replace(' ',' ',$str);
 
return $str;
 
}
}
?>