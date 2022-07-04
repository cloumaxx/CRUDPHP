<?php
    include 'funciones.php';

    $config = include 'config.php';

    $resultado=[
        'error'=>false,
        'mensaje'=> ''
    ];

    if(!isset($_GET['id'])){
        $resultado['error']=true;
        $resultado['mensaje']="El alumno no existe";
    }
if (isset($_POST['enviar'])){
    try {
        $dsn = 'mysql:host='.$config['db']['host'] . ';dbname='.$config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

        $alumno = [
            "id" => $_GET['id'],
            "nombre" => $_POST['nombre'],
            "apellido" => $_POST['apellido'],
            "edad" => $_POST['edad'],
            "numContacto" =>$_POST['numContacto'],
            "email" => $_POST['email'],
            "paginaWeb" => $_POST['paginaWeb']
        ];

        $consultaSQL = "UPDATE alumnos SET 
                   nombre = '".$alumno['nombre']."',
                   apellido = '".$alumno['apellido']."',
                   edad = ".$alumno['edad'].",
                   numContacto = ".$alumno['numContacto'].",
                   email = '".$alumno['email']."',
                   paginaWeb = '".$alumno['paginaWeb']."'
        
                   WHERE id = ".$alumno['id']. ";" ;
        $consulta = $conexion->prepare($consultaSQL);
        $consulta->execute();

if (isset($_POST['submit']) && !$resultado['error']) {
    ?>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    El alumno ha sido actualizado correctamente
                </div>
            </div>
        </div>
    </div>
    <?php
}



    }catch (PDOException $error){
        $resultado['error']=true;
        $resultado['mensaje']=$error->getMessage();
    }
}
try {

    $dsn = 'mysql:host='.$config['db']['host'] . ';dbname='.$config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $id=$_GET['id'];
    $consultaSQL = "SELECT * FROM alumnos WHERE id=".$id;

    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute();

    $alumno = $sentencia->fetch(PDO::FETCH_ASSOC);

    if(!$alumno){
        $resultado['error']=true;
        $resultado['mensaje']='Alumno no encontrado';
    }

}catch (PDOException $error){
        $resultado ['error']=true;
        $resultado['mensaje']=$error->getMessage();
}
?>
<?php require "templates/header.php";?>
<?php
if ($resultado['error']) {
    ?>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= $resultado['mensaje'] ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<?php
if(isset($alumno) && $alumno){
    ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-4">Editando alumno <?= escape($alumno['nombre']).' '.escape($alumno['apellido'])?>   </h2>
            <hr>
            <form method="post">
                <div class="form-group">
                    <label for="nombre"> Nombre:</label>
                    <input type="text" name="nombre" id="nombre"  value="<?= escape($alumno['nombre']) ?> "class="form-control">
                </div>
                <div class="form-group">
                    <label for="apellido"> Apellido:</label>
                    <input type="text" name="apellido" id="nombre" class="form-control" value="<?= escape($alumno['apellido']) ?>">
                </div>
                <div class="form-group">
                    <label for="edad"> Edad:</label>
                    <input type="number" name="edad" id="edad" class="form-control" value="<?= escape($alumno['edad']) ?>">
                </div>
                <div class="form-group">
                    <label for="numContact"> Numero de contacto:</label>
                    <input type="number" name="numContacto" id="numContacto" class="form-control" value="<?= escape($alumno['numContacto']) ?>">
                </div>
                <div class="form-group">
                    <label for="email"> Correo:</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= escape($alumno['email']) ?>">
                </div>
                <div class="form-group">
                    <label for="paginaWeb"> Pagina Web:</label>
                    <input type="text" name="paginaWeb" id="paginaWeb" class="form-control " value="<?= escape($alumno['paginaWeb']) ?>">
                </div>
                <div class="form-group">
                    <input type="submit" name="enviar" class="btn btn-primary" value="Enviar">
                    <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
                </div>

            </form>
        </div>
    </div>
</div>
<?php
}
?>
<?php require "templates/footer.php";?>
