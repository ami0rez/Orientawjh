<html>
<head>
  <title>Ajouter Neaveau Choix</title>
  <link rel="stylesheet" type="text/css" href="../css/add_choix.css"/>
</head>
<body>
  <script>
  var lieu = new Array(),filliere= new Array(),horizon= new Array(),diplome= new Array(),conditions= new Array();

      /*horizon*/

  function add_horizon() {
    try{
      var y=document.getElementById("horizontxt").value;
      lieu.push(y);
      document.getElementById("horizon_f").value +=";"+y;
    }
    catch(err){
    alert(err+"eee");}
    }

    /*Filliere*/

    function add_filliere() {
      try{
        var y=document.getElementById("filliere_txt").value;
        lieu.push(y);
        document.getElementById("filliere_f").value +=";"+y;
      }
      catch(err){
      alert(err+"eee");}
      }

    /*lieu*/

      function add_lieu() {
        try{
          var x=document.getElementById("lieu_name").value;
          var y=document.getElementById("lieu_long").value;
          var z=document.getElementById("lieu_latt").value;
          var a=x+","+y+","+z;
          lieu.push(a);
          document.getElementById("lieu_f").value +=";"+a;
        }
        catch(err){
        alert(err+"eee");}
        }

    /*condition*/

      function add_condition() {
          try{
            var x=document.getElementById("condition_name").value;
            var y=document.getElementById("condition_age_d").value;
            var z=document.getElementById("condition_age_f").value;
            var v=document.getElementById("condition_nbr_place").value;
            var w=document.getElementById("condition_note_seile").value;
            var a=x+","+y+","+z+","+v+","+w;
            lieu.push(a);
            document.getElementById("condition_f").value +=";"+a;
          }
          catch(err){
          alert(err+"eee");}
          }

          /*diplome*/

        function add_diplome() {
            try{
              var y=document.getElementById("diplome_txt").value;
              lieu.push(y);
              document.getElementById("diplome_f").value +=";"+y;
            }
            catch(err){
            alert(err+"eee");}
            }
  </script>
  <div>
    <div>
      <form method="post"action="../addch.php">
        <input type="text" name="nom" placeholder="Nom"/>
        <input type="text" name="desc" placeholder="Descr"/>
        <input type="text" name="lieu" id="lieu_f"/>
        <input type="text" name="horizon" id="horizon_f"/>
        <input type="text" name="diplome"id="diplome_f"/>
        <input type="text" name="filliere"id="filliere_f"/>
        <input type="text" name="condition"id="condition_f"/>
        <input type="submit" value="Ajouter"/>
        <br>
        <form></form>


        <!--Lieu-->


        <form action="#" id="lieu">
          <div class="panel">
          <input type="text" id="lieu_name" placeholder="Nom">
          <input type="text" id="lieu_long" placeholder="Long">
          <input type="text" id="lieu_latt" placeholder="latt">
        </div>
        <div class="contents">
        </div>
        </form><br>
        <button onclick="add_lieu()">ad lieu</button>


        <!--Horizon-->


        <form id="horizon">
          <div class="panel">
          <input type="text" id="horizontxt" placeholder="Nom">
        </div>
        <div class="contents" id="hor_con">

        </div>
        </form>
      <button onclick="add_horizon()">add horizon</button>


      <!--diplome-->


        <form id="diplome">
          <div class="panel">
          <input type="text" id="diplome_txt" placeholder="Nom">

        </div>
        <div class="contents">

        </div>
        </form>
        <button title="hello" onclick="add_diplome()">add diplome</button>

        <!--filliere-->


        <form id="filliere">
          <div class="panel">
          <input type="text" id="filliere_txt" placeholder="Nom">

        </div>
        <div class="contents">
        </div>
        </form>
        <button title="hello" onclick="add_filliere()"> add filliere</button>


        <!--conditions-->


          <form id="condition">
          <div class="panel">
          <input type="text" id="condition_name" placeholder="Nom">
          <input type="text" id="condition_age_d" placeholder="Age debut">
          <input type="text" id="condition_age_f" placeholder="Age Fin">
          <input type="text" id="condition_nbr_place" placeholder="Nombre de place">
          <input type="text" id="condition_note_seile" placeholder="Note Seuile">
        </div>
        <div class="contents">
        </div>
        </form>
        <button title="hello" onclick="add_condition()">Add Condition</button>
      </form>
    </div>
  </div>
</body>
</html>
