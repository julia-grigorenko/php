<?php
class country extends baza{
  /*Метод show_description() выводит описание объекта.
  Выборка данных производится из таблицы, имя которой определяется в зависимости от класса,
  из которого вызывается метод*/
  function show_description($country=null){
    if ($this instanceof country){
      $quest="select description from countries where name=\"$this->name\"";
    }
    if ($this instanceof city){
      $quest="select description from cities where name=\"$this->name\"
      and country=\"$country\"";
    }
    //Запрос описания объекта - страны или города
    if($result = $this->connection->query($quest)){
      $row = $result->fetch_assoc();
      $opisanie = $row['description'];
    }
    $result->close();
    return $opisanie;
  }
  //Вывод списка городов в выбранной стране
  function show_city_list(){
    $request = "select name from cities where country=\"$this->name\"";
    if ($result = $this->connection->query($request)){
      while ($row = $result->fetch_assoc()){
        $spisok[] = $row['name'];
      }
      $result->close();
      return $spisok;
    }
  }
  //самое дешевое предложение по выбранной стране
  function min_off(){
    $request = "select min(t.price) as min_offer".
                "from cities as c, hotels as h, tours as t".
                "and c.id = h.city".
                "and c.country = \"$this->name\"";
    if($result=$this->connection->query($request)){
      $row = $result->fetch_assoc();
      return $row['min_offer'];
    }
  }
  function insert_country($name,$description){
    $name = $this->connection->real_escape_string($name);
    $description = $this->connection->real_escape_string($description);
    $request = "insert into countries(name,description) values (\"$name\",\"$description\")";
    if ($result = $this->connection->query($request)){
      echo "запись описания страны выполнена.";
    }else{
      echo "запись не выполнена, проверьте вводимые данные";
    }
  }
}
 ?>
