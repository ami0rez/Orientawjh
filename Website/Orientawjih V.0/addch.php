<?php
include_once "fct/classes/Choix.php";
include_once 'fct/db/DataBase.php';
$name=@$_POST['nom'];
$desc=@$_POST['desc'];
$lieu=slice(@$_POST['lieu'],"lieu");
$horizon=slice(@$_POST['horizon'],"horizon");
$diplome=slice(@$_POST['diplome'],"diplome");
$filliere=slice(@$_POST['filliere'],"filliere");
$condition_age_d=@$_POST['condition_age_d'];
$condition_age_f=@$_POST['condition_age_f'];
$condition_nbr_places=@$_POST['condition_nbr_place'];
$condition_note_seile=@$_POST['condition_note_seile'];
$id_ad=@$_POST['id_ad'];
$id_et=@$_POST['id_et'];
$type=@$_POST['type'];
if($id_ad=="")$id_ad=-1;
if($id_et=="")$id_et=-1;
function slice($value,$class){
  global $db;
  if($value==null){echo "$class est null"; exit;}
  $i=0;
  $a;
  $x=explode(";",$value);
  $x=array_slice($x,1,count($x)-1);
  switch (strtolower($class)) {
    case 'horizon':
          foreach ($x as $key => $value) {
          $f=$t=explode(",",$value);
          $h=new Horizon($f[0],$f[1]);
          // $h->id=$db->exist($h,"horizon");
          $a[]=$h;
          }
      break;
    case 'diplome':
            foreach ($x as $key => $value) {
              $f=$t=explode(",",$value);
              $h=new Diplome($f[0],$f[1],2);
              // $h->id=$db->exist($h,"diplome");
              $a[]=$h;
            }
        break;
    case 'filliere':
              foreach ($x as $key => $value) {
                $f=$t=explode(",",$value);
                $h=new Filliere($f[0],$f[1]);
                // $h->id=$db->exist($h,"filliere");
                $a[]=$h;
              }
          break;
    case 'lieu':
                  foreach ($x as $key => $value) {
                    $t=explode(",",$value);
                    $h=new Lieu($t[0],$t[1],$t[2],$t[3]);
                    // $h->id=$db->exist($h,"lieu");
                    $a[]=$h;
                  }
            break;
    default:
      # code...
      break;
  }
  #echo var_dump($a);
  return $a;
}
$db=new DataBase();
$db->connect();
$choix=new Choix(0,$name,$desc);
$choix->horizons=$horizon;
$choix->id_ad=$id_ad;
$choix->id_et=$id_et;
$choix->fillieres=$filliere;
$choix->conditions[]=new Condition(0,$condition_age_d,$condition_age_f$condition_note_seile,,$condition_nbr_places);
$choix->diplomes=$diplome;
$choix->lieus=$lieu;
switch ($type) {
  case 'ecole':
       if($db->insert($choix,"ecole")==1){
         header("location:admin/home.php");
       }
       else{
        echo "error insertion ";
      }
    break;
    case 'bourse':
         if($db->insert($choix,"bourse")==1){
           header("location:admin/home.php");
         }
         else{
          echo "error insertion ";
        }
    break;
    case 'concours':
          if($db->insert($choix,"concours")==1){
             header("location:admin/home.php");
          }
          else{
            echo "error insertion ";
          }
        break;
}

?>
