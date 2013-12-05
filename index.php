<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Ejemplo POSTGRES en la Nube. Base de Datos 2 2012-2</title>
  <link rel="stylesheet" type="text/css" media="all" href="style.css">
  <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="js/jquery.leanModal.min.js"></script>
</head>

<body>

      <center>
        <p>&nbsp;</p>
        <p>Ejemplo Postgres en la Nube con HerokuPostgres y PHP</p>
        <p><a href="#loginmodal" class="flatbtn" id="modaltrigger">Iniciar</a></p>
       
          <?php 
if(isset($_POST["acceder"]))
{
    
		$dbconn = pg_connect("host=ec2-54-235-180-39.compute-1.amazonaws.com port=5432 dbname=d3hj8254l1030h user=ssiwwumdmbosbc password=hZj0Nc0d_dafo2-Djmd1eZZXRt sslmode=require options='--client_encoding=UTF8'") or die('Could not connect: ' . pg_last_error());
		
	  echo "<script type='text/javascript'> alert('EPaa');</script>";

	
	$result = pg_query("SELECT * FROM usuario where usuario='".$_POST["user"]."' and clave='".$_POST["pass"]."'") or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
	
	if($result){
		
		$row = pg_fetch_array($result);	
			
    	$_SESSION["usuario"]=$_POST["user"];
		$_SESSION["tipo_usuario"]=$row['tipo_usuarioid'];
			
		echo "Usuario Autenticado. Iniciando...";
		
		?>
          <script language="javascript">
        document.location.href="jTableSimple.php";
          </script>
          <?php
		}
		
	}
?>
      </center>
<div id="loginmodal" style="display:none;">
  <h1>Autenticación</h1>
    <form id="form1" name="form1" method="post" action="">
          <p>Usuario: 
            <label for="user"></label>
            <input type="text" name="user" id="user" class="txtfield"/>
          </p>
          <p>Clave:
            <input type="password" name="pass" id="pass" class="txtfield" />
          </p>
          <p>
            <input type="submit" name="acceder" id="acceder" value="Acceder" class="flatbtn-blu hidemodal"/>
          </p>
        </form>
</div>
<script type="text/javascript">
$(function(){
  $('#loginform').submit(function(e){
    return false;
  });
  
  $('#modaltrigger').leanModal({ top: 110, overlay: 0.45, closeButton: ".hidemodal" });
});
</script>
</body>
</html>