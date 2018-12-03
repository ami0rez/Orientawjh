<?php
class Choix{
    public $id_ad=-1,$id_et=-1,$id,$diplomes,$lieus;
    public $name,$desc,$date;
    public $horizons,$fillieres,$conditions;
    function __construct($id, $name, $desc) {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;
    }
}
class Filliere{
    public $id;
    public $name;
    function __construct($id,  $name) {
        $this->id = $id;
        $this->name = $name;
    }
}
class Diplome{
    public $id;
    public $nom;
    public $duree;

    function __construct($id,  $nom, $duree) {
        $this->id = $id;
        $this->nom = $nom;
        $this->duree = $duree;
    }
}
class Horizon{
    public $id;
    public $name;
    //don't add diplmoes here cuz we xont have only one horizon
    function __construct($id,$name) {
        $this->id = $id;
        $this->name = $name;
    }
}
class Condition{
    public $age_d,$age_f;
    public $Note_seuile;
    public $nbr_places,$id;
    function __construct($id,$age_d,$age_f, $note_seuile,$nbr_places) {
        $this->nbr_places=$nbr_places;
        $this->id=$id;
        $this->age_d = $age_d;
        $this->age_f=$age_f;
        $this->Note_seuile = $note_seuile;
    }
}
class Lieu{
    public $id;
    public $name;
    public $Long,$Latt;
    function __construct($id, $name, $aLong, $latt) {
        $this->id = $id;
        $this->name = $name;
        $this->Long = $aLong;
        $this->Latt = $latt;
    }
}
 ?>
