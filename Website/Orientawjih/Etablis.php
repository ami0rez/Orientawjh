<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/etablis.css"/>
</head>
<body>
  <div id="fullscreen_bg" class="fullscreen_bg"/>
<?php
if($_GET["t"]=="login")
echo "
<form method='post' action='login.php'>
  <input type='text' name='email' placeholder='E-mail'/>
  <input type='password' name='pass' placeholder='Password'/>
  <input type='submit'/>
</form>";
elseif($_GET["t"]=="singup"){
  echo "
  <form method='post' action='insertEtablis.php'>
    <input type='text' name='name' placeholder='Nom'/>
    <input type='text' name='prename' placeholder='Prenom'/>
    <input type='text' name='date_n' placeholder='Date naissance'/>
    <input type='text' name='tel' placeholder='tel'/>
    <input type='text' name='email' placeholder='E_mail'/>
    <input type='password' id='pass1' name='pass1' placeholder='Password'/>
    <input type='password' id='pass1' name='pass2' placeholder='Repeat Password'/>
    <input type='submit'/>
  </form>";
}
?>
</div>
</body>
