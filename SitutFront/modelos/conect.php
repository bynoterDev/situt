<?php 

/**
 * 
 */
class Connect
{
	public function getDB() {
		try {
			$dbConnection = new PDO("mysql:host=localhost;dbname=tutorias", "root", "12345"); 
			$dbConnection->exec("set names utf8");
			$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $dbConnection;
		}
		catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		}
	}
}