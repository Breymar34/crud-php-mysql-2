<?php
class Crud{
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "threewmadtwo";
    private $conn; // MySQLi connection object
    private $id;

    public function __construct()
    {
        // Open db connection
        $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function __destruct()
    {
        // Close db connection
        if ($this->conn) {
            $this->conn->close();
        }
    }
    protected function insert($fn,$ln,$course)
    {
        $query = mysqli_query($this->conn,"INSERT INTO student(`fn`,`ln`,`course`) VALUES('$fn','$ln','$course')");
        if($query){echo "Record added!";}
        else{echo "Error!";}
    }
    protected function update($id,$fn,$ln,$course)
    {
        $query = mysqli_query($this->conn,"
        UPDATE student SET
        fn = '$fn',
        ln = '$ln',
        course = '$course' WHERE id = $id 
        ");
        if($query){echo "Record changed!";}
        else{echo "Error!";}
    }
    protected function viewAll()
    {
        $query = mysqli_query($this->conn,"SELECT * FROM student") or die('Query Error');
        while($row = mysqli_fetch_object($query))
        {
            echo $row->fn." ".$row->ln." ".$row->course."<br>";
        }        
    }
    protected function viewSpecific($id)
    {   
        $this->id = $id;
        $query = mysqli_query($this->conn,"SELECT * FROM student WHERE id='$this->id'") or die('Query Error');
        $row = mysqli_fetch_object($query);
        if($row){
            echo $row->fn." ".$row->ln." ".$row->course."<br>";
        }else{echo "No record found!";}
 
    }
    protected function delete($id)
    {   
        $this->id = $id;
        $query = mysqli_query($this->conn,"DELETE FROM student WHERE id='$this->id'") or die('Query Error');
        if($query){echo "Record removed";}
        else{echo "Error deletion";}
 
    }
    protected function search($keyword)
    {   
        $sql = "SELECT * FROM student WHERE fn LIKE '".$keyword."%'";
        $query = mysqli_query($this->conn,$sql) or die('Query Error');
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_object($query))
            {
                echo $row->fn." ".$row->ln." ".$row->course."<br>";
            } 
        } else{ echo "No record found!";}    
    }
}
class Operation extends Crud{
    public function transaction($choice,$value)
    {
        if($choice == 'hanap')
        {
            $this->search($value);
        }
        else if($choice == 'hanapIsa')
        {
            $this->viewSpecific($value);
        }
    }
}

// $operation = new Operation();
// $operation->transaction('hanap','Ja');

