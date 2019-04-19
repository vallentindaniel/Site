<?php

  require_once "config.php";

  include ("functions.php");
  //pentru debug
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();
 if(!isset($_SESSION["doctor"]) || $_SESSION["doctor"] !== true){
    header("location: home.php");
    exit;
}
$functions = new functions();
$link = $functions->Connect();
 $reteta = $_SESSION["reteta"];
  ?>

  

<!DOCTYPE html>



<html lang="en">



<head>



<meta charset="UTF-8">



<meta http-equiv="X-UA-Compatible" content="IE=edge">



<meta name="viewport" content="width = device-width, initial-scale = 1">



<title>Welcome user</title>



<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">





<style>



.jumbotron{



    background-color:#2E2D88;



    color:white;



}



.tab-content {



    border-left: 4px solid #ddd;



    border-right: 4px solid #ddd;



    border-bottom: 4px solid #ddd;



    padding: 10px;



}



.nav-tabs {



    margin-bottom: 0;



}

</style>



</head>



<body>





<nav class="navbar navbar-default">



  <div class="container-fluid">



    <div class="navbar-header">



      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">



        <span class="sr-only"></span>



        <span class="icon-bar"></span>



        <span class="icon-bar"></span>



        <span class="icon-bar"></span>



      </button>



    </div>



    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">



      <ul class="nav navbar-nav">



        <li><a href="welcome.php">Acasa </a></li>


         <li><a href="pacienti.php">Pacienti</a></li>

        

        

        <li><a href="creaza_reteta.php">Reteta</a></li>



        <li class="active"><a href="print.php">Print<span class="sr-only">(current)</span></a></li>

         <li><a href="programari.php">Programari</a></li> 

        <li><a href="logout.php">Logout</a></li>

        <li><a><button onClick="window.print()">Printeaza pagina</button></a></li>



        <li><a href="contact.php">Contact</a></li>



      </ul>



    </div><!-- /.navbar-collapse -->



  </div><!-- /.container-fluid -->



</nav>



</div>





<div class="container">      

  <table class="table">

    <thead>

      <tr>

        <th>Nume</th>

        <th>Prenume</th>

      </tr>

    </thead>

    <tbody>

    <?php

$sql = "SELECT * FROM retete WHERE id_reteta = $reteta";
           $result = $link->query($sql);
          if ($result->num_rows > 0){                  
            while ($row = $result->fetch_assoc()) {
              $idd = $row["id_user"]  ;          
            }                
          }



$functions = new functions();

$link = $functions->Connect();

$sql = "

SELECT Email, Nume, Prenume,DataNasterii,NrTelefon FROM Users WHERE Id = $idd";

$result = $link->query($sql);

if ($result->num_rows > 0){                  

  while ($row = $result->fetch_assoc()) {

               

    $tabel = ' 
        <tr>
        <td>'. $row["Nume"].'</td>
        <td>'. $row["Prenume"].'</td>   
        </tr>';
    echo $tabel;               
    }                
}
    ?>
    </tbody>

  </table>

  <table class="table">
    <thead>
      <tr>
        <th>Medicament:</th>
        <th>Administrare:</th>
        <th>Timp de:</th>
      </tr>
    </thead>
    
     <?php
      $sql = "SELECT * FROM retete WHERE id_reteta = $reteta";
           $result = $link->query($sql);
          if ($result->num_rows > 0){                  
            while ($row = $result->fetch_assoc()) {
        
             $tabel = ' 
        <tr>
        <td>'. $row["medicament"].'</td>
        <td>'. $row["administrare"].'</td> 
        <td>'. $row["timp_de"].'</td>  
        </tr>';
    echo $tabel; 
            }                
          }


     ?> 
     
  </table>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>