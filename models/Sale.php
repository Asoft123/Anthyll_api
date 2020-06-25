<?php
  class Sale {
    // DB stuff
      private $conn;
      private $table = 'anthyllsales';

    // Sales Properties
    
      public $productId; 
      public $productName; 
      public $posterContact; 
      public $productImageOne; 
      public $productImageTwo; 
      public $productDescription; 
      public $posterRegion; 
      public $productCategory; 
      public $productPrice; 
      public $postTime; 
      public $timestamp; 
   

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Sales
    public function getAllSales() {
      // Create query
      $query = 'SELECT  `productId`, `productName`, `posterContact`, 
      `productImageOne`, `productImageTwo`, `productDescription`,
       `posterRegion`, `productCategory`, `productPrice`, `postTime`, `timestamp`
                                FROM ' . $this->table . ' 
                                ORDER BY
                                  postTime DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Sale
    public function read_single() {
          // Create query
          $query = 'SELECT `productId`, `productName`, `posterContact`, 
                           `productImageOne`, `productImageTwo`, `productDescription`, 
                           `posterRegion`, `productCategory`, `productPrice`, `postTime`, `timestamp`
                                    FROM ' . $this->table . '
                                    WHERE
                                      productId = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->productId);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->productId = $row['productId'];
          $this->productName = $row['productName'];
          $this->posterContact = $row['posterContact'];
          $this->productImageOne = $row['productImageOne'];
          $this->productImageTwo = $row['productImageTwo'];
          $this->productDescription = $row['productDescription'];
          $this->posterRegion = $row['posterRegion'];
          $this->productCategory = $row['productCategory'];
          $this->productPrice = $row['productPrice'];
          $this->postTime = $row['postTime'];
          $this->timestamp = $row['timestamp'];
    }
  }