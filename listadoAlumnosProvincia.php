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
      max-width: 600px;
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

    table{
      background-color: beige;
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
      background-color: beige;
      border: 0;
    }
  </style>
</head>
<body>
<?php
  $conexion = mysqli_connect("localhost", "root", "", "base1") or
    die("Problemas con la conexión");
    $provincia=$_POST['provincia'];

  $registros = mysqli_query($conexion, "select codigo,nombre,mail,nif,provincia,codigocurso
                        from alumnos where provincia='$provincia'") or
    die("Problemas en el select:" . mysqli_error($conexion));
?>
  <h1> Listado de Alumnos por Provincia</h1>
  <hr>
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