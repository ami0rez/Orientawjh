<?php
include_once '../fct/classes/Ask_res.php';
include_once '../fct/db/DataBase.php';
session_start();

if(isset($_SESSION['id_q'])){
  $id_q=$_SESSION['id_q'];
}

if(isset($_GET['id'])){
  $id_q=$_GET['id'];
  $_SESSION['id_q']=$_GET['id'];
}

$db=new DataBase();
$db->connect();

if(isset($_POST['submit'])){
  $text=$_POST['txt'];
$x=new Ask(0,"ask",$text,"-1","-1","-1","$id_q");
if($text!=null)$db->insert($x,"reponse");
}
if($id_q==null)$id_q=0;
  $qst=$db->select("question","where id=$id_q")[0];
  $var=$db->select("reponse","where idque=$id_q");
 ?>
<html>
<head>
  <title>Poser des question</title>
  <link rel="stylesheet" type="text/css" href="../css/resp.css"
</head>
<body>
    <header>
      <?php if(isset($qst->text))echo "$qst->text"; ?>
    </header>
    <?php
    if($var!=null)
      foreach ($var as $key => $value) {
        echo "<div>
          $value->text
         </div>";
      }
     ?>
    <footer>
      <form method="post" action="resp.php" id="resp">
        <input type="text" name="txt"/>
        <input type="submit" name="submit" value="ask"/>
      </form>
    </footer>
</body>
</html>
