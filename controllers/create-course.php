<?php 

	header('Access-Control-Allow-Origin: *');
	require_once('../db/db.php');
	require_once('../models/category.php');

	$resp = null;

	$action = $_POST["vAction"];

	/* CATEGORIAS */
	
	if($action == 'CC') {
		$categoryName = $_POST["InputNameCategoryAdd"];
		$resp = Category::getCategoryByName($categoryName);
	} 
	else if($action == 'IC') {
		$categoryName = $_POST["InputNameCategoryAdd"];
		$resp = Category::createCategory($categoryName);
	}
	else if($action == 'SAC') {
		$resp = Category::getAllCategories();
	}

	echo json_encode($resp);
 ?>