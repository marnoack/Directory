 <?php 
  date_default_timezone_set('America/Lima');
  header ('Content-type: text/html; charset=utf-8')
  ?>
  <!doctype html>
  <html lang="es">
  <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
   <link rel="stylesheet" href="css/uniform.css">
   <link rel="stylesheet" href="css/chosen.css">
   <link rel="stylesheet" href="css/unicorn.main.css">

   <link rel="stylesheet" href="css/mensajes.css">
  </head>

  <body>

  <?php

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];




    //$cn = mysqli_connect('localhost','root',''); 
    $cn = mysql_connect('localhost','xpertaver','xpertaver'); 
    //if (mysqli_connect_errno())
    //  {
    //  echo "Failed to connect to MySQL: " . mysqli_connect_error();
    //} else {
    if (mysql_connect()) {
      echo "Failed to connect to MySQL: " . mysql_connect();
    } else {

       //mysqli_select_db( $cn, 'empleados_xperta'); 
       //mysqli_set_charset( $cn ,"UTF8");
       mysql_select_db('empleados_xperta', $cn); 
       mysql_set_charset("UTF8", $cn);

       if ($dni != "") {
            $result = mysql_query("SELECT * FROM informacionpersonal WHERE informacionpersonal.nroDocumento = $dni;"); 
       } else  if ($nombre != "" &$apellido == "" ) {
             $result = mysql_query( "SELECT * FROM informacionpersonal WHERE informacionpersonal.nombre = \"$nombre\";"); 
       } else  if ($nombre == "" && $apellido != ""  ) {
             $result = mysql_query("SELECT * FROM informacionpersonal WHERE informacionpersonal.apellido1 = \"$apellido\";"); 
       } else if ($nombre != "" && $apellido != "" ) {
             $result = mysql_query("SELECT * FROM informacionpersonal WHERE apellido1 = \"$apellido\" AND nombre = \"$nombre\";"); 
       } else {
           echo "Necesita ingresar un dato !"; 
       }

      $data_array = array();
      if ($result) {
          if ($row = mysql_fetch_array($result)){

    //   $encoded_array = json_encode($row);
    //echo $encoded_array;
    //echo "<br>";
    //   $decoded_array = json_decode($encoded_array,true);
    //echo var_dump($decoded_array);
          echo "<div id='header'><h1>Directorio</h1></div>";
          echo "<div id='content'>";
          echo "<div id='content-header'><h1>Directorio</h1></div>";
          echo "<div id='breadcrumb'> <a href='index.php' class='tip-bottom' data-original-title='Ir al inicio'><i class='icon-home'></i>Inicio</a></div>";
          echo "<div class='container-fluid'>";
          echo "<div class='widget-box'>";
          echo "    <div class='widget-title'>";	
          echo "        <h5>Empleados</h5>  </div>";




          echo "<table id='tabla' class='table table-condensed table-bordered dataTable no-footer' role='grid' aria-describedby='tabla_info'>";
          echo "<thead>";
         // echo "<table id=\"t02\"> \n"; 
           echo "<tr>
        	<th >Nombre</th>
        	<th >Apellido</th>
        	<th >Telefono Celular</th>
        	<th >Correo Electronico</th>
        	<th >DNI</th>
        </tr> \n";  
       do { 
        $data_array[]= array( 'nombre'       => $row["nombre"],
            'apellido1'            => $row["apellido1"],
            'telefonoCel'   => $row["telefonoCel"],
            'correoElectronico'    => $row["correoElectronico"],
            'DNI' => $row["nroDocumento"] );

            echo "<tr><td style=\"width:10%\">".$row["nombre"]."</td>
        	<td>".$row["apellido1"]."</td>
        	<td>".$row["telefonoCel"]."</td>
        	<td>".$row["correoElectronico"]."</td>
        	<td>".$row["nroDocumento"]."</td>

          </tr> \n"; 
          
        } while ($row = mysql_fetch_array($result)); 
     

      echo "</table>";
      echo "<div class='widget-content nopadding'>";

      echo "</div>";
      echo "<div class='fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix ui-corner-bl ui-corner-br'>";

      echo "<div class='dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_full_numbers' id='tabla_paginate'>";
      echo "<a class='fg-button ui-button ui-state-default first ui-state-disabled' aria-controls='tabla' data-dt-idx='0' tabindex='0' id='tabla_first'>Primero</a>";
      echo "<a class='fg-button ui-button ui-state-default previous ui-state-disabled' aria-controls='tabla' data-dt-idx='1' tabindex='0' id='tabla_previous'>Anterior</a><span>";
      echo "<a class='fg-button ui-button ui-state-default ui-state-disabled' aria-controls='tabla' data-dt-idx='2' tabindex='0'>1</a></span>";
      echo "<a class='fg-button ui-button ui-state-default next ui-state-disabled' aria-controls='tabla' data-dt-idx='3' tabindex='0' id='tabla_next'>Siguiente</a>";
      echo "<a class='fg-button ui-button ui-state-default last ui-state-disabled' aria-controls='tabla' data-dt-idx='4' tabindex='0' id='tabla_last'>Último</a>";
      echo "</div></div>";

      echo "<div class='row-fluid'>";
      echo "<div id='footer' class='span12'> 	2017  <center><img src='img/logo.png' alt='' width='7%'></center>";
      echo "</div></div> </div>";



       // echo "</table> \n";
        echo "<br/>\n";
      
  if(isset($_REQUEST['export'])) {   
    descargarArchivo($data_array); 
  } else {}

 } else {
 
  echo "<div id='header'><h1>Directorio</h1></div>";
  echo "<div id='content'>";
  echo "<div id='content-header'><h1></h1></div>";
  echo "<div id='breadcrumb'> <a href='index.php' class='tip-bottom' data-original-title='Ir al inicio'><i class='icon-home'></i>Inicio</a></div>";
    echo "<h1><center>No se ha encontrado ningún registro !</center></h1>";
    echo "</div"; 
   } 
} else {
  echo "<div id='header'><h1>Directorio</h1></div>";
  echo "<div id='content'>";
  echo "<div id='content-header'><h1></h1></div>";
  echo "<div id='breadcrumb'> <a href='index.php' class='tip-bottom' data-original-title='Ir al inicio'><i class='icon-home'></i>Inicio</a></div>";
    echo "<h1><center> No se ha encontrado ningún registro !</center></h1>";
    echo "</div"; 
}
}



    ?>

    </form>
    </div>

    </body>
    </html>
