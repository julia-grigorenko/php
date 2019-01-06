<?php
class city exrends country{
  function insert_city($country,$name,$description){
    $country=$this->connection->real_escape_string($country);
    $name=$this->connection->real_escape_string($name);
    $description=$this->connection->real_escape_string($description);
    $request="insert into cities(name,description,country)
              values(\"$name\",\"$description\",\"$country\")";
    if(result=$this->connection->query($request)){
      echo "Запись сведений о городе выполнена.";
    }else{
      echo "Запись не выполнена.";
    }
  }
}
 ?>
