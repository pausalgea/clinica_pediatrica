<?php $__env->startSection('titulo'); ?>
<?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('encabezado'); ?>
<?php echo e($encabezado); ?>

<script>
    fecha.max = new Date().toISOString().split("T")[0];


function cambiar()
{

    document.getElementById('label_asegurado').innerHTML='Número de seguro';

}
function cambiar2()
{

    document.getElementById('label_asegurado').innerHTML='Número de seguridad social';

}
if(document.getElementById('no_asegurado').checked)
{
    document.getElementById('label_asegurado').innerHTML='Número de seguridad social';

}
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>
<form method="POST" action="crearPaciente.php">
    <div class="container">
        <div class="row">
            <div class="col">


                <?php if(isset($DNI)&& $DNI==false): ?>
                <label class="text-left" for="pacienteACrear">Ya hay un paciente con ese DNI en el sistema</label>
                <input type="text" class="form-control" name="pacienteACrear" required readonly placeholder="Ya existe un paciente con ese DNI en el sistema">

                <?php else: ?>
                <label class="text-left" for="DNI">DNI </label>
                <input type="text" class="form-control" name="DNI" required>
                <?php endif; ?>
            </div>
            <div class="col">
                <label class="text-left" for="nombre">Nombre </label>
                <input type="text" class="form-control" name="nombre" required>
            </div>



        </div>
        <div class="row">
            <div class="col">

                <label class="text-left" for="apellidos">Apellidos </label>
                <input type="text" class="form-control" name="apellidos" class="form-select" required>


            </div>
            <div class="col">
                <label class="text-left" for="fecha_nacimiento">Fecha de nacimiento </label>
                <input type="date" class="form-control" max="<?= date('d-m-Y'); ?>" name="fecha_nacimiento" required>
            </div>

            <div class="col">
                <label class="text-left" for="telefono">Teléfono </label>
                <input type="text" class="form-control" name="telefono" required>
            </div>


        </div>
        <div class="row">
            <div class="col">
                ¿El paciente es asegurado?
                <br>
                <input type="radio" name="asegurado" id="asegurado" value="si" required onclick="cambiar()">
                <label  for="asegurado">Sí</label>
                <input type="radio" name="asegurado" id="no_asegurado" value="no"  onclick="cambiar2()">
                <label  for="no_asegurado">No</label>
            </div>
                <div class="col">
                    <label class="text-left" for="asegurado" id="label_asegurado" value="Número de seguro" ></label>
                    <input type="text" class="form-control" id="texto_asegurado" name="num_seguro" class="form-select" >

                </div>

            </div>
        
        
        
        <br>
        <button type="submit" class="btn btn-primary" name="crear" value="Crear">Crear</button>
        <button type="reset" class="btn btn-success">Limpiar</button>
        <a href="gestionPaciente.php" class="btn btn-info" role="button">Volver</a>



    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>