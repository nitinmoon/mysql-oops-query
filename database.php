<?php
 
class Database {

    private $serverName = "localhost";
    private $userName = "root";
    private $password = "";
    private $dbName = 'php-mysqli-oops';

    private $conn;
    
    public function __construct()
    {
        $this->conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
         
    }


    public function insert($table, array $param)
    {
        if ($this->tableExists($table)) {
           
            $tableColumns = implode(', ', array_keys($param));
            $values = implode("', '", $param);
 
            $sql = "INSERT INTO $table ($tableColumns) values ('$values')";
            
            if ($this->conn->query($sql)) {
                
               // return $this->conn->insert_id;
                return 'Record inserted successfully';
            }  
                
            return $this->conn->error;
             
        }  
       return "$table Table Not Exists";
        
    }

    public function update($table, array $param, $condition = NULL)
    {
        if ($condition == NULL) {
            return 'Condition is required';
        }
        if ($this->tableExists($table)) {
            
            $args = [];

            foreach ($param as $key => $value) {
                $args[] = "$key = '$value'";
            }

            $sql = "UPDATE $table SET ". implode(', ', $args). " WHERE $condition";
      
            if ($this->conn->query($sql)) {
                
                return 'Record updated successfully';
            }
            return $this->conn->error;
       
        }  
       return "$table Table Not Exists";
    }


    public function delete($table, $condition = NULL)
    {
        if ($condition == NULL) {
            return 'Condition is required';
        }
        if ($this->tableExists($table)) {
        
            $sql = "DELETE FROM $table". " WHERE $condition";
            
            if ($this->conn->query($sql)) {
                
                return 'Record deleted successfully';
            }
            return $this->conn->error;
       
        }  
       return "$table Table Not Exists";
    }

    public function select($table, $fileds = "*", $condition = NULL, $order = NULL, $limit = NULL)
    {
        if ($this->tableExists($table)) {

            $sql = "SELECT $fileds FROM $table";
             
            if ($condition != NULL) {
                $sql .= " WHERE $condition";
            }

            if ($order != NULL) {
                $sql .= " ORDER BY $order";
            }

            if ($limit != NULL) {
                $sql .= " LIMIT $limit";
            }
            $result = $this->conn->query($sql);
          
            if ($result->num_rows > 0) {
                 
                return $result->fetch_all(MYSQLI_ASSOC);
            } 
            return "No record found..!";
        } 

        return "$table Table Not Exists";
    }

    private function tableExists($table)
    {
        $sql = "SHOW TABLES LIKE '$table'";
        $result = $this->conn->query($sql);
        $checkTable = ($result->num_rows == 1) ? true : false;
        return $checkTable;
    }
 
    public function __destruct()
    {
        $this->conn->close();
    }
}

 



