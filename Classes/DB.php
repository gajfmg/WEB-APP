<?php

 require_once ('C:\xampp\htdocs\PhpProject1\Classes\Config.php');

class DB{
	private static $pdo;
	public static function getInstance(){
		if(!isset(self::$pdo)){
			try {
				self::$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
				self::$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
		return self::$pdo;
	}
 	
	public static function prepare($sql){
		return self::getInstance()->prepare($sql);
	}
}