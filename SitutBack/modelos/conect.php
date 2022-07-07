<?php 
date_default_timezone_set('UTC');
date_default_timezone_set("America/Mexico_City");
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