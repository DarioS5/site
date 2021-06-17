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
////////////////////////////////
$queryM="Select id,name from marka";
$rezM=mysqli_query($dbc,$queryM ) or die("query error marka");
while($nextM=mysqli_fetch_array($rezM))
{
    echo"<a href='filtr.php?idmarka=".$nextM['id']."'>".$nextM['name']."</a> |";

}
echo"<a href='filtr.php'>Всі</a>";

///////////////////////////////////
if(isset($_GET['idmarka']) &&!empty($_GET['idmarka']))
{
    $query="Select id,name,har,dv,price,photo from shouse WHERE id_marka=".$_GET['idmarka'];

}
else{
    $query="Select id,name,har,dv,price,photo from shouse";

}


$rez=mysqli_query($dbc,$query) or die("query error");
echo"<table border=2>
<tr><th>№</th>
<th>Назва</th>
<th>Характеристика</th>
<th>Дата випуску</th>
<th>Ціна</th>
<th>Фото</th>
</tr>";
while($next=mysqli_fetch_array($rez))
{
    if(empty($next['photo']))
        $next['photo']="no.png";

echo"<tr>
<td>".$next['id']."</td>
<td>".$next['name']."</td>
<td>".$next['har']."</td>
<td>".$next['dv']."</td>
<td>".$next['price']."</td>
<td><img width='150' src='../img/".$next['photo']."' </td>
</tr>";
}
echo"</table>";
mysqli_close($dbc)
?>

</body>
</html>