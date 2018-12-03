<?php
include_once '../fct/classes/Choix.php';
include_once '../fct/db/DataBase.php';
session_start();
if(isset($_SESSION['id_admin']))$idad=$_SESSION['id_admin'];
else die("Error Connection,");
$db= new DataBase();
$db->connect();
$x=$db->select("choix","where id_ad='-1'");
if(isset($_GET["is"])){
  $idC=$_GET["id"];
  $v=$x[$idC];
  if($v!=null)
  if($_GET["is"]=="accepted"){
    $v->id_ad=$idad;
    echo var_dump($v);
    $db->update($v,"choix",$v->id);
  }elseif ($_GET["is"]=="refused") {
    $l=$v->id;
    $db->delete("choix","where id=$l");
  }
}
 ?>
<html>
<head>
  <title>Verfier les choix</title>
  <link rel="stylesheet" type="text/css" href="../css/verchoix.css"/>
  <script type="text/javascript">
  var lieu = new Array(),filliere= new Array(),horizon= new Array(),diplome= new Array(),conditions= new Array();
  function openCity(evt, cityName) {
      // Declare all variables
      var i, tabcontent, tablinks;

      // Get all elements with class="tabcontent" and hide them
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
      }

      // Get all elements with class="tablinks" and remove the class "active"
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
      }

      // Show the current tab, and add an "active" class to the button that opened the tab
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
  }
  function add_horizon(p) {
      try{
        var y="";
        if(p!=null)y=p;
        else y=document.getElementById("horizontxt").value;
        horizon.push(y);
        document.getElementById("horizon_f").value +=";"+y;
        var row=document.getElementById('thorizon').insertRow(1);
        var t=row.insertCell(0);
        t.innerHTML=y;
    }
    catch(err){
    alert(err+"eee");}
    }
  function putIn(a,b) {
    a.value=b;
  }
  function add_filliere(p) {
      try{
        var y="";
        if(p!=null)y=p;
        else y=document.getElementById("filliere_txt").value;
        filliere.push(y);
        document.getElementById("filliere_f").value +=";"+y;
        var row=document.getElementById('tfilliere').insertRow(1);
        var t=row.insertCell(0);
        t.innerHTML=y;
      }
      catch(err){
      alert(err+"eee");}
      }
  function add_lieu(a,b,c) {
        try{
          var x,y,z;
          if(a!=null){
            x=a;y=b;z=c;
          }
          else {
            var x=document.getElementById("lieu_name").value;
            var y=document.getElementById("lieu_long").value;
            var z=document.getElementById("lieu_latt").value;
          }
          var d=x+","+y+","+z;
          lieu.push(d);
          document.getElementById("lieu_f").value +=";"+d;
          var row=document.getElementById('tlieu').insertRow(1);
          var t=row.insertCell(0);
          var t2=row.insertCell(1);
          var t3=row.insertCell(2);
          t.innerHTML=x;
          t2.innerHTML=y;
          t3.innerHTML=z;
        }
        catch(err){
        alert(err+"eee");}
        }
  function add_diplome(p) {
      try{
        var y="";
        if(p!=null)y=p;
        else y=document.getElementById("diplome_txt").value;
                diplome.push(y);
                document.getElementById("diplome_f").value +=";"+y;
                var row=document.getElementById('tdiplome').insertRow(1);
                var t=row.insertCell(0);
                t.innerHTML=y;
              }
              catch(err){
              alert(err+"eee");}
              }
  </script>
</head>
<body>
  <ul>
    <?php $i=0; if($x)foreach ($x as $key => $value): ?>
      <li>
        <img src="../pics/d.jpg" />
        <h3><?php echo "$value->id : $value->name" ?></h3>
        <p><?php echo $value->desc ?>...</p>
        <a href="verify_choix.php?id=<?php echo "$i";$i++;?>">Verifier</a>
      </li>
    <?php endforeach; ?>
  </ul>
 <div id="main" class="form-style-8">
 <div class="tab">
 <button class="tablinks" onclick="openCity(event, 'General')" id="defaultOpen">Generale</button>
 <button class="tablinks" onclick="openCity(event, 'Lieu')">Lieu</button>
 <button class="tablinks" onclick="openCity(event, 'Horizon')">Horizon</button>
 <button class="tablinks" onclick="openCity(event, 'Filliere')">Filliere</button>
 <button class="tablinks" onclick="openCity(event, 'Diplome')">Diplome</button>
</div>

<div id="General" class="tabcontent">
 <h1>Generale</h1>
   Nom:<input type="text" name="nom" id="f_name" placeholder="Nom" disabled/><br>
   Desc:<input type="text" name="desc" id="f_desc" placeholder="Descr" disabled/><br>
   Age Debut: <input type="text" name="condition_age_d" id="f_aged" placeholder="Age debut"disabled/></br>
   Age Fin:<input type="text" name="condition_age_f" id="f_agef" placeholder="Age Fin" disabled/></br>
   Nombre des Places:<input type="text" v="condition_nbr_place" id="f_nbrpl"placeholder="Nombre de place" disabled/></br>
   Note Seuile:<input type="text" name="condition_note_seile" id="f_ntsel" placeholder="Note Seuile"disabled/></br>
   <input type="hidden" name="id_ad" id="lieu_f"/>
   <input type="hidden" name="horizon" id="horizon_f"/>
   <input type="hidden" name="diplome"id="diplome_f"/>
   <input type="hidden" name="filliere"id="filliere_f"/>
</div>

<!--Lieu-->

<div id="Lieu" class="tabcontent">
<h1>Lieu</h1>
<div class="contents">
  <table id="tlieu">
    <tr><th>Nom</th><th>Long</th><th>Latt</th>
</table>
</div>
<br>
</div>

<div id="Horizon" class="tabcontent">
  <h1>Horizon</h1>
<div class="contents" id="hor_con">
  <table id="thorizon">
    <tr><th>Nom</th>
  </table>
</div>
</div>


      <!--diplome-->


      <div id="Diplome" class="tabcontent">
      <h1>Diplomes</h1>
        <div class="contents">
          <table id="tdiplome">
            <tr><th>Nom</th>
          </table>
        </div>
      </div>


        <!--filliere-->


        <div id="Filliere" class="tabcontent">
          <h1>Fillieres</h1>
        <div class="contents">
          <table id="tfilliere">
            <tr><th>Nom</th>
          </table>
        </div>
      </div>
      <?php if (isset($_GET['id'])): ?>
        <button type="submit" name="acc" onclick="window.location.href = 'verify_choix.php?id=<?php echo $_GET['id']?>&is=accepted';">Accepter</button>
        <button type="submit" name="ref" onclick="window.location.href = 'verify_choix.php?id=<?php echo $_GET['id']?>&is=refused';">Refuser</button>
      <?php endif; ?>
  </div>
</body>
<?php
if(isset($_GET['id'])&&$x){
  $p=$x[$_GET['id']];
  $c=$p->conditions[0];
  echo "<script type='text/javascript'>
  putIn(f_name,'$p->name');
  putIn(f_desc,'$p->desc');
  putIn(f_aged,'$c->age_d');
  putIn(f_agef,'$c->age_f');
  putIn(f_nbrpl,'$c->nbr_places');
  putIn(f_ntsel,'$c->Note_seuile');";
  foreach ($p->lieus as $key => $value) {
    echo "add_lieu('$value->name','$value->Long','$value->Latt');";
  }
  foreach ($p->horizons as $key => $value) {
    echo "add_horizon('$value->name');";
  }
  foreach ($p->fillieres as $key => $value) {
    echo "add_filliere('$value->name');";
  }
  foreach ($p->diplomes as $key => $value) {
    echo "add_diplome('$value->nom');";
  }
  echo "</script>";
}
 ?>
<script type="text/javascript">
    document.getElementById("defaultOpen").click();
</script>
</html>
