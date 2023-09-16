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
      padding: 1em;
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

    a{
      color: blue;
    }
    
    #volver{
      color: rgb(196, 13, 92);
      display: block;
      text-align: center;
    }
  </style>
</head>
<body>
    <?php
    $conexion = mysqli_connect("localhost", "root", "", "base1") or
        die("Problemas con la conexión");

    $registros = mysqli_query($conexion, "select * from alumnos
                            where codigo=".$_GET['codigoEditar']) or
        die("Problemas en el select:" . mysqli_error($conexion));

    $registros2 = mysqli_query($conexion, "select Provincia
                            from provincias") or
        die("Problemas en el select:" . mysqli_error($conexion));
        
    if ($reg = mysqli_fetch_array($registros)) {
    ?>
    <h1>Editar Alumno</h1>
    <hr>
    <form action="actualizarAlumno.php" method="post">
      <input type="hidden" name="codigo" value="<?php echo $reg['codigo']?>">
      Ingrese nuevo nombre:
      <input type="text" pattern="^[A-ZÁÉÍÓÚÑ][A-ZÁÉÍÓÚÑa-záéíóúñ\s]*$" maxlength="40" name="nombre" value="<?php echo $reg['nombre']?>"><br><br>
      Ingrese nuevo mail:
      <input type="email" placeholder="*****@*****.***" pattern="[a-zñ0-9._%+-]+@[a-z0-9.-]+\.[a-zñ]{2,3}$"  maxlength="40" name="mail" value="<?php echo $reg['mail']?>"><br><br>
      Ingrese nuevo NIF:
      <input type="text" placeholder="12345678A" pattern="^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]{1}$" maxlength="9" name="nif" value="<?php echo $reg['nif']?>"><br><br>
      Seleccione una nueva provincia:
      <select name="provincia">
          <option value="">Selecciona una provincia</option>';
        <?php
        while ($reg2 = mysqli_fetch_array($registros2)) {
          $valueProvincia = $reg2['idProvincia'];
          $provincia = $reg2['Provincia'];
          if ($reg['provincia']==$reg2['Provincia']){
            echo '<option value="'.$provincia.'" selected>'.$provincia.'</option>';
          }else{
            echo '<option value="'.$provincia.'">'.$provincia.'</option>';
          }
        }
        ?>
      </select>
      <br><br>
      Seleccione un nuevo curso:
      <select name="codigocurso">
        <?php 
        if ($reg['codigocurso']=='1'){
          echo "<option value='1' selected>PHP</option>";
        }else{
          echo "<option value='1'>PHP</option>";
        }
        if ($reg['codigocurso']=='2'){
          echo "<option value='2' selected>ASP</option>";
        }else{
          echo "<option value='2'>ASP</option>";
        }
        if ($reg['codigocurso']=='3'){
          echo "<option value='3' selected>JSP</option>";
        }else{
          echo "<option value='3'>JSP</option>";
        }
        ?>
      </select>
      <br><br>
      <input type="submit" value="Actualizar">
    </form>
    <?php
    } else {
        echo "No existe el alumno ";
    }
  ?>
  <br><a id='volver' href="listadoAlumnos.php">Volver al listado</a><br>
</body>
</html>