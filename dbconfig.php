<?php

	$DB_HOST = 'localhost';
	$DB_USER = 'jaluk';
	$DB_PASS = '12345';
	$DB_NAME = 'imagenescrud';
	
	try{
		$db = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	
