<?php
class Dbh{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    public function connect(){
        $this->servername = "localhost:3306";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "student_info_system";
        $conn = new mysqli($this->servername,  $this->username, $this->password, $this->dbname );
        return $conn;
    }

    public function insertRecord($tableName, $columnArray,$valueArray){

        $this->tableName = $tableName;
        $this->columnArray = $columnArray;
        $this->valueArray= $valueArray;
        $this->columnArray = implode(',',$columnArray);
        $this->valueArray = implode(',', $this->valueArray); 
        $sql = "INSERT INTO $this->tableName  ($this->columnArray) values ($this->valueArray)";  

        try{
            if($this->connect()->query($sql)){
                echo "New record is inserted sucessfully";  
            }
            else{
                throw new Exception("Can't connect to the database! \n");  
            }
        }  
        catch(Exception $e){
            echo $e->getMessage();
        }    
}

    public function generateHighChart(){
        $this->name_array=[];
        $this->grade_array=[];
        $sql = "SELECT first_name,grade FROM student_system";
        $result = $this->connect()->query($sql);

        if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            array_push ($this->name_array,  $row['first_name'] );
            array_push ($this->grade_array,(int)$row['grade'] );

        }
        $this->result['names'] = $this->name_array;
        $this->result['grades'] = $this->grade_array;
        return $this->result;

        } else {
        echo "0 results";
        }


    }
}
?>