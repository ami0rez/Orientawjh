<?php
class Admin{
public $id,$name,$prename,$email,$password,$date_naisc,$adress,$img;
public function  __construct($name,$prename,$email,$password,$date_naisc,$adress,$img)
{
  $this->name=$name;
  $this->prename=$prename;
  $this->email=$email;
  $this->password=$password;
  $this->date_naisc=$date_naisc;
  $this->adress=$adress;
  $this->img=$img;
}
}

 ?>
