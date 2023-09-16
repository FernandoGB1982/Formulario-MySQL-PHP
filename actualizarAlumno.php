<!DOCTYPE HTML>  
<html>
<head>
  <title>EJERCICIOS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      /*background-color: rgb(185, 169, 169);*/
      background-image: url(imagenes/fondo.gif);
    }
    @font-face {
      font-family: 'vintage2';
      src: url('fuentes/vintage2.ttf') ;
    }

    h1{
      color: rgb(196, 13, 92);
      text-align: center;
      margin: 0 auto;
      font-family: 'vintage2';
      font-style: italic;
      font-size: 60px;
    }
  
  
    h2 {
      color: #333;
      text-align: center;
      margin: 0 auto;
    }

    form {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color:beige;
      border-radius: 5px;
      box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.4);
    }

    #salida {
      display: block;
      margin-bottom: 10px;
      text-align: center;
    }

    input[type=text]{
      width: 100%;
      box-sizing: border-box;
    }

    input[type=email]{
      width: 100%;
      box-sizing: border-box;
    }
    
    input[type=date]{
      width: 100%;
      box-sizing: border-box;
    }
  </style>
</head>
<body>
<?php
    $conexion = mysqli_connect("localhost", "root", "", "base1") or
        die("Problemas con la conexión");
        
        $nombre = $_REQUEST['nombre'];
        $mail= $_REQUEST['mail'];
        $nif = $_REQUEST['nif'];
        $provincia = $_REQUEST['provincia'];
        $codigocurso= $_REQUEST['codigocurso'];
        $codigo = $_REQUEST['codigo'];

        $numero=substr($nif, 0,8);
        $letra=substr($nif, -1);
        $numeros=intval($numero);
        $cadena="TRWAGMYFPDXBNJZSQVHLCKE";
        $resto=$numeros%23;
      
        if($letra!=$cadena[$resto]){
          $nif='Erroneo';
        }
        
    mysqli_query($conexion, "update alumnos
                            set nombre='$nombre',
                            mail='$mail',
                            nif='$nif',
                            provincia='$provincia',
                            codigocurso='$codigocurso'
                        where codigo='$_REQUEST[codigo]'") or
        die("Problemas en el select:" . mysqli_error($conexion));
    header('Location:listadoAlumnos.php');
    ?>
</body>
</html>