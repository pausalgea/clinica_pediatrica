@extends('plantillas.plantilla1')
@section('titulo')
{{$titulo}}
@endsection
@section('encabezado')
{{$encabezado}}
<script>
    fecha.max = new Date().toISOString().split("T")[0];
</script>

@endsection
@section('contenido')
<form method="POST" action="modificarPaciente.php">
    <div class="container">
        <div class="row">
            <div class="col">
                <label class="text-left" for="DNI">DNI del paciente </label> 4
<<<<<<< HEAD
                <input type="text" class="form-control" name="DNI" value={{$DNI}} placeholder={{$DNI}} readonly>
=======
                <input type="text" class="form-control" name="DNI" value={{DNI}} placeholder={{$DNI}} readonly>
>>>>>>> f9b92fbb1822d02bfb5604049a934146d08a26df
            </div>
            <div class="col">
                <label class="text-left" for="nombre">Nombre </label>
                <input type="text" class="form-control" name="nombre" required />

            </div>
            <div class="col">
                <label class="text-left" for="apellidos">Apellidos </label>
                <input type="text" class="form-control" name="apellidos" required />

            </div>
        </div>
        <div class="row">
            <div class="col">
                <label class="text-left" for="fecha">Fecha de nacimiento </label>
                <input type="date" class="form-control" max="<?= date('d-m-Y'); ?>" name="fecha_nacimiento" id="fecha_nacimiento" required />

            </div>
            <div class="col">
                <label class="text-left" for="telefono">Teléfono </label>
                <input type="text" class="form-control" name="telefono" required />

            </div>


        </div>
        <br>
        <button type="submit" class="btn btn-primary" name="modificar" value="Modificar">Modificar</button>
        <button type="reset" class="btn btn-success">Limpiar</button>
        <a href="gestionPaciente.php" class="btn btn-info" role="button">Volver</a>



    </div>
</form>
@endsection