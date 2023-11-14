<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('encabezado'); ?>
    <?php echo e($encabezado); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>
<form  method="POST"  action="modificarUsuario.php"> 
    <div class="container">
    <div class="row">
        <div class="col">
            <label class="text-left" for="loginAModificar">Login </label> 
            <input type="text" class="form-control" name="loginAModificar" value=<?php echo e($login); ?> placeholder=<?php echo e($login); ?> readonly>
        </div>
        <div class="col">
            <label class="text-left" for="nombre">Nombre </label> 
            <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="col">
            <label class="text-left" for="nombre">Apellidos </label> 
            <input type="text" class="form-control" name="apellidos" required >
        </div>
    </div>
    <div class="row">
        <div class="col">  
            <label class="text-left" for="password">Password </label>
            <input type="text" class="form-control" name="password" placeholder="Introduzca una contraseña nueva" required>

        </div>
        <div class="col">    
            <label class="text-left" for="tipo">Tipo </label>
            <select id="tipo" class="form-control" name="tipo" class="form-select" required >
                    <option value="administrador">Administrador</option>
                    <option value="administrativo">Administrativo</option>
                    <option value="médico">Médico</option>
            </select>
        </div>

        <div class="col">  
            <label class="text-left" for="DNI">DNI </label>
            <input type="text" class="form-control" name="DNI" placeholder="Introduzca un DNI nuevo" required>

        </div>

    </div>
    <br>
    <button type="submit" class="btn btn-primary" name="modificar" value="Modificar">Modificar</button> 
    <button type="reset" class="btn btn-success">Limpiar</button>
    <a href="usuarios.php" class="btn btn-info" role="button">Volver</a>



    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>