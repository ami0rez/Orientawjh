<?php
include_once '../fct/db/Database.php';
include_once '../fct/classes/Choix.php';
include_once '../fct/classes/Admin.php';
session_start();
if(!isset($_SESSION['id_admin'])){
  echo "Error Connection";
  exit();
}
$db=new DataBase();
$db->connect();
$id=$_SESSION['id_admin'];
$admin=$db->select("admin","where id=$id")[0];
$_SESSION['admin']=$admin;
$x=$db->select("choix","where id_ad='$id'");
$added=$db->select("choix","where id_ad = $id and id_et = '-1'");
$verified=$db->select("choix","where id_ad= $id and id_et <> '-1'");

$ecoles=$db->select("ecole","and id_ad=$id");
$concours=$db->select("concours","and id_ad=$id");
$bourses=$db->select("bourse","and id_ad=$id");
?>
<script>
function iscrhty(evt,name) {
  var x=document.getElementsByClassName('cho')[0].getElementsByTagName('li');
  var buttons=document.getElementsByClassName('pan')[0].getElementsByTagName('button');
  var t=document.getElementsByClassName("li"+name);
  var i;
  for (i = 0; i < buttons.length; i++) {
    buttons[i].style.backgroundColor="inherit";
  }
  evt.style.backgroundColor="red"
  for(i=0; i<x.length;i++) {
      x[i].style.display= "none";
  }
  for(i=0; i<t.length;i++) {
      t[i].style.display= "block";
  }
}
</script>
<html>
<head>
  <title>Head</title>
  <link rel="stylesheet" type="text/css" href="../css/home.css"/>
</head>
<body>
  <div id="prof">
    <img src="a.jpg"/>
    <h3><?php echo "$admin->name $admin->name"; ?></h3>
    <p>Amirez AMIREZ amirez<p>
  </div>
  <div id="do">
    <div>
  <h2>HelvetiList</h2>
  <ul>
    <li><a href="profile.php">Voire Profile</a></li>
    <li><a href="add_admin.php">Ajouter Admin</a></li>
    <li><a href="add.php?type=ecole">Ajouter Ecole</a></li>
    <li><a href="add.php?type=concours">Ajouter Concours</a></li>
    <li><a href="add.php?type=bourse">Ajouter Bourse</a></li>
    <li><a href="../multi/ask.php">Questions</a></li>
    <li><a href="verify_choix.php">Verifier les Choix</a></li>
  </ul>
</div>
  </div>
  <div class="choices">
    <div class="pan">
      <button name="eco" class="b" onclick="iscrhty(this,'eco')">Ecole</button>
      <button name="con" class="b" onclick="iscrhty(this,'con')">Concours</button>
      <button name="bou" class="b" onclick="iscrhty(this,'bou')">Bourses</button>
      <button name="x" class="b" onclick="iscrhty(this,'x')">Tout</button>
      <button name="add" class="b" onclick="iscrhty(this,'add')">Ajouté</button>
      <button name="ver" class="b" onclick="iscrhty(this,'ver')">Verifié</button>
    </div>
    <div class="connect">
      <ul class="cho">

        <!--Ecole-->

        <?php $i=0; if($ecoles)foreach ($ecoles as $key => $value): ?>
          <li class="lieco">
            <img src="../pics/d.jpg" />
            <h3><?php echo "$value->name" ?></h3>
            <p><?php echo $value->desc ?>...</p>
            <a href="../multi/affichChoix.php?idC=<?php echo $x[$i]->id;$i++;?>">Verifier</a>
          </li>
        <?php endforeach; ?>

        <!--Concours-->

        <?php $i=0; if($concours)foreach ($concours as $key => $value): ?>
          <li class="licon">
            <img src="../pics/d.jpg" />
            <h3><?php echo $value->name?></h3>
            <p><?php echo $value->desc?>...</p>
            <a href="../multi/affichChoix.php?idC=<?php echo $x[$i]->id;$i++;?>">Verifier</a>
          </li>
        <?php endforeach; ?>

        <!--Bourse-->

        <?php $i=0; if($bourses)foreach ($bourses as $key => $value): ?>
          <li class="libou">
            <img src="../pics/d.jpg" />
            <h3><?php echo "$value->name" ?></h3>
            <p><?php echo $value->desc ?>...</p>
            <a href="../multi/affichChoix.php?idC=<?php echo $x[$i]->id;$i++;?>">Verifier</a>
          </li>
        <?php endforeach; ?>

        <!--Tout-->

        <?php $i=0; if($x)foreach ($x as $key => $value): ?>
          <li class="lix">
            <img src="../pics/d.jpg" />
            <h3><?php echo "$value->name" ?></h3>
            <p><?php echo $value->desc ?>...</p>
            <a href="../multi/affichChoix.php?idC=<?php echo $x[$i]->id;$i++;?>">Verifier</a>
          </li>
        <?php endforeach; ?>

        <!--Ajoutée-->

        <?php $i=0; if($added)foreach ($added as $key => $value): ?>
          <li class="liadd">
            <img src="../pics/d.jpg" />
            <h3><?php echo "$value->name" ?></h3>
            <p><?php echo $value->desc ?>...</p>
            <a href="../multi/affichChoix.php?idC=<?php echo $x[$i]->id;$i++;?>">Verifier</a>
          </li>
        <?php endforeach; ?>

        <!--Verifiée-->

        <?php $i=0; if($verified)foreach ($verified as $key => $value): ?>
          <li class="liver">
            <img src="../pics/d.jpg" />
            <h3><?php echo "$value->name" ?></h3>
            <p><?php echo $value->desc ?>...</p>
            <a href="../multi/affichChoix.php?idC=<?php echo $x[$i]->id;$i++;?>">Verifier</a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</body>
</html>
