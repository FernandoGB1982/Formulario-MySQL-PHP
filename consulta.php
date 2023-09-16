<!DOCTYPE HTML>  
<html>
<head>
  <title>PHP-MySQL</title>
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
      padding: 0.5em;
      background-color:rgb(198, 100, 207,0.8);
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

    #volver{
      color: white;
      display: block;
      text-align: center;
    }

    table{
      background-color:rgb(198, 100, 207,0.8);
      text-align: center;
      font-size: small;
      width: max-content;
      margin: 0 auto;
      border: 1px solid black;
      box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.4);
      border-radius: 5px;
    }

    th{
      width: max-content;
      padding: 1em;
      border: 1px solid rgb(185, 169, 169);
      background-color: beige;
      color: #555;
      font-weight: bold;
      font-style: italic;
      font-size: large;

    }

    td{
      width: max-content;
      padding: 0.5em;
      border: 1px solid rgb(185, 169, 169);
    }

    tr:nth-child(odd) {
      background-color: lightblue;
      color: black;
    }

    tr:nth-child(even) {
      background-color: darkseagreen;
      color: white;
    }

    tr:hover{
      background-color: lightgrey;
      color: rgb(196, 13, 92);
    }

    a{
      color: blue;
    }
    
    #volver{
      color: rgb(196, 13, 92);
      display: block;
      text-align: center;
    }
    
    #registrar{
      background-color:beige;
      border: 0;
    }
  </style>
</head>
<body>
  <h1>Consulta</h1>
  <hr>

  <?php
    $conexion = mysqli_connect("localhost", "root", "", "base1") or
      die("Problemas con la conexión");

    $registros = mysqli_query($conexion, "select DISTINCT provincia
                          from alumnos order by provincia") or
      die("Problemas en el select:" . mysqli_error($conexion));

    
  ?>

  <form action="consulta.php" method="post">
    Ingrese nombre:
        <input type="text" pattern="[A-ZÁÉÍÓÚÑa-záéíóúñ\s]*$" maxlength="40" name="nombre">
    <br><br>
    Seleccione la provincia:
    <select name="provincia">
        <option value="">Selecciona una provincia</option>';
      <?php
      while ($reg = mysqli_fetch_array($registros)) {
        $provincia = $reg['provincia'];
        echo '<option value="'.$provincia.'">'.$provincia.'</option>';
      }
      ?>
    </select>
    <br><br>

    Seleccione el curso:
    <select name="codigocurso">
      <option value="">Selecciona un curso</option>
      <option value="1">PHP</option>
      <option value="2">ASP</option>
      <option value="3">JSP</option>
    </select>
    <br><br>

    <input type="submit" value="Consultar">
    </form>
  <br>
  


  <?php


  $conexion = mysqli_connect("localhost", "root", "", "base1") or
    die("Problemas con la conexión");

    if(isset($_POST['codigocurso'])){
      $lenguaje=$_POST['codigocurso'];
    }else{
      $lenguaje='';
    }

    if(isset($_POST['provincia'])){
      $provincia=$_POST['provincia'];
    }else{
      $provincia='';
    }

    if(isset($_POST['nombre'])){
      $nombre=$_POST['nombre'];
    }else{
      $nombre='';
    }
    


    if($lenguaje=='' && $provincia=='' && $nombre==''){
        $sql="select codigo,nombre,mail,nif,provincia,codigocurso
            from alumnos";
    }else if($lenguaje=='' && $provincia==''){
        $sql="select codigo,nombre,mail,nif,provincia,codigocurso
            from alumnos where nombre LIKE '%$nombre%'";
    }else if($lenguaje=='' && $nombre==''){
        $sql="select codigo,nombre,mail,nif,provincia,codigocurso
            from alumnos where provincia='$provincia'";
    }else if($provincia=='' && $nombre==''){
        $sql="select codigo,nombre,mail,nif,provincia,codigocurso
            from alumnos where codigocurso='$lenguaje'";
    }else if($lenguaje==''){
        $sql="select codigo,nombre,mail,nif,provincia,codigocurso
            from alumnos where provincia='$provincia' AND nombre LIKE '%$nombre%'";
    }else if($provincia==''){
        $sql="select codigo,nombre,mail,nif,provincia,codigocurso
            from alumnos where codigocurso='$lenguaje' AND nombre LIKE '%$nombre%'";
    }else if($nombre==''){
        $sql="select codigo,nombre,mail,nif,provincia,codigocurso
            from alumnos where provincia='$provincia' AND codigocurso='$lenguaje'";
    }else{
        $sql="select codigo,nombre,mail,nif,provincia,codigocurso
            from alumnos where provincia='$provincia' AND codigocurso='$lenguaje' AND nombre LIKE '%$nombre%'";
    }

  $registros = mysqli_query($conexion,$sql) or
    die("Problemas en el select:" . mysqli_error($conexion));
  
?>
  <table>
    <tr> 
      <th>Código</th>
      <th>Nombre</th>
      <th>Email</th>
      <th>NIF</th>
      <th>Provincia</th>
      <th>Curso</th>
    </tr>
<?php  
  while ($reg = mysqli_fetch_array($registros)) {
    echo "<tr>";
    echo "<td>". $reg['codigo'] . "</td>";
    echo "<td>". $reg['nombre'] . "</td>";
    echo "<td>". $reg['mail'] . "</td>";
    echo "<td>". $reg['nif'] . "</td>";
    echo "<td>". $reg['provincia'] . "</td>";
    echo "<td>";
    switch ($reg['codigocurso']) {
      case 1:
        echo "PHP"."</td>";
        break;
      case 2:
        echo "ASP"."</td>";
        break;
      case 3:
        echo "JSP"."</td>";
        break;
    }
    echo "<td> <a href='editarAlumnos.php?codigoEditar=$reg[codigo]'>
    <img src='imagenes/editar.png' alt='Editar' width='30'/>
    </a> </td>";
    echo "<td> <a href='borrarAlumnos.php?codigoBorrar=$reg[codigo]'>
    <img src='imagenes/borrar.png' alt='Borrar' width='30'/>
    </a> </td>";
    echo "</tr>";
  }

  echo "<tr>";
    echo "<td colspan='8' id='registrar'> <a href='formularioBase1.html'>
    <img src='imagenes/registrar3.png' alt='Registrar' width='30'/> 
    </a> </td>";
  echo "</tr>";

  mysqli_close($conexion);
?>
  </table>
  <br><a id='volver' href="index.html">Volver al inicio</a><br>
</body>
</html>