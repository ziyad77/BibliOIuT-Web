<?php
include(getcwd().'/config/informationsForConnection.php');
function connectToDatabase($db, $user, $password)
{
	try
	{
		$connectionToDatabase = new PDO($db, $user, $password);
	}
	catch (Exception $e)
	{
		$connectionToDatabase = NULL;
		die('Erreur : ' .$e->getMessage());
	}

	return $connectionToDatabase;
}

function deconnectionToDatabase($connectionToDatabase)
{
	if (!empty($connectionToDatabase))
	{
		$connectionToDatabase = NULL;
	}
}

$dbh = connectToDatabase(DB1, USER1, PASSWORD1)

?>