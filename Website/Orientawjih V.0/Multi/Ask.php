<?php
include_once '../fct/classes/Ask_res.php';
include_once '../fct/db/DataBase.php';
$db=new DataBase();
$db->connect();
if(isset($_POST['submit'])){
$text=$_POST["txt"];
echo "$text";
$x=new Ask(1,"ask",$text,"-","-","-","-");
$db->insert($x,"question");}
$var=$db->select("question");
 ?>
<html>
<head>
  <title>Poser des question</title>
  <link rel="stylesheet" type="text/css" href="../css/ask.css"
</head>
<body>
    <header>
    <form method="post" action="Ask.php" id="ask">
      <input type="text" name="txt"/>
      <input type="submit" name="submit" value="ask"/>
    </form>
    </header>
    <?php
    if($var!=null)
      foreach ($var as $key => $value) {
        echo "<div onclick='question(1)''>
          $value->text
          <a href='resp.php?id=$value->id'>Voire Reponses</a>
        </div>";
      }
     ?>
</body>
</html>
