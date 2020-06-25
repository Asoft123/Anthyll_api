<?php
// Set Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Realestate.php';

//Instiate DB & Connect
$database = new Database();
$db = $database->connect();
//Instantiate Real Estate Query
$real = new Estate($db);


//Real Estate Query
$response = $real->getAllEstate();

//Get Row Count
$num = $response->rowCount();

if($num > 0){
      //Real Estate Array
      $estate_arr = array();
      $estate_arr['data'] = array();
      
      while($row = $response->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $realEstateItem = array(
                  'id' => $id,
                  'Type' =>$Type,
                  'Poster' =>$Poster,
                  'Contact' =>$Contact,
                  'Email' =>$Email,
                  'Region' =>$Region,
                  'Location' =>$Location,
                  'Description' =>html_entity_decode($Description),
                  'MapLocal' =>$MapLocal,
                  'PostDate' =>$postDate,
                  'Image1' =>$Image1,
                  'Image2' =>$Image2,
            );
            // Push to data
            array_push($estate_arr['data'], $realEstateItem);

      }
      echo json_encode($estate_arr);

}else {
//No Real Estate Item
echo json_encode(
      array('message' => 'No Real Estate Item Found')
);
}