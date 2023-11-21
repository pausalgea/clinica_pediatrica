<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('encabezado'); ?>
    <?php echo e($encabezado); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>
<form  method="POST"  action="establecerTarifa.php"> 
    <div class="float float-right d-inline-flex mt-4">
    
        <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
        </svg>
        
        <input type="text" size="2px" value=<?php echo e($nombre); ?> class="form-control mr-4  text-info font-weight-bold" disabled=""><!--mostramos el usuario conectado-->
        <a style="float:right"   class="btn btn-secondary " href="logout.php" role="button">Cerrar sesión</a>
    
    </div>
    <br>
    <br>
    <hr>
    <div class="row">
        <div class="col">
            <label class="text-left" for="tarifa_no" >Tarifa para no asegurado </label> 
            <input type="text" class="form-control" placeholder="Introduzca tarifa para no asegurado " name="tarifa_no" required >
        </div>
        <div class="col">    
            <label class="text-left" for="tarifa_a" >Tarifa para no asegurado </label> 
            <input type="text" class="form-control" placeholder="Introduzca tarifa para no asegurado " name="tarifa_a" required >
            </select>
        </div>

    </div>
    <br>
    <div class="text-center">
 
    <button type="submit" class="btn btn-primary" name="establecer" value="Establecer">Establecer nuevas tarifas</button>

    <button type="reset" class="btn btn-success">Limpiar</button>


    <a href="usuarios.php" class="btn btn-info" role="button">Volver</a>

    


    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>