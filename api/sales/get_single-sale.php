<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Sale.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Service object
  $sale = new Sale($db);

  // Get Product ID
  $sale->productId = isset($_GET['productId']) ? $_GET['productId'] : die();

  // Get Sale
  $sale->read_single();

  // Create array
  $sale_arr = array(
      'productId' => $sale->productId,
      'productName' => $sale->productName,
      'posterContact' => $sale->posterContact,
      'productImageOne' => $sale->productImageOne,
      'productImageTwo' => $sale->productImageTwo,
      'productDescription' => $sale->productDescription,
      'posterRegion' => $sale->posterRegion,
      'productCategory' => $sale->productCategory,
      'productPrice' => $sale->productPrice,
      'postTime' => $sale->postTime,
      'timestamp' => $sale->timestamp,
      );
  

  // Make JSON
  print_r(json_encode($sale_arr));