
<?php
if(isset($_POST["submit"])){
  include_once '../fct/db/Database.php';
  include_once '../fct/classes/Admin.php';
  $email=$_POST["email"];
  $pass=$_POST["pass"];
  $db=new Database();
  $db->connect();
  $obj=$db->select("admin","where e_mail='$email' and password='$pass'")[0];
  if($obj!=null){
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
    }
    $_SESSION['id_admin']=$obj->id;
    $_SESSION['id_etablis']=null;
    $_SESSION['admin']=$obj;
    header("location:home.php");
  }else{

  }
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
