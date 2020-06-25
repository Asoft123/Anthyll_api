<?php
// Set Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Service.php';

//Instiate DB & Connect
$database = new Database();
$db = $database->connect();
//Instantiate Real Estate Query
$service = new Service($db);

// Services  Query
$response = $service->getAllServices();

//Get Row Count
$num = $response->rowCount();
if($num > 0){
      //Service Array
      $services_arr = array();
      $services_arr['data'] = array();
     
      while($row = $response->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $serviceItem = array(
                  'id' => $id,
                  'ServiceName' =>$ServiceName,
                  'ServiceCategory' =>$ServiceCategory,
                  'ServiceContact' =>$ServiceContact,
                  'ServiceRegion' =>$ServiceRegion,
                  'ServiceAddress' =>$ServiceAddress,
                  'ServiceDesc' =>html_entity_decode($ServiceDesc),
                  'ServiceLogo' =>$ServiceLogo,
                  'OwnerName' =>$OwnerName,
                  'OwnerPhone' =>$OwnerPhone,
                  'Rating' =>$Rating,
                  'Raters' =>$Raters,
                  'timestamp' =>$timestamp,
            );
            // Push to data
            array_push($services_arr['data'], $serviceItem);

      }
      echo json_encode($services_arr);

}else {
//No Service Item
echo json_encode(
      array('message' => 'No Service Item Found')
);
}