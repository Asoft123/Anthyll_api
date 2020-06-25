<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Service.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Service object
  $service = new Service($db);

  // Get ID
  $service->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get service
  $service->read_single();

  // Create array
  $service_arr = array(
      'id' => $service->id,
      'ServiceName' => $service->ServiceName,
      'ServiceCategory' => $service->ServiceCategory,
      'ServiceContact' => $service->ServiceContact,
      'ServiceRegion' => $service->ServiceRegion,
      'ServiceAddress' => $service->ServiceAddress,
      'ServiceDesc' => $service->ServiceDesc,
      'ServiceLogo' => $service->ServiceLogo,
      'OwnerName' => $service->OwnerName,
      'OwnerPhone' => $service->OwnerPhone,
      'Rating' => $service->Rating,
      'Raters' => $service->Raters,
      'timestamp' => $service->timestamp,
      );
  

  // Make JSON
  print_r(json_encode($service_arr));