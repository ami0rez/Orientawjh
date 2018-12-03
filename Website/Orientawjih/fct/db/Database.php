<?php
class DataBase{
  public $servername = "localhost";
  public $username = "root";
  public $password = "";
  public $conn;
  public function  connect(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    global $conn;
    // Create connection
    $conn = new mysqli($servername, $username, $password,"ot");
    // Check connection
    if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);
    #$GLOBALS['conn']=$conn;
    return $conn;
  }
  public function  execut($query){
    global $conn;
    if($conn==null)echo "string";
    $result=$conn->query($query);
    if($result==null) echo $conn->error;
  }

  public function  selectScalar($query){
    global $conn;
    $result=$conn->query($query);
    if($result==null) echo $conn->error."<br>".$query;
    if($result->num_rows>0){
    $row=$result->fetch_row();
    $count=$row[0];
    return $count;
  }}
  public function  select($table,$cond=""){
       $lst=null;
       global $conn;
     if($table!="ecole" &&$table!="bourse" && $table!="concours"){ $result=$conn->query("select * from $table $cond "); /*echo "select * from $table $cond";*/}
     else{ $result=$conn->query("select * from $table");/*echo "select * from $table";*/}
       if(!$result)echo "$conn->error"."<br>"."select * from $table $cond<hr>";
       if($result->num_rows > 0){
       switch (strtolower($table))
       {
           case "filliere":
                while($row = $result->fetch_assoc()){
                  $lst[]=new Fillere($row['id'],$row['name']);
                }
                return $lst;
           case "horizon":
               while($row = $result->fetch_assoc()){
                $lst[]=new Horizon($row['id'],$row['name']);
              }
              return $lst;
           case "lieu":
              while($row = $result->fetch_assoc()){
                $lst[]=new Lieu($row['id'],$row['name'],$row['lng'],$row['latt']);
              }
              return $lst;
           case "condition":
              while($row = $result->fetch_assoc()){
                $lst[]=new Condition($row['id'],$row['age_d'],$row['age_f'],$row['not_seuile'],$row['nbr_place']);
              }
              return $lst;
           case "diplome":
              while($row = $result->fetch_assoc()){
                $lst[]=new Fillere($row['id'],$row['name'],$row['duree']);
              }
            case "question":
              while($row = $result->fetch_assoc()){
                  $t=new Ask($row['id'],"ask",$row['text'],$row['idadm'],$row['ideta'],$row['idetu'],"-1");
                  $t->id=$row['id'];
                  $lst[]=$t;
              }
            case "reponse":
              while($row = $result->fetch_assoc()){
                $t=new  Ask($row['id'],"ask",$row['text'],$row['idadm'],$row['ideta'],$row['idetu'],$row['idque']);
                $t->id=$row['id'];
                $lst[]=$t;
              }
           return $lst;
           case "choix":
           return $this->getChoices("",$cond);
           case "ecole":
           return $this->getChoices("ecole",$cond);
           case "bourse":
           return $this->getChoices("bourse",$cond);
           case "concours":
           return $this->getChoices("concours",$cond);
           case "etudiant":
           return $this->getChoices("etudiant",$cond);
           case "admin":
           while($row = $result->fetch_assoc()){
             $t=new  Admin($row['name'],$row['prename'],$row['E_mail'],$row['Password'],$row['Date_naisc'],$row['Adress'],$row['img']);
             $t->id=$row['id'];
             $lst[]=$t;
           }
           case "etablis":
           while($row = $result->fetch_assoc()){
             $t=new  Etablis($row['name'],$row['prename'],$row['E_mail'],$row['Password'],$row['Date_naisc'],$row['Tel'],$row['img']);
             $t->id=$row['id'];
             $lst[]=$t;
           }
       }
     }
       return $lst;
   }
  public function  getChoices($table="",$cond=""){
        global $conn;
        $arr;
        $do=false;
        if($table=="")$result=$conn->query("select * from choix $cond");
        else$result=$conn->query("select * from choix where id in (select id from $table) $cond");
        if(!$result)echo "$conn->error"."select * from choix where $cond<br>";
         while($row = $result->fetch_assoc()){
            $x=new Choix($row["id"],$row["name"],$row["descr"]);
            $x->id_ad=$row["id_ad"];
            $x->id_et=$row["id_et"];
            $rs=$conn->query("select * from Conditions where id in(select id_con from choix_condition where id_ch=$x->id)");
            if($rs!=null && $rs->num_rows>0)
                while ($row = $rs->fetch_assoc()) {
                    $x->conditions[]=new Condition($row["id"],$row["aged"],$row["agef"],$row["notseuil"],$row["nbrplace"]);
                }
            $rs=$conn->query("select * from diplome where id in(select id_dip from choix_diplome where id_ch=$x->id)");
            if($rs->num_rows>0)
                while ($row = $rs->fetch_assoc()) {
                    $x->diplomes[]=new Diplome($row["id"],$row["name"],$row["duree"]);
                }
            $rs=$conn->query("select * from filliere where id in(select id_fil from choix_filliere where id_ch=$x->id)");
            if($rs->num_rows>0)
                while ($row = $rs->fetch_assoc()) {
                    $x->fillieres[]=new Filliere($row["id"],$row["name"]);
                }
            $rs=$conn->query("select * from horizon where id in(select id_hor from choix_horizon where id_ch=$x->id)");
            if($rs->num_rows>0)
                while ($row = $rs->fetch_assoc()) {
                    $x->horizons[]=new Horizon($row["id"],$row["name"]);
                }
            $rs=$conn->query("select * from lieu where id in(select id_li from choix_lieu where id_ch=$x->id)");
            if($rs->num_rows>0)
                while ($row = $rs->fetch_assoc()) {
                    $x->lieus[]=new Lieu($row["id"],$row["name"],$row["lng"],$row["latt"]);
                }
            $arr[]=$x;
            $do=true;
        }
        if($do)return $arr;
        else return array();
    }

  public function  insert($obj,$table){
    global $conn;
    switch (strtolower($table))
        {
            case "bourse":
            $this->insertChoix($obj);
            $i=$this->selectScalar("select max(id) from choix");
            $res=$conn->query("insert into bourse values($i)");
            if($res==null) echo $conn->error;
                return 1;
            case "concour":
            $this->insertChoix($obj);
            $i=$this->selectScalar("select max(id) from choix");
            $res=$conn->query("insert into concour values($i)");
            if($res==null) echo $conn->error;
                return 1;
            case "ecole":
            $this->insertChoix($obj);
            $i=$this->selectScalar("select max(id) from choix");
            $res=$conn->query("insert into ecole values($i)");
            if($res==null) echo $conn->error;
                return 1;
            case "choix":
            $this->insertChoix($obj);
                return 1;
                ///
            case "lieu":
            $res=$conn->query("insert into lieu(name,lng,latt) values('$obj->name','$obj->Long','$obj->Latt')");
            if($res==null) echo $conn->error;
                return 1;
                ///
            case "horizon":
            $res=$conn->query("insert into horizon(name) values('$obj->name')");
            if($res==null) echo $conn->error;
                return 1;
                ///
            case "filliere":
            $res=$conn->query("insert into filliere(name) values('$obj->name')");
            if($res==null) echo $conn->error;
                return 1;
                ///
            case "condition":
            $res=$conn->query("insert into conditions(aged,agef,notseuil,nbrplace) values('$obj->age_d','$obj->age_f','$obj->Note_seuile','$obj->nbr_places')");
            if($res==null) echo $conn->error;
                return 1;
                ///
            case "diplome":
            $res=$conn->query("insert into diplome(name,duree) values('$obj->nom','$obj->duree')");
            if($res==null) echo $conn->error;
                return 1;
            case "admin":
            $res=$conn->query("insert into admin(name,prename,E_mail,Password,Date_naisc,Adress,img) values('$obj->name','$obj->prename','$obj->email',
                                                                                                        '$obj->password','$obj->date_naisc','$obj->adress','$obj->img')");
            if($res==null) echo $conn->error;
            return 1;
            case "etablis":
            $res=$conn->query("insert into etablis(name,prename,E_mail,Password,Date_naisc,Tel,img) values('$obj->name','$obj->prename','$obj->email',
                                                                                                        '$obj->password','$obj->date_naisc','$obj->tel','$obj->img')");
            if($res==null) echo $conn->error;
                return 1;
            case "etudiant":
            $res=$conn->query("insert into etudiant(name,prename,E_mail,Password,Adress) values('$obj->name','$obj->prename','$obj->email',
                                                                                                        '$obj->password','$obj->adress')");
            if($res==null) echo $conn->error;
                return 1;
            case "question":
            $res=$conn->query("insert into question(text,idadm,ideta,idetu) values('$obj->text','$obj->idadm','$obj->ideta','$obj->idetu')");
            if($res==null) echo $conn->error;
            return 1;
            case "reponse":
            $res=$conn->query("insert into reponse(text,idadm,ideta,idetu,idque) values('$obj->text','$obj->idadm','$obj->ideta','$obj->idetu','$obj->idque')");
            if($res==null) echo $conn->error;
            return 1;
        }
        return 0;
    }
  public function  exist($obj,$table){
      $count=0;
      global $conn;
      switch (strtolower($table))
      {
          case "lieu":
              $query="select id from lieu where name='$obj->name ' and lng=' $obj->Long' And latt='$obj->Latt'";
              $result=$conn->query($query);
              if($result==null) echo $conn->error;
              if($result->num_rows>0){
              $row=$result->fetch_assoc();
              $count=$row['id'];
              return $count;
            }
              break;
          case "filliere":
              $query="select id from filliere where name='$obj->name'";
              $result=$conn->query($query);
              if($result==null) echo $conn->error;
              if($result->num_rows>0){
              $row=$result->fetch_assoc();
              $count=$row['id'];
              return $count;
              }
              break;
          case "diplome":
              $query="select id from diplome where name='$obj->nom' and duree='$obj->duree'";
              $result=$conn->query($query);
              if($result==null) echo $conn->error;
              if($result->num_rows>0){
              $row=$result->fetch_assoc();
              $count=$row['id'];
              return $count;
              }
              break;
          case "horizon":
              $query="select id from horizon where name='$obj->name'";
              $result=$conn->query($query);
              if($result==null) echo $conn->error;
              if($result->num_rows>0){
              $row=$result->fetch_assoc();
              $count=$row['id'];
              return $count;
              }
              break;
          case "condition":
              $query="select id from Conditions where aged='$obj->age_d' and agef='$obj->age_f'And notseuil='$obj->Note_seuile'";
              $result=$conn->query($query);
              if($result==null) echo $conn->error;
              if($result->num_rows>0){
              $row=$result->fetch_assoc();
              $count=$row['id'];
              return $count;
              }
              break;
              case "etablis":
                  $query="select id from etablis where E_mail='$obj->email' and password='$obj->password'";
                  $result=$conn->query($query);
                  if($result==null) echo $conn->error;
                  if($result->num_rows>0){
                  $row=$result->fetch_assoc();
                  $count=$row['id'];
                  return $count;
                  }
              break;
              case "etudiant":
                  $query="select id from etudiant where E_mail='$obj->email' and password='$obj->password'";
                  $result=$conn->query($query);
                  if($result==null) echo $conn->error;
                  if($result->num_rows>0){
                  $row=$result->fetch_assoc();
                  $count=$row['id'];
                  return $count;
                  }
              break;
              default: return  -1;
      }
      return  -1;
  }
  public function  insertChoix($obj){
        global $conn;
        $lieu;
        $diplome;$filliere;$condition;$horizon;
        $conn->query("insert into Choix(name,descr,id_ad,id_et,dte) values('$obj->name','$obj->desc','$obj->id_ad','$obj->id_et',CURDATE())");
        echo "$conn->error";
        if(is_array($obj->lieus))
        foreach($obj->lieus as $key=>$l){
            if($this->exist($l,"lieu")==-1){
                $this->insert($l,"lieu");
                $lieu[]=$this->selectScalar("select max(id) from lieu");
            }
            else $lieu[]=$this->exist($l,"lieu");
        }
        if(is_array($obj->diplomes))
        foreach($obj->diplomes as $key=>$l){
            if($this->exist($l,"diplome")==-1){
                $this->insert($l,"diplome");
                $diplome[]=$this->selectScalar("select max(id) from diplome");
            }
            else $diplome[]=$this->exist($l,"diplome");
        }
        if(is_array($obj->horizons))
        foreach($obj->horizons as $key=>$l){
            if($this->exist($l,"horizon")==-1){
                $this->insert($l,"horizon");
                $horizon[]=$this->selectScalar("select max(id) from horizon");
            }
            else $horizon[]=$this->exist($l,"horizon");
        }
        if(is_array($obj->conditions))
        foreach($obj->conditions as $key=>$l){
            if($this->exist($l,"condition")==-1){
                $this->insert($l,"condition");
                $condition[]=$this->selectScalar("select max(id) from conditions");
            }
            else $condition[]=$this->exist($l,"condition");
        }
        if(is_array($obj->fillieres))
        foreach($obj->fillieres as $key=>$l){
            if($this->exist($l,"filliere")==-1){
                $this->insert($l,"filliere");
                $filliere[]=$this->selectScalar("select max(id) from filliere");
            }
            else $filliere[]=$this->exist($l,"filliere");
        }
        $a=$this->selectScalar("select max(id) from choix");
        echo "<hr>";
        if(isset($lieu) && is_array($lieu))
        $this->choix_lieu($a,$lieu);
        if(isset($condition) && is_array($condition))
        $this->choix_condition($a,$condition);
        if(isset($diplome) && is_array($diplome))
        $this->choix_diplome($a,$diplome);
        if(isset($filliere) && is_array($filliere))
        $this->choix_filliere($a,$filliere);
        if(isset($horizon) && is_array($horizon))
        $this->choix_horizone($a,$horizon);
    }

  public function  choix_lieu($id_c,$id_l){
      global $conn;
        foreach($id_l as $key=> $x)
        {
            $conn->query("insert into choix_lieu values($x,$id_c)");
            echo $conn->error;
        }
    }
  public function  choix_condition($id_c,$id_l){
      global $conn;
        foreach($id_l as $key=> $x)
        {
            $conn->query("insert into choix_condition values($x,$id_c)");
        }
    }
  public function  choix_diplome($id_c,$id_l){
      global $conn;
        foreach( $id_l as $key=> $x)
        {
            $conn->query("insert into choix_diplome values($x,$id_c)");
        }
    }
  public function  choix_filliere($id_c,$id_l){
      global $conn;
        foreach($id_l as $key=> $x)
        {
            $conn->query("insert into choix_filliere values($x,$id_c)");
            echo $conn->error;
        }
    }
  public function  choix_horizone($id_c,$id_l){
      global $conn;
        foreach($id_l as $key=> $x)
        {
            $conn->query("insert into choix_horizon values($x,$id_c)");
        }
    }

  public function  delete($table,$cond=""){
       global $conn;
       $result=$conn->query("delete from $table $cond");
       if($result==null)echo $conn->error;
   }

  public function  update($obj,$table,$id){
     global $conn;
    //  if(is_array($obj))$obj=$obj[0];
    // echo var_dump($obj);
    //  echo $obj->id_ad."<hr>";
     switch (strtolower($table))
         {
             case "choix":
            //  $res=$conn->query("update choix set name='$obj->name', descr='$obj->desc', id_ad='$obj->id_ad', id_et='$obj->id_et' where id=$id");
            //  if($res==null) echo $conn->error;
            $this->updateChoix($obj,$id);
            return 1;
                 ///
             case "lieu":
             $res=$conn->query("update lieu set name='$obj->name', lng='$obj->Long', latt='$obj->Latt' where id=$id");
             if($res==null) echo $conn->error;
                 return 1;
                 ///
             case "horizon":
             $res=$conn->query("update horizon set name='$obj->name' where id=$id");
             if($res==null) echo $conn->error;
                 return 1;
                 ///
             case "filliere":
             $res=$conn->query("update horizon set name='$obj->name' where id=$id");
             if($res==null) echo $conn->error;
                 return 1;
                 ///
             case "condition":
             $res=$conn->query("update conditions set aged='$obj->age_d',agef='$obj->age_f',notseuil='$obj->Note_seuile',nbrplace='$obj->nbr_places' where id=$id");
             if($res==null) echo $conn->error;
                 return 1;
                 ///
             case "diplome":
             $res=$conn->query("update horizon set name='$obj->nom',duree='$obj->duree' where id=$id");
             if($res==null) echo $conn->error;
                 return 1;
             case "admin":
             $res=$conn->query("update admin set name='$obj->name' , prename='$obj->prename' , E_mail='$obj->email' , Password='$obj->password' , Date_naisc='$obj->date_naisc' , Adress='$obj->adress' , img='$obj->img' where id='$obj->id'");
             if($res==null) echo $conn->error."<br>update admin set name='$obj->name',prename='$obj->prename',E_mail='$obj->email',Password='$obj->password',Date_naisc='$obj->date_naisc',Adress='$obj->adress',img='$obj->img' where id='$obj->id'";
             return 1;
             case "etablis":
             $res=$conn->query("update etablis set name='$obj->name',prename='$obj->prename',E_mail='$obj->email',Password='$obj->password',Date_naisc='$obj->date_naisc',Tel='$obj->tel',img='$obj->img' where id=$id");
             if($res==null) echo $conn->error;
                 return 1;
             case "etudiant":
             $res=$conn->query("update etudiant name='$obj->name',prename='$obj->prename',E_mail='$obj->email',Password='$obj->password',Adress='$obj->adress' where id=$id");
             if($res==null) echo $conn->error;
                 return 1;
             case "question":
             $res=$conn->query("update question text='$obj->text',idadm='$obj->idadm',ideta='$obj->ideta',idetu='$obj->idetu'  where id=$id");
             if($res==null) echo $conn->error;
             return 1;
             case "reponse":
             $res=$conn->query("update reponse text='$obj->text',idadm='$obj->idadm',ideta='$obj->ideta',idetu='$obj->idetu',idque='$obj->idque' where id=$id");
             if($res==null) echo $conn->error;
             return 1;
         }
         return 0;
     }
  public function  updateChoix($obj,$id) {
    global $conn;
    $res=$conn->query("update choix set name='$obj->name', descr='$obj->desc', id_ad='$obj->id_ad', id_et='$obj->id_et' where id=$id");
    if($res==null) echo $conn->error."<br>update choix set name='$obj->name', descr='$obj->desc', id_ad='$obj->id_ad', id_et='$obj->id_et' where id=$id";
    if(is_array($obj->lieus))
    foreach($obj->lieus as $key=>$l){
      if($this->hasConnection("lieu",$l->id)) {
        if($this->exist($l,"lieu")==-1){
            $this->insert($l,"lieu");
            $id_l=$this->selectScalar("select max(id) from lieu");
        }
        else $id_l=$this->exist($l,"lieu");
        $this->updateConnection("lieu",$obj->id,$id_l,$l->id);
      }
      else{
        if($l->id!=-1){
        $result=$conn->query("update lieu set name='$l->name',lng='$l->Long',latt='$l->Latt' where id='$l->id'");
        if($result==null)echo "$conn->error";}
        else{
          $this->insert($l,"lieu");
          $id_c[]=$this->selectScalar("select max(id) from lieu");
          $this->choix_lieu($id,$id_c);
        }
      }
    }




    if(is_array($obj->diplomes))
    foreach($obj->diplomes as $key=>$l){
      if($this->hasConnection("diplome",$l->id)) {
        if($this->exist($l,"diplome")==-1){
            $this->insert($l,"diplome");
            $id_d=$this->selectScalar("select max(id) from diplome");
        }
        else $id_d=$this->exist($l,"diplome");
        $this->updateConnection("diplome",$obj->id,$id_d,$l->id);
      }
      else{
        if($l->id!=-1){
        $result=$conn->query("update diplome set name='$l->nom',duree='$l->duree' where id='$l->id'");
        if($result==null)echo "$conn->error";
      }else{
        $this->insert($l,"diplome");
        $id_c[]=$this->selectScalar("select max(id) from diplome");
        $this->choix_diplome($id,$id_c);
      }
      }
    }



    if(is_array($obj->horizons))
    foreach($obj->horizons as $key=>$l){
      // echo var_dump($l);
      if($this->changed($l,"horizon")){
        // echo "horizon changed <br>";
      if($this->hasConnection("diplome",$l->id)) {
        // echo "horizon has connection <br>";
        if($this->exist($l,"horizon")==-1){
          // echo "horizon not exist<br>";
            $this->insert($l,"horizon");
            // echo "horizon inserted <br>";
            $id_h=$this->selectScalar("select max(id) from horizon");
        }
        else $id_h=$this->exist($l,"horizon");
        // echo "horizon exist <br>";
        $this->updateConnection("horizon",$obj->id,$id_h,$l->id);
        // echo "horizon connection changed <br>";
      }
      else{
        // echo "horizon has no connection <br>";
        if($l->id!=-1){
          // echo "horizon exist <br>";
        $result=$conn->query("update horizon set name='$l->name' where id='$l->id'");
        if($result==null)echo "$conn->error";
        // echo "horizon updated <br>";
        }else{
          // echo "horizon  not exist <br>";
        $this->insert($l,"Horizon");
        // echo "horizon inserted <br>";
        $id_c[]=$this->selectScalar("select max(id) from horizon");
        $this->choix_horizone($id,$id_c);
        // echo "horizon connection updated<br>";
      }
      }
    }else echo "horizon not changed<br>";
  }


    if(is_array($obj->conditions))
    foreach($obj->conditions as $key=>$l){
      if($this->changed($l,"condition")){
        // echo "Condition changed<br>";
      if($this->hasConnection("condition",$l->id)) {
        // echo "old Condition has Connections<br>";
        if($this->exist($l,"condition")==-1){
          // echo "new Condition exist<br>";
            $this->insert($l,"condition");
            $id_c=$this->selectScalar("select max(id) from conditions");
        }
        else $id_c=$this->exist($l,"condition");
        $this->updateConnection("condition",$obj->id,$id_c,$l->id);
        // echo "condition update ch: $obj->id, nc: $id_c oc$l->id<br>";
      }
      else{
        // echo "old Condition has no Connections<br>";
        if($l->id!=-1){
          // echo "Condition exist<br>";
        $result=$conn->query("update conditions set aged= '$l->age_d' , agef= '$l->age_f' , notseuil= '$l->Note_seuile' , nbrplace= '$l->nbr_places' where id='$l->id'");
        if($result==null)echo "$conn->error";
          // echo "Condition updated<br>";
      }else{
        // echo "Condition not exist<br>";
        $this->insert($l,"conditions");
        // echo "Condition inserted<br>";
        $id_c[]=$this->selectScalar("select max(id) from conditions");
        $this->choix_condition($id,$id_c);
        // echo "Condition connection established<br>";
      }
      }
    }
    }



    if(is_array($obj->fillieres))
    foreach($obj->fillieres as $key=>$l){
      if($this->hasConnection("filliere",$l->id)) {
        if($this->exist($l,"filliere")==-1){
            $this->insert($l,"filliere");
            $id_f=$this->selectScalar("select max(id) from filliere");
        }
        else $id_f=$this->exist($l,"filliere");
        $this->updateConnection("horizon",$obj->id,$id_f,$l->id);
      }
      else{
        if($l->id!=-1){
        $result=$conn->query("update filliere set name='$l->name'where id='$l->id'");
        if($result)echo "$conn->error";
      }else{
        $this->insert($l,"filliere");
        $id_c[]=$this->selectScalar("select max(id) from filliere");
        $this->choix_filliere($id,$id_c);
      }
      }
    }
  }
  public function  hasConnection($table,$id) {
    global $conn;
    $t=substr($table,0,3);
    if($t=="lie")$t="li";
    $count=$this->selectScalar("select count(*) from Choix_$table where id_$t=$id");
    return($count>1?true:false);
  }
  public function  updateConnection($table,$idCh,$idCo,$idCo0) {
    global $conn;
    $t=substr($table,0,3);
    if($t=="lie")$t="li";
    $result=$conn->query("update Choix_$table set id_$t=$idCo where id_ch=$idCh and id_$t=$idCo0");
    echo "update Choix_$table set id_$t=$idCo where id_ch=$idCh and id_$t=$idCo0";
    return($result?true:false);
  }
  public function  changed($obj,$table) {
            $l=$this->exist($obj,$table);
            // echo var_dump($obj);
            // echo "<br>$l==$obj->id<br>";
            if($l==-1)return true;
            if($l==$obj->id)return false;
            return true;

  }
  public function  verify($id,$idv) {
    global $conn;
    if($idv!=-1){
      $conn->query("update choix set id_ad=$idv where id=$id");
    }
    else{
      $this->delete("choix","where id=$id");
    }
  }
  public function  retest($id) {
    global $conn;
      $conn->query("update choix set id_ad='-1' where id=$id");
  }
}
 ?>
