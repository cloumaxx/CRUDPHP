<!DOCTYPE html>
<html lang="es">
<head>
    <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">

    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Aplicación CRUD PHP</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>

<body>
    <h1 align="center">Aplicación CRUD PHP uno<br></h1>

    <?php include "templates/header.php"; ?>
    <!-- Aquí el código HTML de la aplicación -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="crear.php" class="btn btn-primary mt-4">Crear alumno</a>
            <hr>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="listadoAlumno.php" class="btn btn-primary mt-4">Ver alumnos registrados</a>
                <hr>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="busquedaFiltrada.php" class="btn btn-primary mt-4">Busqueda</a>
                <hr>
            </div>
        </div>
    </div>


    <?php include "templates/footer.php"; ?>

    <form method="post" action="action.php">Ingresa tú nombre: <input name="ingresoNombre" type="text" value="" /></form>
    <form method="post" action="action2.php">Ingresa tú apellido: <input name="ingresoApellido" type="text" value="" /></form>
    <form method="post" action="action3.php">Ingresa tú numero de contacto: <input name="ingresoNumContact" type="tel" value="" /></form>
    <form method="post" action="action4.php">Ingresa tú correo: <input name="ingresoCorreo" type="email" value="" /></form>
    <form method="post" action="action5.php">Ingresa alguna pagina web: <input name="ingresoUrl" type="url" value="" /></form>
    <button type="submit" name="prueba">Click me</button>
    <?php
    $ip=gethostbyname('http://crudenphp.localhost/CrudPhp/');
    echo $ip;
    ?>
</body>
</html>