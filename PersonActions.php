<?php
session_start();
try
{
	//Open database connection
	$dbconn = pg_connect("host=ec2-54-235-180-39.compute-1.amazonaws.com port=5432 dbname=d3hj8254l1030h user=ssiwwumdmbosbc password=hZj0Nc0d_dafo2-Djmd1eZZXRt sslmode=require options='--client_encoding=UTF8'") or die('Could not connect: ' . pg_last_error());
	

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get records from database
		if($_SESSION["tipo_usuario"]=='1'){
		$result = pg_query("SELECT * FROM mensajes;");
		}
		
		if($_SESSION["tipo_usuario"]=='2'){
		$result = pg_query("SELECT * FROM mensajes where usuariousuario='".$_SESSION["usuario"]."';");
		}
		//Add all records to an array
		$rows = array();
		while($row = pg_fetch_array($result))
		{
		    $rows[] = $row;
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}

	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
		$result = pg_query("UPDATE mensajes SET texto = '" . $_POST["texto"] . "' WHERE id = " . $_POST["id"] . ";") ;

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = pg_query("DELETE FROM mensajes WHERE id = " . $_POST["id"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	//Close database connection
	pg_close($con);

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>