<?php
include_once '../fct/db/Database.php';
include_once '../fct/classes/Choix.php';
include_once '../fct/classes/Etablis.php';
session_start();
if(!isset($_SESSION['id_etablis'])){
  echo "Error Connection";
  exit();
}
$db=new DataBase();
$db->connect();
$id=$_SESSION['id_etablis'];
$etablis=$db->select("etablis","where id=$id")[0];
$_SESSION['etablis']=$etablis;
$x=$db->select("choix","where id_et='$id'");
echo var_dump($x)."$id";
$ecoles=$db->select("ecole","and id_et=$id");
$concours=$db->select("concours","and id_et=$id");
$bourses=$db->select("bourse","and id_et=$id");
function fixObject (&$object)
{
  if (!is_object ($object) && gettype ($object) == 'object')
    return ($object = unserialize (serialize ($object)));
  return $object;
}

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
  <title>Comming Home to you</title>
  <link rel="stylesheet" type="text/css" href="../css/home.css"/>
</head>
<body>
  <div id="prof">
    <img src="a.jpg"/>
    <h3>Amine Zerouali</h3>
    <p>Amirez AMIREZ amirez<p>
  </div>
  <div id="do">
    <div>
  <h2>HelvetiList</h2>
  <ul>
    <li><a href="profile.php">Voire Profile</a></li>
    <li><a href="add.php?type=ecole">Ajouter Ecole</a></li>
    <li><a href="add.php?type=concours">Ajouter Concours</a></li>
    <li><a href="add.php?type=bourse">Ajouter Bourse</a></li>
    <li><a href="../multi/ask.php">Questions</a></li>
  </ul>
</div>
  </div>
  <div class="choices">
    <div class="pan">
      <button name="eco" class="b" onclick="iscrhty(this,'eco')">Ecole</button>
      <button name="con" class="b" onclick="iscrhty(this,'con')">Concours</button>
      <button name="bou" class="b" onclick="iscrhty(this,'bou')">Bourses</button>
      <button name="x" class="b" onclick="iscrhty(this,'x')">Tout</button>
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
      </ul>
    </div>
  </div>
</body>
</html>
