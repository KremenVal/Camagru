<?php
	require_once 'database.php';

	//Create database
	try
	{
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'CREATE DATABASE IF NOT EXISTS camagru';
		$pdo->exec($sql);
	}
	catch (PDOException $e)
	{
		echo "Error creating database 'camagru': " . $e->getMessage();
		exit();
	}

	//Create table users
	try
	{
		$pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'CREATE TABLE IF NOT EXISTS `users` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`login` VARCHAR(255) NOT NULL,
			`email` VARCHAR(255) NOT NULL,
			`createsAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`password` VARCHAR(255) NOT NULL,
			`passwordForUser` VARCHAR(255) NOT NULL,
			`token` VARCHAR(255) NOT NULL,
			`verification` VARCHAR(1) NOT NULL DEFAULT "N"
		)';
		$pdo->exec($sql);
	}
	catch (PDOException $e)
	{
		echo "Error creating table 'users': " . $e->getMessage();
		exit();
	}

	//Create table image
	try
	{
		$pdo = new PDO($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'CREATE TABLE IF NOT EXISTS `image` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`userId` INT(11) NOT NULL,
			`image` VARCHAR(255) NOT NULL,
			`createsAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
			FOREIGN KEY (userId) REFERENCES users(id)
		)';
		$pdo->exec($sql);
	}
	catch (PDOException $e)
	{
		echo "Error creating table 'image': " . $e->getMessage();
		exit();
	}
?>