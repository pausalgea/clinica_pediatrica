<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('encabezado'); ?>
    <?php echo e($encabezado); ?>

    <script>
        fecha.min = new Date().toISOString().split("T")[0];

    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>
<form  method="POST"  action="crearConsulta.php"> 
    <div class="container">
    <div class="row">
        <div class="col">

            <label class="text-left" for="fecha">Fecha </label> 
            <?php if(isset($consultaLibre)&& $consultaLibre==false): ?>
            <input type="text" class="form-control" placeholder="Cambie la fecha y la hora" readonly>
            <input type="text" class="form-control" name="fecha" required min="<?=date('d-m-Y');?>" >
            
            <?php else: ?>
            <input type="date" class="form-control" min="<?=date('d-m-Y');?>" name="fecha" required >
            <?php endif; ?>
        </div>
            <div class="col">
                <label class="text-left" for="nombre">Hora </label> 
                <input type="time" class="form-control" name="hora" min="09:00" max="18:00" step="1800" required>
            </div>


        
    </div>
    <div class="row">
        <div class="col">    
            
            <label class="text-left" for="login_medico">Login médico </label>
            <select id="login_medico" class="form-control" name="login_medico" class="form-select" required >
                <?php $__currentLoopData = $medicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value=<?php echo e($item->login); ?>><?php echo e($item->login); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

        </div>
        <div class="col">  
            <label class="text-left" for="DNI">DNI paciente </label>
            <select id="DNI" class="form-control" name="DNI" class="form-select" required >  
            <?php $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option value=<?php echo e($item2->DNI); ?>><?php echo e($item2->DNI); ?></option>
        
            
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>


    </div>
    <br>
    <button type="submit" class="btn btn-primary" name="crear" value="Crear">Crear</button> 
    <button type="reset" class="btn btn-success">Limpiar</button>
    <a href="gestionConsulta.php" class="btn btn-info" role="button">Volver</a>



    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>