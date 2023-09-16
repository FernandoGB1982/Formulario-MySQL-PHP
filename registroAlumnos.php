<!DOCTYPE HTML>  
<html>
<head>
  <title>EJERCICIOS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <style>

  </style>
</head>
<body>
  <?php
  $conexion = mysqli_connect("localhost", "root", "", "base1") 
    or die("Problemas con la conexión");
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

  mysqli_query($conexion, "insert into alumnos (nombre,mail,nif,provincia,codigocurso) values 
                       ('$nombre','$mail','$nif','$provincia',$codigocurso)")
    or die("Problemas en el select" . mysqli_error($conexion));

  mysqli_close($conexion);
  header('Location:listadoAlumnos.php');
  ?>
</body>
</html>