<?php
session_start();
$city=$_GET['format2'];
$num=count($_GET);
echo $num."<br />";
$i=0;
foreach($_GET as $key=>$value){
  echo $key."  ".$value."<br />";
  }


//['format2'];//посмотреть и убрать
$country=$_SESSION['strana'];
$_SESSION['strana']=$country;
$_SESSION['gorod']=$city;
function __autoload($class){
  //подключение файла с именем "class_имя_класса.php"
  include(/*"class_".*/$class.".php");
}
$page=new hat_foot();
$page->hat();
echo "<a href= 'display_country.php?name=".$country."'>".$country."</a>";
echo "<a href='display_city.php&name=".$city."&strana=".$country."'>".$city."</a>";
$tur= new tour();
$tur->display($country,$city);
$page->footer();
?>
