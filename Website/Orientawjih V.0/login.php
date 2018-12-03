<?php
include_once '/fct/db/DataBase.php';
include_once '/fct/classes/Etablis.php';
$db=new DataBase();
$db->connect();
echo var_dump($_POST);
$et=new Etablis("","",$_POST["email"],$_POST["pass"],"","","");
$et->email=$_POST["email"];
$et->password=$_POST["pass"];
if($db->exist($et,"Etablis")!=-1)echo "Connected";
else echo "Not Connected";
 ?>
