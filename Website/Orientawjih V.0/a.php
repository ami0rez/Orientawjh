<?php
include_once 'fct/db/DataBase.php';
include 'fct/db/dbscript.php';
include 'fct/classes/Choix.php';
include_once 'fct/classes/Etablis.php';
  $s[]= new Diplome(0,"beni mellal","2");
  $a[]= new Filliere(0,"filliere");
  $x[]= new Horizon(0,"Horizon");
  $y[]= new Condition(0,12,13,12,14);
  $l[]= new Lieu(0,"bl",12,12);
  $ll=new Choix(0,"A","AAAAAAAAAAAA");
  $ll->diplomes=$s;
  $ll->lieus=$l;
  $ll->horizons=$x;
  $ll->fillieres=$a;
  $ll->conditions=$y;
  $db=new DataBase();
  $conn=$db->connect();
  $obj=new Choix(0,"ISGA KESH","istuuhsc");
  $obj->diplomes[]=$s;
  $db->insert($ll,"choix");
  #$db->insertChoix($obj);
  $r=$db->getChoices();
  echo var_dump($r);

  #echo $Condition."<br>";
  #$db->execut($Condition);
  /*function createTables(){
    #still need  to change variables
    $db->execut($Choix_horizon);
    $db->execut($Choix_horizon);
    $db->execut($Choix_horizon);
    $db->execut($Choix_horizon);
    $db->execut($Choix_horizon);
    $db->execut($Choix_horizon);
    $db->execut($Choix_horizon);
    $db->execut($Choix_horizon);
    $db->execut($Choix_horizon);
    $db->execut($Choix_horizon);
    $db->execut($Choix_horizon);
    $db->execut($Choix_horizon);
  }*/

 ?>
