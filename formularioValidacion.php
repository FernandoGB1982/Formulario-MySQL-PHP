<!DOCTYPE HTML>  
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: rgb(185, 169, 169);
    }

    h1{
      color: white;
      text-align: center;
      margin: 0 auto;
      font-family: Georgia, 'Times New Roman', Times, serif;
      font-style: italic, bold;
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

$nombre = $apellido1 = $apellido2 = $nif = $fechaNacimiento = $email = $provincia = $twitter = $sexo = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = test_input($_POST["nombre"]);
  $apellido1 = test_input($_POST["apellido1"]);
  $apellido2 = test_input($_POST["apellido2"]);
  $nif = test_input($_POST["nif"]);
  $fechaNacimiento = test_input($_POST["fechaNacimiento"]);
  $email = test_input($_POST["email"]);
  $twitter = test_input($_POST["twitter"]);
  $provincia= test_input($_POST["provincia"]);
  $sexo = test_input($_POST["sexo"]);

  $numero=substr($nif, 0,8);
  $letra=substr($nif, -1);
  $numeros=intval($numero);
  $cadena="TRWAGMYFPDXBNJZSQVHLCKE";
  $resto=$numeros%23;

  if($letra!=$cadena[$resto]){
    $nif="NIF ERRONEO...";
  }
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h1>PHP Formulario de Validacion</h1>
<hr>
<h2>Entrada:</h2><br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <p>
  Nombre: <br><input type="text" pattern="^[A-ZÁÉÍÓÚÑ][a-záéíóúñ\s]*$" maxlength="40" name="nombre" required>
  <br><br>
  Primer Apellido: <br><input type="text" pattern="^[A-ZÁÉÍÓÚÑ][a-záéíóúñ\s]*$" maxlength="40" name="apellido1" required>
  <br><br>
  Segundo Apellido: <br><input type="text" pattern="^[A-ZÁÉÍÓÚÑ][a-záéíóúñ\s]*$" maxlength="40" name="apellido2" required>
  <br><br>
  NIF: <br><input type="text" placeholder="12345678A" pattern="^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]{1}$" name="nif" required>
  <br><br>
  Fecha Nacimiento: <br><input type="date" name="fechaNacimiento" required>
  <br><br>
  E-mail: <br><input type="email" placeholder="*****@*****.***" pattern="[a-zñ0-9._%+-]+@[a-z0-9.-]+\.[a-zñ]{2,3}$" name="email"  required>
  <br><br>
  Twitter: <br><input type="text" name="twitter"  placeholder="@***************" pattern="^@([A-Za-z0-9_.]{1,15})$" required>
  <br><br>
  Provincia: <br><input type="text" name="provincia" maxlength="40" required>
  <br><br>
  Sexo:
  <input type="radio" name="sexo" value="Mujer" >Mujer
  <input type="radio" name="sexo" value="Hombre">Hombre
  <input type="radio" name="sexo" value="Otro" checked>Otro
  <br><br>
  <input type="submit" name="submit" value="Aceptar">  
  </p>
</form>

<div id="salida"><br>
<h2>Salida:</h2><br>
<?php
echo 'Nombre: '.$nombre;
echo "<br>";
echo 'Primer Apellido: '.$apellido1;
echo "<br>";
echo 'Segundo Apellido: '.$apellido2;
echo "<br>";
echo 'NIF: '.$nif;
echo "<br>";
echo 'Fecha de Nacimiento: '.$fechaNacimiento;
echo "<br>";
echo 'Email: '.$email;
echo "<br>";
echo 'Twitter: '.$twitter;
echo "<br>";
echo 'Provincia: '.$provincia;
echo "<br>";
echo 'Sexo: '.$sexo;
echo "<br>";
?>
<div>
</body>
</html>