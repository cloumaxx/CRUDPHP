<?php include "templates/header.php"; ?>
<?php
include 'funciones.php';

$error = false;
$config = include 'config.php';
try{
    $dsn = 'mysql:host='.$config['db']['host'] . ';dbname='.$config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $consultaSQL = "SELECT * FROM alumnos";
    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute();

    $listado = $sentencia->fetchAll();
}catch (PDOException $error){
    $error = $error->getMessage();
}
?>

<?php
if ($error) {
    ?>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
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
            <h2 class="mt-3"> ALUMNOS REGISTRADOS</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>EDAD</th>
                    <th>NUMERO CONTACTO</th>
                    <th>EMAIL</th>
                    <th>PAGINA WEB</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($listado && $sentencia->rowCount()>0){
                    foreach ($listado as $fila){
                        ?>
                        <tr>
                            <td><?php echo escape($fila['id']);?></td>
                            <td><?php echo escape($fila['nombre']);?></td>
                            <td><?php echo escape($fila['apellido']);?></td>
                            <td><?php echo escape($fila['edad']);?></td>
                            <td><?php echo escape($fila['numContacto']);?></td>
                            <td><?php echo escape($fila['email']);?></td>
                            <td><?php echo escape($fila['paginaWeb']);?></td>

                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>