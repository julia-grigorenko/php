<?php
class order extends baza{
  function write_order($customer_id, $tour_id, $quantity){
    $segodnya= date("Y-m_d");
    $query="select price from tours where id=".$tour_id;
    if($result=$this->connection->query($query)){
      while($row=$result->fetch_assoc()){
        $price=$row['price'];
        $summa=$quantity*$price;
      }
    }
    $query="insert into orders (order_date, customer, amount) values ('$segodnya', $customer_id, $summa)";
    if ($result=$this->connection->query($query)){
      echo "<br />Спасибо, Ваш заказ принят";
    }
    $query="select LAST_INSERT_ID() as order_id";
    if ($result=$this->connection->query($query)){
      while($row=$result->fetch_assoc()){
        $order_id=$row['order_id'];
      }
    }
    $query="insert into order_items(order_id, tour_id, quantity) values ($order_id, $tour_id, $quantity)";
    if ($result=$this->connection->query($query)){
      echo "<p>Запись в order_items сделана.";
    }
  }
  function show_orders(){
    @$start= $_GET['start'];
    if(!$start) $start=0;//начальная строка выборки из базы
    $number=10;//количество записей на странице
    $query="select count(id) as row_cnt from order_items";
    if ($result=$this->connection->query($query)){
      $row=misqli_fetch_assoc($result);
      $row_cnt=$row['row_cnt'];
      $chislo_stranits= (int)($row_cnt/$number+1);
    }
    $stop= $start+$number;
    $query= "select o.order_date, c.family_name,o.quantity from customers as c, orders aso, order_item as oi
            where c.id=o.customer and o.id=oi.order_id limit $start, $stop";
    $HrefPage='';
    if ($result=$this->connection->query($query)){
        echo "<p><b>Список клиентов</b></p>";
        echo "<table border=1 cellspasing=0 cellpadding=3>";
        echo "<tr><th>Дата заказа</th><th>Фамилия</th><th>Сумма заказа</th></tr>";
        $i=0;
        while($i<$number){
             if($row= mysqli_fetch_assoc($result)){
                echo "<tr><td>".$row['order_date']."</td><td>".$row['family_name']."</td><td>".$row['quantity']."</td></tr>";
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
