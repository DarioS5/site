<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
require_once("admin/param.php");
$query="Select id,name,har,dv,price,photo from shouse";
$rez=mysqli_query($dbc,$query) or die("query error");
echo"<table border='1'>
<tr><th> №</th>
<th>назва</th>
<th>характеристика</th>
<th>дата випуску</th>
<th>ціна</th>
<th>фото</th>
</tr>";
while($next=mysqli_fetch_array($rez))
{
    if(empty($next['photo'])){//якщо з бази даних замість  назви фото  пусто то в цей елемент зберігаємо назву файла "нема фото"
        $next['photo']="no.png";
     }
    echo"<tr> 
<td>".$next['id']."</td>
<td>".$next['name']."</td>
<td>".$next['har']."</td>
<td>".$next['dv']."</td>
<td>".$next['price']."</td>
<td><img width='100px' src='../img/".$next['photo']."'></td>
</tr>";// в тегі img в параметр src підставляємо назву фото щоб побачити його у виді зображення
    //../вихід з папки на  рівень вище
}
echo"</table>";
mysqli_close($dbc);
?>

</body>
</html>