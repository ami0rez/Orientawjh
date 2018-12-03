<?php
include_once '../fct/classes/Admin.php';
include_once '../fct/db/DataBase.php';
session_start();
$db=new DataBase();
$db->connect();
if(isset($_SESSION['admin']))$obj=$_SESSION['admin'];
elseif(isset($_SESSION['id_admin'])){
  $idad=$_SESSION['id_admin'];
  $obj=$db->select("admin","where id=$idad")[0];
  $_SESSION['admin']=$obj;
}else{
  die("Error Connection");
}
if(isset($_POST["submit"])){

  $target_dir = "../pics/admin/";
  $email=$_POST["email"];
  $old_img=$obj->img;
  $name=$_POST["name"];
  $prename=$_POST["prename"];
  $password=$_POST["password"];
  $date_naisc=$_POST["date_naisc"];
  $adress=$_POST["adress"];
  $imgname=substr($email,0,strpos($email,"@"));
  $imgname.=".".pathinfo(basename($old_img, PATHINFO_EXTENSION))["extension"];
  $target_file = $target_dir .$imgname;
  echo "$target_file";
  if($_FILES["fileToUpload"]["name"]!=""){
    unlink($target_dir.$old_img);
  if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Sorry, there was an error uploading your file";
        echo var_dump($_FILES["fileToUpload"]["name"]);
    }
  }
  $admin=New Admin($name,$prename,$email,$password,$date_naisc,$adress,$imgname);
  $admin->id=$obj->id;
  // echo var_dump($admin);
  if($db->update($admin,"admin",$obj->id)=="1"){
    $obj=$admin;
    $_SESSION['admin']=$admin;
  }else {
    "Error Updating";
  }
}
 ?>
 <html>
 <head>
   <title>Profile</title>
   <script type="text/javascript">
         function readURL() {
           var x=document.getElementById('x');
           var fReader = new FileReader();
           fReader.readAsDataURL(x.files[0]);
           fReader.onloadend = function(event){
             var img = document.getElementById("blah");
             img.src = event.target.result;
           }
         }
     </script>
   <link rel="stylesheet" type="text/css" href="../css/addadmin.css"/>
 </head>
 <body>
   <script type="text/javascript">
         function readURL() {
           var x=document.getElementById('x');
           var fReader = new FileReader();
           fReader.readAsDataURL(x.files[0]);
           fReader.onloadend = function(event){
             var img = document.getElementById("blah");
             img.src = event.target.result;
           }
         }
     </script>
   <img id="blah" src="../pics/admin/<?php echo $obj->img?>"/>
   <form method="post" enctype="multipart/form-data" action="Profile.php">
     <input type="hidden" name="MAX_FILE_SIZE" value="300000000">
     <input type='file' name="fileToUpload" onchange="readURL();" id="x" />
     <input type="text" name="name" value="<?php echo $obj->name?>" id="email"placeholder="Nom">
     <input type="text" name="prename" value="<?php echo $obj->prename?>" id="email"placeholder="Prenom">
     <input type="text" name="email" value="<?php echo $obj->email?>" id="email" placeholder="E_mail">
     <input type="text" name="password" value="<?php echo $obj->password?>" id="email" placeholder="Mot de pass">
     <input type="text" name="date_naisc" value="<?php echo $obj->date_naisc?>" id="email" placeholder="Date Naissance">
     <input type="text" name="adress" value="<?php echo $obj->adress?>" id="email" placeholder="Adress">
     <input type="submit" name="submit" value="Mise a jour"/>
   </form>
 </body>
 </html>
