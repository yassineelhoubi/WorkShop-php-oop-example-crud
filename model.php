<?php
//DataBase Conction
class connection{
    private $dsn        = 'mysql:host=localhost;dbname=test-oop';
    private $username   = 'root';
    private $password   = '';

    public $conn;
    function __construct(){
        
        try {
            //Start A New Connection With PDO Class
            $this->conn = new PDO($this->dsn,$this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            echo 'You Are Connected';
        } catch (PDOException $e) {
            echo 'Failed '. $e->getMessage();
        }
    }//construct close

}


class Model extends connection{
 
    
    //Function define For Insert Records
    public function insertRecord(){/*  */
        $name   =   $_POST['name'];
        $email  =   $_POST['email'];
        $sql    =   "INSERT INTO users(name,email)VALUES('$name','$email')";
        $result =   $this->conn->exec($sql);
        if($result){
            header('location:index.php?msg=ins');
        }else{
            echo "Error " . $sql . "<br>" . $this->conn->error;
        }
    }//InsertRecord Function Close

    //Function define For Update Records
    public function updateRecord(){/*  */
        $name   =   $_POST['name'];
        $email  =   $_POST['email'];
        $editid =   $_POST['hid'];
        $sql    =   "UPDATE users SET name='$name' , email='$email' WHERE id='$editid'";
        $result =   $this->conn->exec($sql);
        if($result){
            header('location:index.php?msg=ups');
        }else{
            echo "Error " . $sql . "<br>" . $this->conn->error;
        }
    }//UpdateRecord Function Close

    //Function Define For Delete Records
    public function deleteRecord($delid){
        $sql    =   "DELETE FROM users WHERE id='$delid'";
        $result =   $this->conn->exec($sql);
        if($result){
            header('location:index.php?msg=del');
        }else{
            echo "Error " . $sql . "<br>" . $this->conn->error;
        }
    }//DeleteRecord Function Close

    public function displayRecord(){
        $sql       =   "SELECT * FROM users";
        $stmt      =    $this->conn->prepare($sql);
        $stmt->execute();
        $result    =   $stmt->fetchAll();
        return    $result;
    }//displayRecord Close



    public function displayRecordById($editid){
        $sql      =  'SELECT * FROM users WHERE id = ?';
        $stmt   =  $this->conn->prepare($sql);  
        $stmt->execute([$editid]);
       return $result=$stmt->fetch();

    }//function desplayRecordById Close

}//class close


/* $obj = new model(); */


?>