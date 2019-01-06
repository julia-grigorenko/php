<?php
class tour extends baza{
  //вывод туров в выбранный город и страну
  function display($country,$city){
    $query="select h.id as h_id, h.name, t.price, t.duration,
            t.startdate,t.id from hotels as h, tours as t, cities as c
            where t.hotel=h.id and c.name=\"$city\" and c.country= \"$country\"
            and c.id=h.city";
    echo "<table border=0 bgcolor='#CCFF99'>";
    echo "<tr><th>Отель</th><th>Цена</th><th>Дата</th><th>Дни</th><th>&nbsp;</th></tr>";
    if($result=$this->connection->query($query)){
      while($row=$result->fetch_assoc()){
        //задание свойств объекта по результатам выборки из базы данных
        $this->name=$row['name'];
        $this->price=$row['price'];
        $this->duration=$row['duration'];
        $this->startdate=$row['startdate'];
        $this->id=$row['id'];
        echo "<td align=center><a href='display_hotel.php?name=".$this->name."&gorod=".$city."&strana=".$country."'>".
              $this->name."</a></td>";
        echo "<td align=center>".$this->price."</td>";
        echo "<td align=center>".$this->startdate."</td>";
        echo "<td align=center>".$this->duration."</td>";
        echo "<td align=center> <a href= 'order.php?id=".$this->id."'>заказать тур</a></td></tr>";
      }
    }
    $result->close();
    echo "</table>";
  }

}
?>
