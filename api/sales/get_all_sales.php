<?php
// Set Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Sale.php';

//Instiate DB & Connect
$database = new Database();
$db = $database->connect();
//Instantiate Sales Query
$sale = new Sale($db);


//Sales Query
$response = $sale->getAllSales();

//Get Row Count
$num = $response->rowCount();

if($num > 0){
      //Sales Array
      $sales_arr = array();
      $sales_arr['data'] = array();
      
      while($row = $response->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $SalesItem = array(
                  'productId' => $productId,
                  'productName' =>$productName,
                  'posterContact' =>$posterContact,
                  'productImageOne' =>$productImageOne,
                  'productImageTwo' =>$productImageTwo,
                  'productDescription' => html_entity_decode($productDescription),
                  'posterRegion' =>$posterRegion,
                  'productCategory' =>$productCategory,
                  'productPrice' =>$productPrice,
                  'postTime' =>$postTime,
                  'timestamp' =>$timestamp,
            );
            // Push to data
            array_push($sales_arr['data'], $SalesItem);

      }
      echo json_encode($sales_arr);

}else {
//No Sales Item
echo json_encode(
      array('message' => 'No Sales Item Found')
);
}