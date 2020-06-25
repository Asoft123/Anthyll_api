<?php
  class Service {
    // DB stuff
      private $conn;
      private $table = 'anthyllservices';

    // Service Properties
      public $id; 
      public $ServiceName; 
      public $ServiceCategory; 
      public $ServiceContact; 
      public $ServiceRegion; 
      public $ServiceAddress; 
      public $ServiceDesc; 
      public $ServiceLogo; 
      public $OwnerName; 
      public $Rating; 
      public $Raters;
      public $timestamp; 
   

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Services
    public function getAllServices() {
      // Create query
      $query = 'SELECT `id`, `ServiceName`, `ServiceCategory`, `ServiceContact`, 
                       `ServiceRegion`, `ServiceAddress`, `ServiceDesc`,
                       `ServiceLogo`, `OwnerName`, `OwnerPhone`, `Rating`, `Raters`, `timestamp`
                                FROM ' . $this->table . ' 
                                ORDER BY
                                  id DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Service
    public function read_single() {
          // Create query
          $query = 'SELECT `id`, `ServiceName`, `ServiceCategory`, `ServiceContact`, 
                       `ServiceRegion`, `ServiceAddress`, `ServiceDesc`,
                       `ServiceLogo`, `OwnerName`, `OwnerPhone`, `Rating`, `Raters`, `timestamp`
                                    FROM ' . $this->table . '
                                    WHERE
                                      id = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->id = $row['id'];
          $this->ServiceName = $row['ServiceName'];
          $this->ServiceCategory = $row['ServiceCategory'];
          $this->ServiceContact = $row['ServiceContact'];
          $this->ServiceRegion = $row['ServiceRegion'];
          $this->ServiceAddress = $row['ServiceAddress'];
          $this->ServiceDesc = $row['ServiceDesc'];
          $this->ServiceLogo = $row['ServiceLogo'];
          $this->OwnerName = $row['OwnerName'];
          $this->OwnerPhone = $row['OwnerPhone'];
          $this->Rating = $row['Rating'];
          $this->Raters = $row['Raters'];
          $this->timestamp = $row['timestamp'];
    }
  }