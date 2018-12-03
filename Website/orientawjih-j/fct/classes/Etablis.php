<?php
class Etablis{
public $id,$name,$prename,$email,$password,$date_naisc,$tel,$img;
public function  __construct($name,$prename,$email,$password,$date_naisc,$tel,$img)
{
  $this->name=$name;
  $this->prename=$prename;
  $this->email=$email;
  $this->password=$password;
  $this->date_naisc=$date_naisc;
  $this->tel=$tel;
  $this->img=$img;
}
}

 ?>
