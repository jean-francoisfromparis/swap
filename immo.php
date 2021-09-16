<?php

require_once('includes/init.php') ;

$title= "Annonce";
require_once ('includes/haut.php');
?>
<div class="container titre1" onload="init()">
    <div class="row text-center ">
        <h1>Annonces</h1>
        <hr class="mb-5">
    </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-2">
      <img class="img-fluid rounded w-100 imgs" src="./includes/img/placeholder-350x350.png" alt="$photo">
    </div>
    <div class="col-2">
      <img class="img-fluid rounded w-100 imgs" src="./includes/img/placeholder-350x350.png" alt="$photo2" >
    </div>
    <div class="col-2">
      <img class="img-fluid rounded w-100 imgs" src="./includes/img/placeholder-350x350.png" alt="$photo3" >
    </div>
    <div class="col-2">
      <img class="img-fluid rounded w-100 imgs" src="./includes/img/placeholder-350x350.png" alt="$photo4" >
    </div>
    <div class="col-2">
      <img class="img-fluid rounded w-100 imgs" src="./includes/img/placeholder-350x350.png" alt="$photo5" >
    </div>
  </div>
  <div>Saisissez une adresse</div>
<div>
	<input type="text" id="address" 
             value="" />
	<button id="send">OK</button>
</div>
<pre id="output"></pre>
  <!-- The expanding image container -->
  <div class="container" id="container">
    <!-- Close the image -->
    <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>

    <!-- Expanded image -->
   <div class="row">
   <img id="expandedImg" style="width:30%">
   <div id="mapid" ></div>
   </div> 

    <!-- Image text -->
    <div id="imgtext"></div>
    
  </div>
</div>

<?php
require_once('includes/footer.php');
