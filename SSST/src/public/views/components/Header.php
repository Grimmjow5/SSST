<?php
if (php_sapi_name() == 'cli') {
    // El script se está ejecutando desde la línea de comandos
    echo "Ejecutando en la línea de comandos.\n";
} else {
    // El script se está ejecutando en un servidor web
    echo "Ejecutando en un servidor web.\n";
}

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
<link href="src/public/css/bootstrap.min.css" rel="stylesheet">
<link href="src/public/css/dataTables.dataTables.css" rel="stylesheet">
<link href="src/public/css/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="src/public/css/buttons.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  </head>
  <body>
