<?php

CLASS Location extends Connection {
    protected $conn;
    function __construct(){
        $this->conn = $this->create_connection();
    } 

    public function getData($data_id,$table=DATABASE_TABLE_PREFIX.'type'){
        try{
            $query_data = "SELECT * FROM $table WHERE type_id='$data_id'";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                return $return_data = $result->fetch_assoc();
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
    public function getLocationData($table=DATABASE_TABLE_PREFIX.'country',$where_clause=''){
        try{ 
            $query_data = "SELECT * FROM $table $where_clause";
            $result = $this->conn->query($query_data);
            if(isset($result->num_rows) && $result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    $return_data[] = $row;
                }
                return $return_data;
            }else{ 
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }
     
    public function getLocationName($table,$data_id){
        try{ 
            $query_data = "SELECT name FROM $table WHERE id='$data_id' ";
            $result = $this->conn->query($query_data);
            if($result->num_rows > 0){
                return $result->fetch_assoc()['name'];
            }else{ 
                return 'NA';
            }
        }catch(Exception $e){
            return false;
        }
    }

    function __destruct(){
        $this->conn->close();
    }
} 