<?php
include("data_base.php");

if(isset($_POST['text_message']) && $_POST['text_message']!="" && $_POST['text_message']!=" ")
{
	//Принимаем переменную сообщения
	$message=$_POST['text_message'];
	$user_id = (int) $_POST['sub'];

	$db = new data_base();

	$message = mysqli_real_escape_string($db->connectBD(), $message);

	$query = "INSERT INTO chat_log (";
	$query .= " text_message , user_id ";
	$query .= ") VALUES (";
	$query .= " '$message' , $user_id )";

	$res=mysqli_query($db->connectBD(), $query);
}
?>