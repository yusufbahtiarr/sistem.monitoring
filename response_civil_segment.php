<?php
//include db configuration file
include_once("dbconnection.php");

if(isset($_POST["id_proyek"]) && strlen($_POST["id_proyek"])>0) 
{	//check $_POST["content_txt"] is not empty

	//sanitize post value, PHP filter FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH Strip tags, encode special characters.
	$contentToSave = filter_var($_POST["content_txt"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
	
	// Insert sanitize string in record
	$insert_row = $mysqli->query("INSERT INTO add_delete_record(content) VALUES('".$contentToSave."')");
	
	if($insert_row)
	{
		 //Record was successfully inserted, respond result back to index page
		  $my_id = $mysqli->insert_id; //Get ID of last inserted row from MySQL
		  echo '<option id="item_'.$my_id.'">';
		  echo $contentToSave.'</option>';
		  $mysqli->close(); //close db connection

	}else{
		
		//header('HTTP/1.1 500 '.mysql_error()); //display sql errors.. must not output sql errors in live mode.
		header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
		exit();
	}

}
?>