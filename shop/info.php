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
if(isset($_GET['ids']) && !empty($_GET['ids']))
{
    $ids=$_GET['ids'];
    require_once("param.php");
    $query="Select id,name,har,dv,price from shouse WHERE id=$id";
    $rez=mysqli_query($dbc,$query) or die("query error");
$next=mysqli_fetch_array($rez);
echo"<table border='3'>
<tr><th>№</th>
<th>назва</th>
<th>характеристика</th>
<th>дата випуску</th>
<th>ціна</th>
</tr>";
$name=$next['name'];
$har=$next['har'];
$dv=$next['dv'];
$price=$next['price'];
echo"<tr><td>$id</td>
<td>$name</td>
<td>$har</td>
<td>$dv</td>
<td>$price</td>
</tr></table>";
mysqli_close($dbc);
}
else {
    echo "недостатньо даних для виводу";
}
     echo "<a href='admin/add_items.php'>назад</a>";
?>
</body>
</html>