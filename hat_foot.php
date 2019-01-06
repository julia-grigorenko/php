<?php
class hat_foot{
  public $title = "Магазин путешествий";
  function hat(){
    echo "<html>\n<head>\n";
    echo "<title> $this->title </title>";
?>
    </head>
    <body>
<?php
      $size = getimagesize('6.jpg');
      echo '<div align=center><img src="6.jpg"' . $size[3]. '></div>';
      echo "<div align=center>";
  }
  function footer(){
    $size=getimagesize('footer1.png');
    echo "</div>";
    echo '<p align=center><img src="footer1.png"' . $size[3]. '></p>';
?>
    </body>
    </html>
<?php
  }
}
?>
