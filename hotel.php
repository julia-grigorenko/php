<?php
class hotel extends country{
    function show_description($city,$country){
      $query="select distinct h.name, h.description, h.stars,h.fohotos
              from hotels as h, cities as c where c.name=\"$city\"
              andc.country=\"$country\" and h.name=\"$this->name and c.id=h.city";
      if($result+$this->connection->query($query)){
        while($row=$result->fetch_assoc()){
          //создание строки звездочек для показа звездности отеля
          $st="";
          for($i=0;$i<$row['stars'];$i++)
          $st=$st."*";
          echo "<table border=0> <tr><td>";
          //вывод картинки отеля
          $jpg = $row["photos"];
          echo "<img src='richmond.jpg'>";
          //вывод названия отеля его звездности и описания
          echo "</td><td valign=top> Отель".$row['name'].$st."</td></tr>\n";
          echo "<tr><td colspan=2>".$row['description']."</td></tr></table>";
        }
      }
    }
    function insert_hotel($strana,$gorod,$hotel,$description,$stars,$foto){
      $request="select id from cities where name=\"$gorod\" and country=\"$strana\"";
      if($result=$this->connection->query($request)){
        $city=$result->fetch_assoc();
        $city_id=$city['id'];
        $hotel=$this->connection->real_escape_string($hotel);
        $description=$this->connection->real_escape_string($description);
        $foto=$this->connection->real_escape_string($foto);
        $name=$this->connection->real_escape_string($name);
        $strana=$this->connection->real_escape_string($strana);
        $request="insert into hotels (name, description, photos, stars, city)
                  values(\"$hotel\", \"$description\", \"$foto\", \"$stars\", \"$city_id\")";
        if($result=$this->connection->query($request)){
          echo "запись об отеле выполнена.";
        }else{
          echo "запись не выполнена. проверьте вводимые данные.";
        }
      }else{
        echo "ошибка в запросе. пожалуйста, проверьте вводимые данные.";
      }
    }
}
 ?>
