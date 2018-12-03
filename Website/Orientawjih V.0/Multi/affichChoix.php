<?php
include_once '../fct/classes/Choix.php';
include_once '../fct/db/DataBase.php';
session_start();
$db= new DataBase();
$db->connect();
if(isset($_SESSION['id_admin']))$idad=$_SESSION['id_admin'];
if(isset($_SESSION['id_etablis']))$idet=$_SESSION['id_etablis'];

if(isset($_GET['idC']))$idC=$_GET['idC'];
else die("Aucun Chix est Specifiee");
$x=$db->select("choix","where id=$idC");
if(isset($_GET['is'])) {
  if($_GET['is']=="retest")$db->retest($idC);
}
 ?>
<html>
<head>
  <title>Verfier les choix</title>
  <link rel="stylesheet" type="text/css" href="../css/choix.css"/>
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
  function add_horizon(p,id) {
      try{
        var y="",z="";
        if(p!=null)y=p;
        else y=document.getElementById("horizontxt").value;
        if(id==null){
          id=-1;
        }
        z=id+","+y;
        // alert(y);
        horizon.push(z);
        document.getElementById("horizon_f").value +=";"+z;
        var row=document.getElementById('thorizon').insertRow(1);
        var t=row.insertCell(0);
        var t2=row.insertCell(1);
        t.innerHTML=y;
        var btn = document.createElement('button');
        btn.type = "button";
        btn.className = "btn";
        btn.innerHTML = "x";
        btn.onclick = function(){ remove('horizon',z); }
        t2.appendChild(btn);
        // t4.innerHTML="X";
        t2.className="x";
    }
    catch(err){
    alert(err+"eee");}
    }
  function putIn(a,b) {
    var c=document.getElementById(a);
    a.value=b;
  }
  function add_filliere(p,id) {
      try{
        var y="",z;
        if(p!=null)y=p;
        else y=document.getElementById("filliere_txt").value;
        if(id==null){
          id=-1;
        }
        z=id+","+y;
        // alert(y);
        filliere.push(z);
        document.getElementById("filliere_f").value +=";"+z;
        var row=document.getElementById('tfilliere').insertRow(1);
        var t=row.insertCell(0);
        var t2=row.insertCell(1);
        t.innerHTML=y;
        var btn = document.createElement('button');
        btn.type = "button";
        btn.className = "btn";
        btn.innerHTML = "x";
        btn.onclick = function(){ remove('filliere',z); }
        t2.appendChild(btn);
        // t4.innerHTML="X";
        t2.className="x";
        // t4.onclick=remove('tlieu',d);
      }
      catch(err){
      alert(err+"eee");}
      }
  function add_lieu(a,b,c,id) {
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
          if(id==null){
            id=-1;
          }
          var d=id+","+x+","+y+","+z;
          // alert(d);
          lieu.push(d);
          document.getElementById("lieu_f").value +=";"+d;
          var row=document.getElementById('tlieu').insertRow(1);
          var t=row.insertCell(0);
          var t2=row.insertCell(1);
          var t3=row.insertCell(2);
          var t4=row.insertCell(3);
          t.innerHTML=x;
          t2.innerHTML=y;
          t3.innerHTML=z;
          var btn = document.createElement('button');
          btn.type = "button";
          btn.className = "btn";
          btn.innerHTML = "x";
          btn.onclick = function(){ remove('lieu',d); }
          t4.appendChild(btn);
          // t4.innerHTML="X";
          t4.className="x";
          // t4.onclick=remove('tlieu',d);
        }
        catch(err){
        alert(err+"eee");}
        }
  function add_diplome(p,id) {
      try{
        var y="",z="";
        if(p!=null)y=p;
        else y=document.getElementById("diplome_txt").value;
        if(id==null){
          id=-1;
        }
        z=id+","+y;
        // alert(y);
                diplome.push(z);
                document.getElementById("diplome_f").value +=";"+z;
                var row=document.getElementById('tdiplome').insertRow(1);
                var t=row.insertCell(0);
                var t2=row.insertCell(1);
                t.innerHTML=y;
                var btn = document.createElement('button');
                btn.type = "button";
                btn.className = "btn";
                btn.innerHTML = "x";
                btn.onclick = function(){ remove('diplome',z); }
                t2.appendChild(btn);
                // t4.innerHTML="X";
                t2.className="x";
                // t4.onclick=remove('tlieu',d);
              }
              catch(err){
              alert(err+"eee");}
              }
  function remove(a,b) {
      var tbl=document.getElementById("t"+a);
      var pos=lieu.indexOf(b);
      switch (a) {
        case "lieu":
        pos=lieu.indexOf(b);
        lieu.splice(pos,1);
        lieu.unshift("");
        document.getElementById(a+"_f").value=lieu.join(";");
          break;
        case "diplome":
          pos=diplome.indexOf(b);
          diplome.splice(pos,1);
          diplome.unshift("");
          document.getElementById(a+"_f").value=diplome.join(";");
            break;
        case "horizon":
          pos=horizon.indexOf(b);
          horizon.splice(pos,1);
          horizon.unshift("");
          document.getElementById(a+"_f").value=horizon.join(";");
          break;
        case "filliere":
          pos=filliere.indexOf(b);
          filliere.splice(pos,1);
          filliere.unshift("");
          document.getElementById(a+"_f").value=filliere.join(";");
          break;
        default:

      }
      tbl.deleteRow(pos+1);
    }
  </script>
</head>
<body>
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
 <form name="myForm" method="post" action="<?php echo (isset($idad)?'affichChoix.php':'update.php');?>" onsubmit="return validateForm()">
   <input type="text" class="general" name="nom" id="f_name" placeholder="Nom" /><br>
   <input type="text" class="general" name="desc" id="f_desc" placeholder="Descr"/><br>
   <input type="text" class="general" name="condition_age_d" id="f_aged" placeholder="Age debut"/></br>
   <input type="text" class="general" name="condition_age_f" id="f_agef" placeholder="Age Fin" /></br>
   <input type="text" class="general" name="condition_nbr_place" id="f_nbrpl"placeholder="Nombre de place" /></br>
   <input type="text" class="general" name="condition_note_seile" id="f_ntsel" placeholder="Note Seuile"/></br>
   <input type="hidden" name="lieu" id="lieu_f"/>
   <input type="hidden" name="horizon" id="horizon_f"/>
   <input type="hidden" name="diplome"id="diplome_f"/>
   <input type="hidden" name="filliere"id="filliere_f"/>
   <input type="hidden" name="id" id="f_id"/>
   <input type="hidden" name="idCon" id="f_idCon"/>
   <input type="hidden" name="ideta" id="f_ideta"/>
   <input type="hidden" name="idadm" id="f_idadm"/>
</div>

<!--Lieu-->

<div id="Lieu" class="tabcontent">
<h1>Lieu</h1>
<div class="panel">
<input type="text" id="lieu_name" placeholder="Nom">
<input type="text" id="lieu_long" placeholder="Long">
<input type="text" id="lieu_latt" placeholder="latt">
<button type="button" onclick="add_lieu()">+</button>
</div>
<div class="contents">
 <table id="tlieu">
   <tr><th>Nom</th><th>Long</th><th>Latt</th><th>supp</th>
</table>
</div>
<br>
</div>

<div id="Horizon" class="tabcontent">
 <h1>Horizon</h1>
 <div class="panel">
 <input type="text" id="horizontxt" placeholder="Nom">
 <button type="button" onclick="add_horizon()">+</button>
</div>
<div class="contents" id="hor_con">
 <table id="thorizon">
   <tr><th>Nom</th><th>supp</th>
 </table>
</div>
</div>


     <!--diplome-->


     <div id="Diplome" class="tabcontent">
     <h1>Diplomes</h1>
     <div class="panel">
     <input type="text" id="diplome_txt" placeholder="Nom">
     <button type="button" onclick="add_diplome()">+</button>
   </div>
       <div class="contents">
         <table id="tdiplome">
           <tr><th>Nom</th><th>supp</th>
         </table>
       </div>
     </div>


       <!--filliere-->


       <div id="Filliere" class="tabcontent">
         <h1>Fillieres</h1>
         <div class="panel">
         <input type="text" id="filliere_txt" placeholder="Nom">
         <button type="button" onclick="add_filliere()"> +</button>
       </div>
       <div class="contents">
         <table id="tfilliere">
           <tr><th>Nom</th><th>supp</th>
         </table>
       </div>
     </div>
     <?php if(isset($idad)): ?>
       <button type="button" name="acc" onclick="window.location.href = 'affichChoix.php?idC=<?php echo $_GET['idC']?>&is=retest';">ReTester</button>
     <?php endif; ?>
     <?php if(isset($idet)): ?>
       <input type="submit" name="update" value="Mise A jours"/>
     <?php endif; ?>
</form>
  </div>
</body>
<?php

if(isset($x)){
  $p=$x[0];
  $c=$p->conditions[0];
  echo "<script type='text/javascript'>
  putIn(f_name,'$p->name');
  putIn(f_desc,'$p->desc');
  putIn(f_aged,'$c->age_d');
  putIn(f_agef,'$c->age_f');
  putIn(f_nbrpl,'$c->nbr_places');
  putIn(f_id,'$p->id');
  putIn(f_idCon,'$c->id');
  putIn(f_ntsel,'$c->Note_seuile');";
  if(isset($idad)) echo "putIn(f_idadm,'$idad');";
  if(isset($idet)) echo "putIn(f_ideta,'$idet');";
  foreach ($p->lieus as $key => $value) {
    echo "add_lieu('$value->name','$value->Long','$value->Latt','$value->id');";
  }
  foreach ($p->horizons as $key => $value) {
    echo "add_horizon('$value->name','$value->id');";
  }
  foreach ($p->fillieres as $key => $value) {
    echo "add_filliere('$value->name','$value->id');";
  }
  foreach ($p->diplomes as $key => $value) {
    echo "add_diplome('$value->nom','$value->id');";
  }
  echo "</script>";
}
 ?>
<script type="text/javascript">
    document.getElementById("defaultOpen").click();
</script>
</html>
