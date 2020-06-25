<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Realestate.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Service object
  $estate = new Estate($db);

  // Get ID
  $estate->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get estate
  $estate->read_single();

  // Create array
  $estate_arr = array(
      'id' => $estate->id,
      'Type' => $estate->Type,
      'Poster' => $estate->Poster,
      'Contact' => $estate->Contact,
      'Email' => $estate->Email,
      'Region' => $estate->Region,
      'Location' => $estate->Location,
      'Description' => $estate->Description,
      'MapLocal' => $estate->MapLocal,
      'postDate' => $estate->postDate,
      'Image1' => $estate->Image1,
      'Image2' => $estate->Image2,
      );
  

  // Make JSON
  print_r(json_encode($estate_arr));