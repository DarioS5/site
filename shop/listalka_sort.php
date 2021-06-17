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
if(isset($_GET['sort']))
{
    $sort=$_GET['sort'];

}
switch ($sort)
{
    case "ASC":
        $sort="DESC";
        break;
    case "DESC":
        $sort="ASC";
        break;
    default:
        $sort="ASC";
        break;
}
$zapis=3;
$queryZ="Select id from shouse";
$rezZ=mysqli_query($dbc,$queryZ) or die("Query error");
$count_zapis=mysqli_num_rows($rezZ);
$count_page=ceil($count_zapis/$zapis);
if(isset($_GET['page']))
{
    $active_page=$_GET['page'];
}
else
    {
    $active_page=1;
}
$propusk=($active_page-1)*$zapis;
$query="Select id,name,har,dv,price,photo from shouse ORDER BY price $sort LIMIT $propusk,$zapis";
$rez=mysqli_query($dbc,$query) or die("query error");
echo"<table border='2'>
<tr><th>№</th>
<th>Назва</th>
<th>характеристика</th>
<th>дата виходу</th>
<th> <a href='listalka_sort.php?sort=".$sort."'>Ціна</a></th>
<th>фото</th>
</tr>";
$num=$propusk+1;
while($next=mysqli_fetch_array($rez))
{
    if(empty($next['photo']))
    {
        $next['photo']="no.png";
    }
    echo"<tr><td>".$next['id']."</td>
<td>".$next['name']."</td>
<td>".$next['har']."</td>
<td>".$next['dv']."</td>
<td>".$next['price']."</td>
<td><img width='300' src='../img/".$next['photo']."'</td>
</tr>";
    $num++;
}
echo"</table>";
if(isset($sort)&& $sort=="ASC")
{
    $sort1="DESC";

}
else if(isset($sort)&&$sort=="DESC")
{
    $sort1="ASC";
}
echo"<table><tr>";
if($active_page==1)
{
    echo"<td> << </td>";
}
else {
        echo "<td> <a href='listalka_sort.php?page=" . ($active_page - 1) . "&sort=$sort1'> << </a></td>";

}

for($i=1;$i<=$count_page;$i++) {
    if ($active_page == $i) {
        echo "<td> $i</td>";
        } else {
            echo "<td> <a href='listalka_sort.php?page=" . $i . "&sort=$sort1'> $i </a></td>";

        }
}
    if ($active_page = $count_page) {
        echo "<td> >> </td>";
    } else{
            echo "<td> <a href='listalka_sort.php?page=" . ($active_page + 1) . "&sort=$sort1'> >> </a></td>";
        }



echo"</table></tr>";
mysqli_close($dbc);
?>
</body>
</html>