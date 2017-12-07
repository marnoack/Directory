<?php
header ('Content-type: text/html; charset=utf-8');
?>
<!doctype html>
<html lang="es">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

 <link rel="stylesheet" href="css/bootstrap.min.css">
 <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
 <link rel="stylesheet" href="css/unicorn.login.css">
 <link rel="stylesheet" href="css/unicorn.main.css">
 <link rel="stylesheet" href="css/mensajes.css">


</head>

<body>

<?php
date_default_timezone_set('America/Lima');
?>

<div id=logo>
<h1>Busqueda en el Directorio</h1>
</div>
<div id="loginbox">
  <form  id="loginform" class="form-vertical" method='post' action='busca-registro.php'>
      <p>Ingrese apellido paterno y primer nombre o numero de DNI</p>

  <div class="control-group">
     <div class="controls">
         <div class="input-prepend">
            <span class="add-on"><i class="icon-user"></i></span><input type="text" name="apellido" oninvalid="setCustomValidity('Ingresar apellido')" onchange="try{setCustomValidity('');}catch(e){}" required="" placeholder="Apellido Paterno">
           </div>
        </div>
    </div>

  <div class="control-group">
     <div class="controls">
         <div class="input-prepend">
            <span class="add-on"><i class="icon-user"></i></span><input type="text" name="nombre" placeholder="Primer Nombre">
           </div>
        </div>
    </div>
  <div class="control-group">
     <div class="controls">
         <div class="input-prepend">
            <span class="add-on"><i class="icon-user"></i></span><input type="text" oninvalid="setCustomValidity('Ingresar numero de DNI completo')" onchange="try{setCustomValidity('');}catch(e){}" pattern="[0-9]{8}" name="dni" maxlength="8" onkeyup="this.value=this.value.replace(/[^\d]+/,'')" placeholder="Numero DNI">
           </div>
        </div>
    </div>

  <div class="form-actions">
<span class="pull-left">
  <?php echo date("d/m/Y  h:i a");?>
</span>
  <input type="submit" class="btn btn-inverse" name="buscar" value="Buscar">

</div>

</form>
</div>
</body>
</html>
