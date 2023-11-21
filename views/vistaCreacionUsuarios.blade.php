@extends('plantillas.plantilla1')
@section('titulo')
    {{$titulo}}
@endsection
@section('encabezado')
    {{$encabezado}}
@endsection
@section('contenido')
<form  method="POST"  action="crearUsuario.php"> 
    <div class="container">
    <div class="row">
        <div class="col">

            <label class="text-left" for="nombre">Login </label> 
            @if(isset($loginLibre)&& $loginLibre==false)
            <input type="text" class="form-control" name="loginACrear" required readonly placeholder="Cambie el login, no está disponible" >
            <input type="text" class="form-control" name="loginACrear" required placeholder="Introduzca un login nuevo" >
            @else
            <input type="text" class="form-control" name="loginACrear" required placeholder="Introduzca un login nuevo" >
            @endif
        </div>
        <div class="col">  
            <label class="text-left" for="password">Password </label>
            <input type="text" class="form-control" name="password" placeholder="Introduzca una contraseña nueva" required>

        </div>

            <div class="col">
                <label class="text-left" for="nombre" >Nombre </label> 
                <input type="text" class="form-control" placeholder="Nombre de usuario " name="nombre" required>
            </div>


        </div>
    </div>
    <div class="row">
        <div class="col">
            <label class="text-left" for="nombre" >Apellidos </label> 
            <input type="text" class="form-control" placeholder="Apellidos de usuario " name="apellidos" required >
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
    <div class="text-center">
 
    <button type="submit" class="btn btn-primary" name="crear" value="Crear">Crear</button>

    <button type="reset" class="btn btn-success">Limpiar</button>


    <a href="usuarios.php" class="btn btn-info" role="button">Volver</a>

    


    </div>
</form>
@endsection