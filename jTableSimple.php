<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sesión Iniciada. Usuario:<?php echo $_SESSION["usuario"]?></title>
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
    
    <link rel="stylesheet" type="text/css" media="all" href="style.css">
    <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<link href="scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
	<?php if($_SESSION["tipo_usuario"]=='2'){?>
	<script type="text/javascript">
		$(document).ready(function () {

			
			$('#MensajeTableContainer').jtable({
				title: 'Mis Mensajes',
				actions: {
					listAction: 'PersonActions.php?action=list',
					createAction: 'PersonActions.php?action=create',
					updateAction: 'PersonActions.php?action=update',
					deleteAction: 'PersonActions.php?action=delete'
				},
				fields: {
					id: {
						title:'ID Mensaje',
						key: true,
						create: false,
						edit: false,
						list: true
					},
					texto: {
						title: 'Mensaje',
						width: '40%',
						edit: true,
						list: true
					},
					usuariousuario: {
						title: 'Usuario',
						width: '20%',
						list:true,
						edit:false,
						create:false
					}
				}
			});


			$('#MensajeTableContainer').jtable('load');

		});

	</script>
	<?php }?>
    
    
    
    <?php if($_SESSION["tipo_usuario"]=='1'){?>
	<script type="text/javascript">
		$(document).ready(function () {

			
			$('#MensajeTableContainer').jtable({
				title: 'Mensajes de Usuarios',
				actions: {
					listAction: 'PersonActions.php?action=list',
					createAction: 'PersonActions.php?action=create',
					updateAction: 'PersonActions.php?action=update',
					deleteAction: 'PersonActions.php?action=delete'
				},
				fields: {
					id: {
						title:'ID Mensaje',
						key: true,
						create: false,
						edit: false,
						list: true
					},
					texto: {
						title: 'Mensaje',
						width: '40%',
						edit: false,
						list: true,
						create: false
					},
					usuariousuario: {
						title: 'Usuario',
						width: '20%',
						list:true,
						edit:false,
						create:false
					}
				}
			});


			$('#MensajeTableContainer').jtable('load');

		});

	</script>
	<?php }?>
  </head>
  <body>
  <p class="p1"><strong>Sesión iniciada como:</strong> <?php echo $_SESSION["usuario"]?></p>
  <div id="MensajeTableContainer" style="width: 600px;">
    <p>
      <?php 

 
 if(isset($_POST["enviar"]))
{
	$dbconn = pg_connect("host=ec2-54-235-180-39.compute-1.amazonaws.com port=5432 dbname=d3hj8254l1030h user=ssiwwumdmbosbc password=hZj0Nc0d_dafo2-Djmd1eZZXRt sslmode=require options='--client_encoding=UTF8'") or die('Could not connect: ' . pg_last_error());
			
	 $result = pg_query($dbconn,"INSERT INTO mensajes(texto, usuariousuario) VALUES('". $_POST["mensaje"] ."','". $_SESSION["usuario"]."')") or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
header("location:jTableSimple.php");	 
	} 
	if($_SESSION["tipo_usuario"]=='2'){
	?>
    </p>
    <form action="" method="post" name="form1" class="p1" id="form1">
      <span class="p1">Mensaje:</span>
<input name="mensaje" type="text" id="mensaje" size="60" />
      <input type="submit" name="enviar" id="enviar" value="Enviar"  class="flatbtn-blu hidemodal"/>
    </form>
    <p>&nbsp;</p>
    <?php }?>
  </div>
  <p><a href="c_sesion.php">Cerrar Sesión</a></p>
  <p>&nbsp;</p>
  </body>
</html>
