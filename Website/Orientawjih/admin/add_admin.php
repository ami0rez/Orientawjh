
<?php
include_once '../fct/classes/Admin.php';
include_once '../fct/db/DataBase.php';
$target_dir = "../pics/admin/";
if(isset($_POST["submit"])) {
  $name=$_POST["name"];
  $prename=$_POST["prename"];
  $email=$_POST["email"];
  $password=$_POST["password"];
  $date_naisc=$_POST["date_naisc"];
  $adress=$_POST["adress"];
  $imgname=substr($email,0,strpos($email,"@"));
  $imgname.=".".pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION);
  $target_file = $target_dir .$imgname;
  if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Sorry, there was an error uploading your file.";
    }
  $admin=New Admin($name,$prename,$email,$password,$date_naisc,$adress,$imgname);
  $db=new DataBase();
  $db->connect();
  if($db->insert($admin,"admin")=="1"){
    session_start();
    $admin->id=$db->selectScalar("select max(id) from admin");
    $_SESSION['obj']=$admin;
    $_SESSION['idad']=$admin->id;
    #echo var_dump($_SESSION['obj']);
    header('Location:Profile.php');
  }
  $message="";
  switch( $_FILES['fileToUpload']['error'] ) {
            case UPLOAD_ERR_OK:
                $message = false;;
                break;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $message .= ' - file too large (limit of  bytes).';
                break;
            case UPLOAD_ERR_PARTIAL:
                $message .= ' - file upload was not completed.';
                break;
            case UPLOAD_ERR_NO_FILE:
                $message .= ' - zero-length file uploaded.';
                break;
            default:
                $message .= ' - internal error #'.$_FILES['newfile']['error'];
                break;
        }
        echo $message;
          }
?>

<html>
<head>
  <title>Profile</title>
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
  <img id="blah" scr="#" alt="image">
  <form method="post" enctype="multipart/form-data" action="add_admin.php">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000">
    <input type='file' name="fileToUpload" onchange="readURL();" id="x" />
    <input type="text" name="name" id="email"placeholder="Nom">
    <input type="text" name="prename" id="email"placeholder="Prenom">
    <input type="text" name="email" id="email" placeholder="E_mail">
    <input type="text" name="password" id="email" placeholder="Mot de pass">
    <input type="text" name="date_naisc" id="email" placeholder="Date Naissance">
    <input type="text" name="adress" id="email" placeholder="Adress">
    <input type="submit" name="submit" value="inscription"/>
  </form>
</body>
</html>
