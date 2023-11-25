<!doctype html><!-- Plantilla que vamos a usar de base para la aplicación establecemos elementos comunes a las páginas
    el color de fondo la letra, etc...-->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- css para usar Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>@yield('titulo')</title>
</head>
<body style="background:#30a3e6;color=#ffffff;">

<div class="container" style="text-align:center;font-size:25px;color:white;padding-top:1%;">
    @yield('encabezado')
</div>
<div class="container">
    @yield('contenido')
</div>

</body>
</html>