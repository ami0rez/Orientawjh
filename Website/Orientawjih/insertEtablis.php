<?php
include_once 'fct/classes/Etablis.php';
include_once 'fct/db/Database.php';
$name=$_POST["name"];
$prename=$_POST["prename"];
$email=$_POST["email"];
$password=$_POST["pass1"];
$date_n=$_POST["date_n"];
$tel=$_POST["name"];
$etb=new Etablis($name,$prename,$email,$password,$date_n,$tel,"00");
$db=new Database();
$db->connect();
echo var_dump($_POST);
echo var_dump($etb);
$db->insert($etb,"Etablis");
 ?>
