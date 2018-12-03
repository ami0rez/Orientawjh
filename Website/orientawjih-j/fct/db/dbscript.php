<?php
  $Admin="Create Table IF NOT EXISTS Admin(
  id int PRIMARY KEY  AUTO_INCREMENT,
 name varchar(30) not null,
 prename varchar(30) not null,
 E_mail varchar(30) not null,
 Password varchar(30) not null,
 Date_naisc varchar(30) not null,
 Adress varchar(30) not null,
 img int not null)";
  $Etablis="Create Table IF NOT EXISTS Etablis(
  id int PRIMARY KEY  AUTO_INCREMENT,
 name varchar(30) not null,
 prename varchar(30) not null,
 E_mail varchar(30) not null,
 Password varchar(30) not null,
 Date_naisc varchar(30) not null,
 Tel varchar(30) not null,
 img int not null,
 choix int not null)";
  $Etudiant="Create Table IF NOT EXISTS Etudiant(
  id int PRIMARY KEY  AUTO_INCREMENT,
 name varchar(30) not null,
 prename varchar(30) not null,
 E_mail varchar(30) not null,
 Password varchar(30) not null,
 Adress varchar(30) not null)";
  $Condition="Create Table IF NOT EXISTS Conditions(
     id int PRIMARY KEY AUTO_INCREMENT,
     aged int not null,
     agef int not null,
     notseuil int not null,
     nbrplace int not null);";
  $Diplome="Create table if not exists diplome(
    id int PRIMARY KEY  AUTO_INCREMENT,
    duree int not null,
    name varchar(20) not null)";
  $Fillier="Create table if not exists filliere(
       id int PRIMARY KEY AUTO_INCREMENT,
   name varchar(30) not null)";
  $Horizon="create table if not exists horizon(
   id int PRIMARY KEY  AUTO_INCREMENT,
   name varchar(20) not null)";
  $Lieu="create table if not exists lieu (
   id int PRIMARY KEY  AUTO_INCREMENT,
   name varchar(20) not null,
   lng int not null,
   latt int not null)";
  $Concour="create table  if not exists concours(id int not null)";
  $Choix="create table  if not exists choix (
   id int PRIMARY KEY  AUTO_INCREMENT,
   name varchar(40) not null,
   descr varchar(255) not null,
   id_ad int not null,
   id_et int not null)";
  $Choix_Condition="create table if not exists choix_condition(id_con int not null, id_ch int not null);";

  $Choix_Diplome="create table if not exists choix_diplome(id_dip int not null, id_ch int not null);";

  $Choix_fillier="create table if not exists choix_filliere(id_fil int not null, id_ch int not null);";

  $Choix_horizon="create table if not exists choix_horizon(id_hor int not null, id_ch int not null);";

  $Choix_lieu="create table if not exists choix_lieu(id_li int not null, id_ch int not null);";

  $Ecole="create table if not exists ecole (id int primary key)";

  $Bourse="create table if not exists bourse (id int primary key)";
 ?>
