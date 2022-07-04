<?php include "templates/header.php" ?>

<?php
include 'funciones.php';

$error = false;
$config = include 'config.php';
try{


    $dsn = 'mysql:host='.$config['db']['host'] . ';dbname='.$config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    if(isset($_POST['operacion'])){
        if($_POST['operacion']=='edad' || $_POST['operacion']=='numContacto'){
            $consultaSQL = "SELECT * FROM `alumnos` WHERE `" . $_POST['operacion'] . "` = " . $_POST['caracter'].";" ;

        }else if($_POST['submit']=='vaciar'){
            $consultaSQL = "SELECT * FROM alumnos ";
        }else {
            $consultaSQL = "SELECT * FROM `alumnos` WHERE `" . $_POST['operacion'] . "` LIKE '" . $_POST['caracter'] . "'";
        }
    } else{

        $consultaSQL = "SELECT * FROM alumnos ";

    }
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
    <div>
        <h1>Realizar busqueda por alguna caracteristica</h1>
        <p> Ingresa como quieres filtrar la tabla</p>
    </div>

</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <form method="post" class="form-inline">
                <div class="row">
                    <p>
                        <input type="radio" name="operacion" value="id"> Id
                        <input type="radio" name="operacion" value="nombre"> Nombre
                        <input type="radio" name="operacion" value="apellido"> Apellido
                        <input type="radio" name="operacion" value="edad"> Edad
                        <input type="radio" name="operacion" value="numContacto"> Numero de Contacto
                        <input type="radio" name="operacion" value="email"> Email
                        <input type="radio" name="operacion" value="paginaWeb"> Pagina Web
                        <br><br><br><br><br><br><br>
                    </p>
                </div>
                <div class="form-group mr-3">
                    <input type="text" id="caracter" name="caracter" placeholder="Buscar" class="form-control">
                </div>
                <div>
                    <button type="submit" name="submit" class="btn btn-primary">Ver resultados</button>
                    <button type="submit" name="submit" class="btn btn-primary"  value="vaciar">Quitar Filtros</button>
                    <a href="index.php" class="btn btn-primary  ">Volver al menu principal</a>
                    <hr>
                </div>

            </form>

        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Resultados</h2>
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
                    <th>ACCIONES</th>
                    <th></th>
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
                            <td>
                                <a href="<?= 'borrar.php?id=' . escape($fila["id"]) ?>" . >🗑️  Borrar</a>
                                <a href="<?= 'editar.php?id=' . escape($fila["id"]) ?>" . >✏️Editar</a>
                            </td>
                            <td></td>
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