
<?php
if(isset($_POST["submit"])){
  include_once '../fct/db/Database.php';
  include_once '../fct/classes/Etablis.php';
  $email=$_POST["email"];
  $pass=$_POST["pass"];
  $db=new Database();
  $db->connect();
  echo "$email<br>$pass";
  $obj=$db->select("etablis","where e_mail='$email' and password='$pass'")[0];
  if($obj!=null){
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
    }
    $_SESSION['id_etablis']=$obj->id;
    $_SESSION['id_admin']=null;
    header("location:home.php");
  }else{

  }
}

function fixObject (&$object)
{
  if (!is_object ($object) && gettype ($object) == 'object')
    return ($object = unserialize (serialize ($object)));
  return $object;
}

 ?>
<!DOCTYPE HTML>
<html>
<head>
<title>P</title>
<link href="../css/adlog.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<body>

		<form method="post" action="login.php">
				<input type="text" name="email" placeholder="email">
				<input type="password" name="pass" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}"> <a href="#" class="icon lock"></a>
				<input type="submit" name="submit" value="Sign in" >

		</form>
