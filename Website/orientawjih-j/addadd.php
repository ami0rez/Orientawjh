<?php
include_once 'fct/classes/Admin.php';
include_once 'fct/db/DataBase.php';
$name=@$_POST["name"];
$prename=@$_POST["prename"];
$email=@$_POST["email"];
$password=@$_POST["password"];
$date_naisc=@$_POST["date_naisc"];
$adress=@$_POST["adress"];
$img=@$_POST["img"];
$admin=new Admin($name,$prename,$email,$password,$date_naisc,$adress,$img);
echo var_dump($admin);
$db=new DataBase();
$db->connect();
$db->insert($admin,"admin");
 ?>
