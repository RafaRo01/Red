


<!DOCTYPE html>
<html>
<head>
  <title>ventas y almacen</title>
  <?php require_once "dependencias.php" ?>
</head>
<body>

  <!-- Begin Navbar -->
  <div id="nav">
    <div class="navbar navbar-inverse navbar-fixed-top" data-spy="affix" data-offset-top="100">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <style> a{color: #6c2eb9;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 15px;
  text-transform: uppercase; } </style>

         
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav navbar-right">

            <li class="active dropdown" ><a href="inicio.php">
            <span class="glyphicon">
            <img class="img-responsive logo img-thumbnail" src="../img/inicio1.png" alt="" width="30px" height="30px">
	</span>
  
              Inicio</a>
            </li>

            
          </li>
          <style> 
          .dropdown2{
            background-color: #b633c78d
          }
          .dropdown{
            background-color: #e069f08d;
          }
          .navbar{
            background-color: #d502ef;
            color: white;
           } </style>
         
         <style> 
          .dropdown-menu{
            background-color: #c31835ae;
          }
          </style>

         <li class="dropdown2">
         
            <a style="color: WHITE" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon">
           
            </span> Administrar Articulos <span class="caret"></span></a>
            <ul class="dropdown-menu">

              <li><a style="color: BLUE" href="categorias.php"><ion-icon name="desktop-outline"></ion-icon> Categorias</a></li>
              <li><a style="color: BLUE" href="articulos.php"><ion-icon name="bag-add-outline"></ion-icon> Articulos</a></li>
            </ul>
          </li>


        <?php
        if($_SESSION['usuario']=="admin"):
         ?>
         <style>
          .ba{
             color: ##FF0000;
           }
           </style>
           <li class="dropdown"><a style="color: WHITE" href="usuarios.php"><span class="glyphicon "></span> <ion-icon name="logo-tux"></ion-icon class="ba"> Administrar usuarios</a>
            </li>
         <?php 
       endif;
          ?>


           <li class="dropdown2"><a  style="color: WHITE" href="clientes.php"><span class="glyphicon "></span> <ion-icon name="logo-reddit"></ion-icon> Clientes</a>
          </li>

          <li class="dropdown">
          <a style="color: WHITE" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon"></span> 
            <ion-icon name="cart-outline"></ion-icon>
            Vender Articulo<span class="caret"></span></a>
              <ul class="dropdown-menu">
                
              <li><a   href="ventasDeProductos.php">
              <ion-icon name="cash-outline"></ion-icon> Vender Productos</a></li>
              <li><a  href= "ventasyReportes.php"
              ><ion-icon name="wallet-outline"></ion-icon> Ventas Hechas</a></li>
            </ul>
          </li>
          
          <li class="dropdown2" >
            <a href="#" style="color: WHITE"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon "></span> <ion-icon name="person-circle-outline"></ion-icon>
             Usuario: <?php echo $_SESSION['usuario']; ?>  <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li > <a style="color: BLUE" href="../procesos/salir.php"><span class="glyphicon"><ion-icon name="power-outline"></ion-icon></span> Salir</a></li>
              
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.contatiner -->
  </div>
</div>
<!-- Main jumbotron for a primary marketing message or call to action -->


<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



<!-- /container -->     

</body>
</html>

<script type="text/javascript">
  $(window).scroll(function() {
    if ($(document).scrollTop() > 150) {
      $('.logo').height(200);

    }
    else {
      $('.logo').height(100);
    }
  }
  );
</script>