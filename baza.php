<?php
  class baza{
    //create constants of the database
    const USERNAME = 'noman';
    const PASSWORD = '221075lenin';
    const DBNAME  = 'firma';
    const SERVER = 'localhost';
    //class constructor connect with database
    function __construct($name=NULL){
      if ($mysqli=new mysqli(self::SERVER,self::USERNAME,self::PASSWORD,self::DBNAME)){
        $this->connection=$mysqli;
      }else{
        echo "can`t connet with database server";
        exit;
      }
      if($name){
        $this->name = $name;
      }
    }
    function show_country_list(){
      $quest = "select name from countries";
      if($result = $this->connection->query($quest)){
        while($row = $result->fetch_assoc()){
            $spisok[]=$row['name'];
        }
        $result->close();
        return $spisok;
      }
    }
    function _destruct(){
      $this->connection->close();
    }
  }
 ?>
