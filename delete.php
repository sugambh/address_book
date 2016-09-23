<?php
    include('connection.php');
	$q = "DELETE FROM contacts WHERE id =  :id";
	$stmt = $db->prepare($q);
	$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
	if ($stmt->execute()) {
		   header('Location: '."index.php");
     }
?>
