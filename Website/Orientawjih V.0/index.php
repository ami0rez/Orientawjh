<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>OrienTawjih | Orienté apres le bac</title>
  <meta name="description" content="Worthy a Bootstrap-based, Responsive HTML5 Template">
  <meta name="author" content="Amirez">
  <link href="css/custom.css" rel="stylesheet">
</head>
<body onscroll="myFunction()" id="body">
  <script >
function myFunction() {
  var elmnt = document.getElementById("body");
  var x = elmnt.scrollLeft;
  var y = elmnt.scrollTop;
  if(elmnt.scrollTop>50){
    document.getElementById("header").style.padding = "5px 0px 5px 0px";
      document.getElementById("header").style.backgroundColor="rgba(0, 0, 0, 0.88)"
  }
  else{
    document.getElementById("header").style.padding = "10px 0px 20px 0px";
    document.getElementById("header").style.backgroundColor="rgba(0, 0, 0, 0.22)";
}
}
</script>
<header class="header" id="header">
  <ul>
    <li><a href="#Application" >Aplication</a></li>
    <li><a href="#Accounts">Account</a></li>
    <li><a href="#Services">Services</a></li>
    <li><a href="#About">About</a></li>
    <li><a href="#home">Home</a></li>
    <li class="logo">OrienTawjih</li>
  </ul>
</header>
<div id="home">
  <img src="i.jpg" id="home"/>
  <h1>Orien<b class="blue">Tawjih</b></h1>
</div>
<div id="About">
  <center><h2>About <b class="blue">OrienTawjih</b><h2></center>
<img src="g.gif" id="about"/>
<span id="desc-about">
  OrienTawjih et une application qui possed l'interet de vous donnee tout les
  possible choix, tout les rues que vous et tous les autre etudiant peut prend
</span>
</div>
 <div id="Services">
  <h3>Les Service de OrienTawjih</h3>
  <img src="hh.jpg" id="Services"/>
  <div id="services">
    <span id="left">
      <article>
        <h4>Service 1</h4>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure aperiam consequatur quo quis exercitationem reprehenderit dolor vel ducimus, voluptate eaque suscipit iste placeat.
      </article>
      <article>
        <h4>Service 2</h4>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure aperiam consequatur quo quis exercitationem reprehenderit dolor vel ducimus, voluptate eaque suscipit iste placeat.
      </article>
      <article>
        <h4>Service 3</h4>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure aperiam consequatur quo quis exercitationem reprehenderit dolor vel ducimus, voluptate eaque suscipit iste placeat.
      </article>
    </span>
    <span id="right">
      <article>
        <h4>Service 4</h4>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure aperiam consequatur quo quis exercitationem reprehenderit dolor vel ducimus, voluptate eaque suscipit iste placeat.
      </article>
      <article>
        <h4>Service 5</h4>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure aperiam consequatur quo quis exercitationem reprehenderit dolor vel ducimus, voluptate eaque suscipit iste placeat.
      </article>
      <article>
        <h4>Service 6</h4>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure aperiam consequatur quo quis exercitationem reprehenderit dolor vel ducimus, voluptate eaque suscipit iste placeat.
      </article>
    </span>
 </div>
 </div>
 <div id="Accounts">
   <img src="fff.jpg" id="account"/>
   <div id="compt">
     <span>
       <h3>Admin</h3>
       <a href="admin/login.php">LogIn</a>
     </span>
     <span>
       <h3>Etablis.</h3>
       <a href="etablis/login.php">LogIn</a>
       <a href="etablis/inscription.php">Sign UP</a>
   </div>
 </div>
 <div id="Application">
<img src="end.jpg" />
<div id="app">
  <span>
    <h3>Get On<br>PlayStore</h3>
  </span>
  <span>
    <h4>Get On<br>AppStore</h4>
  </span>
</div>
</div>
</body>
</html>
