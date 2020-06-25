<?php
  class Estate {
    // DB stuff
      private $conn;
      private $table = 'anthyll_estate';

    // Estate Properties
      public $id; 
      public $Type; 
      public $Poster; 
      public $Contact; 
      public $Email; 
      public $Region; 
      public $Location; 
      public $Description; 
      public $MapLocal; 
      public $postDate; 
      public $Image1; 
      public $Image2;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Real Estates
    public function getAllEstate() {
      // Create query
      $query = 'SELECT  `id`, `Type`, `Poster`, `Contact`, `Email`, `Region`, `Location`, `Description`, `MapLocal`, `postDate`, `Image1`, `Image2`
                                FROM ' . $this->table . ' 
                                ORDER BY
                                  postDate DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

// Get Single Estate
    public function read_single() {
          // Create query
          $query = 'SELECT `id`, `Type`, `Poster`, `Contact`, `Email`, `Region`, `Location`, `Description`, `MapLocal`, `postDate`, `Image1`, `Image2`
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
          $this->Type = $row['Type'];
          $this->Poster = $row['Poster'];
          $this->Contact = $row['Contact'];
          $this->Email = $row['Email'];
          $this->Region = $row['Region'];
          $this->Location = $row['Location'];
          $this->Description = $row['Description'];
          $this->MapLocal = $row['MapLocal'];
          $this->postDate = $row['postDate'];
          $this->Image1 = $row['Image1'];
          $this->Image2 = $row['Image2'];
    }
  }