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
//////////////////////////////
if(isset($_GET['sort']))
{
    $sort=$_GET['sort'];

}
switch ($sort) {
    case "ASC":
        $sort = "DESC";
        break;
    case "DESC" :
        $sort = "ASC";
        break;
    default:
        $sort = "ASC";
        break;
}

// //////////////////////////
$query="Select id,name,har,dv,price,photo from shouse ORDER BY name $sort";// оператор ORDER BY - сортовати по і вказуємо назву полля по яому сортуємо а після назви вказуємо оператор аск- по збільшенню і деск-по зменшенню

$rez=mysqli_query($dbc,$query) or die("query error");
echo"<table border=2>
<tr><th>№</th>
<th> <a href='sortN.php?sort=".$sort."'>Назва</a></th>
<th>Характеристика</th>
<th>ДАта виходу</th>
<th>Ціна</th>
<th>Фото</th>

</tr>";
while($next=mysqli_fetch_array($rez))
{
    echo"<tr><td>".$next['id']."</td>
<td>".$next['name']."</td>
<td>".$next['har']."</td>
<td>".$next['dv']."</td>
<td>".$next['price']."</td>
<td><img width='200' src='../img/".$next['photo']."'> </td>

</tr>";

}
echo"</table>";
mysqli_close($dbc);
?>

</body>
</html>