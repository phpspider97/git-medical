<?php
CLASS Dashboard extends Connection {
    protected $conn;
    function __construct(){
        $this->conn = $this->create_connection();
    } 
    
    public function dashboardData($member_id){
        $query_data = "SELECT count(*) as total_patien_count from lab_patient WHERE added_by='$member_id'";
        $result = $this->conn->query($query_data);
        if($result->num_rows > 0){
            $return_data = $result->fetch_assoc();
            $total_report_count = $return_data['total_patien_count'];
        }
        $dashboard_data = [
            'total_patient'  => ($total_report_count)?$total_report_count:0,
        ];
        return $dashboard_data;
    }
    
    function __destruct(){
        $this->conn->close();
    }
}