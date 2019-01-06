<?php
class customer extends baza{
  function find_client($family_name, $passport){
    $family_name=$this->connection->real_escape_string($family_name);
    $passport=$this->connection->real_escape_string($passport);
    $query="select id from customers where family_name= '$family_name' and passport= '$passport'
            group by passport";
    if ($result=$this->connection->query($query)){
      while($row=$result->fetch_assoc()){
        echo "<p>Заказчик найден, его номер ".$row['id'];
        return $row['id'];
      }
    }
  }
  function insert_client($name, $family_name, $second_name, $address, $passport){
    //запись нового заказчика в базу данных
    $name=$this->connection->real_escape_string($name);
    $family_name=$this->connection->real_escape_string($family_name);
    $second_name=$this->connection->real_escape_string($second_name);
    $address=$this->connection->real_escape_string($address);
    $passport=$this->connection->real_escape_string($passport);
    $query="insert into customers (name, family_name, second_name, address, passport)
            values ('$name', '$family_name', '$second_name', '$address', '$passport')";
    if ($result=$this->connection->query($query)){
      echo "<br />Запись нового заказчика выполнена";
    }
    //чтение номера нового заказчика
    $query= "select id from customers where family_name= '$family_name' and passport= '$passport'
            group by passport";
    if ($result=$this->connection->query($query)){
      while($row= mysqli_fetch_assoc($result)){
        $c_id= $row['id'];
        return $c_id;
      }
    }
  }
  function customer_list(){
    @$start= $_GET['start'];
    if(!$start) $start=0;//начальная строка выборки из базы
    $number=10;//количество записей на странице
    $query= "select count(id) as row_cnt from customers";
    if ($result=$this->connection->query($query)){
      $row= mysqli_fetch_assoc($result);
      $row_cnt= $row['row_cnt'];
      $chislo_stranits= (int)($row_cnt/$number+1);
    }
    $stop= $start+$number;
    $query= "select name, family_name, passport, id from customers order by id limit $start, $stop";
    $HrefPage='';
    if ($result=$this->connection->query($query)){
      echo "<p><b>Список клиентов</b></p>";
      echo "<table border=1 cellspasing=0 cellpadding=3>";
      echo "<tr><th>№</th><th>Имя</th><th>Фамилия</th><th>Паспорт</th></tr>";
      $i=0;
      while($i<$number){
        if($row= mysqli_fetch_assoc($result)){
          echo "<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['family_name']."</td><td>".$row['passport']."</td></tr>";
        }
        $i++;
      }
      echo "</table>";
      $tekush_stranitsa= $start/$number+1;
      echo "Номер страницы: ".$tekush_stranitsa."<br />Страниицы: ";
      for($link=1; $link<=$chislo_stranits; $link++){
        $PageStart=($link-1)*$number;
        $HrefPage= "<a href= ".$_SERVER['SCRIPT_NAME'].
                    "?start= ".$PageStart." target= _parent> ".$link."</a>";
        echo "  ".$HrefPage;
      }
    }
  }
}
 ?>
