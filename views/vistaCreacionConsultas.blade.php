@extends('plantillas.plantilla1')<!-- hacemos uso de la plantilla1  -->
@section('titulo')
    {{$titulo}}
@endsection
@section('encabezado')
    {{$encabezado}}
    <script>
        fecha.min = new Date().toISOString().split("T")[0];

    </script>
@endsection
@section('contenido')
<form  method="POST"  action="crearConsulta.php"> 
    <div class="container">
    <div class="row">
        <div class="col">

            <label class="text-left" for="fecha">Fecha </label> 
            @if(isset($consultaLibre)&& $consultaLibre==false)
            <input type="text" class="form-control" placeholder="Cambie la fecha y la hora" readonly>
            <input type="text" class="form-control" name="fecha" required min="<?=date('d-m-Y');?>" >
            
            @else
            <input type="date" class="form-control" min="<?=date('d-m-Y');?>" name="fecha" required >
            @endif
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
                @foreach($medicos as $item)
                    <option value={{$item->login}}>{{$item->login}}</option>
                @endforeach
            </select>

        </div>
        <div class="col">  
            <label class="text-left" for="DNI">DNI paciente </label>
            <select id="DNI" class="form-control" name="DNI" class="form-select" required >  
            @foreach($pacientes as $item2)

                    <option value={{$item2->DNI}}>{{$item2->DNI}}</option>
        
            
            @endforeach
            </select>
        </div>


    </div>
    <br>
    <div class="text-center">
    <button type="submit" class="btn btn-primary" name="crear" value="Crear">Crear</button> 
    <button type="reset" class="btn btn-success">Limpiar</button>
    <a href="gestionConsulta.php" class="btn btn-info" role="button">Volver</a>

    </div>

    </div>
</form>
@endsection