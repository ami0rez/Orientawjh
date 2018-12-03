<?php
class Etudiant{
public $id,$name,$prename,$email,$password,$adress;
public function  __construct($name,$prename,$email,$password,$adress)
{
  $this->name=$name;
  $this->prename=$prename;
  $this->email=$email;
  $this->password=$password;
  $this->adress=$adress;
}
}

 ?>
