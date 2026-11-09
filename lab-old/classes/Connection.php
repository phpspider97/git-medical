<?php

CLASS Connection {

  protected $servername = "localhost";
  protected $username = "test_report";
  protected $password = "test_report123@#";
  protected $database = "test_report";

  public function create_connection(){
    $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 
    return $conn;
  }

}
?>