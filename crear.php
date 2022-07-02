<?php
include 'funciones.php';
if (isset($_POST['enviar'])){
    $resultado = [
      'error' => false,
      'mensaje' => 'Alumno: '.escape($_POST['nombre']). ' se agrego con exito'
    ];
    $config = include 'config.php';
    try {
        $dsn = 'mysql:host='.$config['db']['host'] . ';dbname='.$config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        $alumnoNuevo= array(
                "nombre" =>$_POST['nombre'],
                "apellido"=>$_POST['apellido'],
                "edad"=>$_POST['edad'],
                "numContact"=>$_POST['numContact'],
                "correo"=>$_POST['correo'],
                "paginaWeb"=>$_POST['paginaWeb']
        );
        $consultaSQL = "INSERT INTO alumnos(nombre,apellido,edad,numContacto,email,paginaWeb)";
        $consultaSQL.= "values (:".implode(", :",array_keys($alumnoNuevo)).")";

        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute($alumnoNuevo);
    }catch (PDOException $error){
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();

    }
}
?>
<?php  include "templates/header.php";?>
<?php
    if (isset($resultado)){
        ?>
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-<?=$resultado['error']?>" role="alert">
                            <?= $resultado['mensaje']?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
        ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="crear.php" class="btn btn-primary mt-4">
                Crar alumno
            </a>
            <form method="post">
                <div class="form-group">
                    <label for="nombre"> Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="apellido"> Apellido:</label>
                    <input type="text" name="apellido" id="nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="edad"> Edad:</label>
                    <input type="number" name="edad" id="edad" class="form-control">
                </div>
                <div class="form-group">
                    <label for="numContact"> Numero de contacto:</label>
                    <input type="number" name="numContact" id="numContact" class="form-control">
                </div>
                <div class="form-group">
                    <label for="correo"> Correo:</label>
                    <input type="email" name="correo" id="correo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="paginaWeb"> Pagina Web:</label>
                    <input type="text" name="paginaWeb" id="paginaWeb" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="enviar" class="btn btn-primary" value="Enviar">
                    <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "templates/footer.php";?>