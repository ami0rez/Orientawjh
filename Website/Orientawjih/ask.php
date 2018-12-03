<?php
include_once 'fct/classes/Ask_res.php';
include_once 'fct/db/DataBase.php';
$text=@$_POST["txt"];
$type=@$_POST["ask"];
$db=new DataBase();
$db->connect();
switch ($type) {
  case 'ask':
    $x=new Ask(0,"ask",$text,"-","-","-","-");
    break;

  default:
  $x=new Ask(0,"rsp",$text,"-","-","-","0");
    break;
}
$db->insert($x,"reponse");
 ?>
