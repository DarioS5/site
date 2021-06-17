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
$queryM="Select id,name from marka";
$rezM=mysqli_query($dbc,$queryM) or die("query error");
while($nextM=mysqli_fetch_array($rezM))
{
    echo"<a  href='listalka_sort_filtr.php?id_marka=".$nextM['id']."'>".$nextM['name']."</a> ||";
}
echo"<a  href='listalka_sort_filtr.php'> ВСІ</a>";
$zapis="3";
if(isset($_GET['id_marka']) &&!empty($_GET['id_marka']))
{
    $queryZ="Select id from shouse WHERE id_marka=".$_GET['id_marka'];
}
else{
    $queryZ="Select id from shouse";
}
//$queryZ="Select id from shouse";
$rezZ=mysqli_query($dbc,$queryZ) or die("Query error");
$count_zapis=mysqli_num_rows($rezZ);
$count_page=ceil($count_zapis/$zapis);
if($_GET['page'])
{
    $active_page=$_GET['page'];

}
else{
    $active_page=1;
}
$propusk=($active_page-1)*$zapis;
if(isset($_GET['id_marka']) &&!empty($_GET['id_marka']))
{
    $query="Select id,name,har,dv,price,photo from shouse WHERE id_marka=".$_GET['id_marka']." ORDER BY price $sort LIMIT $propusk,$zapis";
}
else{
    $query="Select id,name, har, dv,price,photo from shouse  ORDER BY price $sort LIMIT $propusk,$zapis";
}


//$query="Select id,name,har,dv,price,photo from shouse LIMIT $propusk,$zapis";
$rez=mysqli_query($dbc,$query) or die("Query error");
echo"<table border=2>
<tr><th>№</th>
<th>Назва</th>
<th>характеристика</th>
<th>Дата випуску</th>";
if(isset($_GET['id_marka'])&&!empty($_GET['id_marka']))
{
    echo"<th><a href='listalka_sort_filtr.php?sort=".$sort."&id_marka=".$_GET['id_marka']."'>Ціна</a></th>";//сортуваня по айді марки і ціні
}
else{
    echo"<th><a href='listalka_sort_filtr.php?sort=".$sort."'>Ціна</a></th>";
}
echo"<th><a href='listalka_sort_filtr.php?sort=".$sort."'>Ціна</a></th>";
echo"<th>Фото</th>
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
<td><img width='240px' src='../img/".$next['photo']."'></td>
</tr>";
$num++;
}
echo"</table>";
if(isset($sort)&&$sort=="DESC")
{
    $sort1="ASC";
}

else if(isset($sort)&&$sort=="ASC")
{
    $sort1="DESC";
}

echo"<table><tr>";
if($active_page==1)
{
    echo"<td> << </td>";
}
else {
    if (isset($_GET['id_marka']) && !empty($_GET['id_marka'])) {
        echo "<td> <a href='listalka_sort_filtr.php?page=" . ($active_page - 1) . "&id_marka=" . $_GET['id_marka'] . "&sort=$sort1'> << </a></td>";
    } else {
        echo "<td> <a href='listalka_sort_filtr.php?page=" . ($active_page - 1) . "&sort=$sort1'> << </a></td>";

    }
}
    for ($i = 1; $i <= $count_page; $i++)
    {
        if ($active_page == $i)
        {
            echo "<td> $i</td>";
        }
        else
            {
            if (isset($_GET['id_marka']) && !empty($_GET['id_marka']))
            {
                echo "<td> <a href='listalka_sort_filtr.php?page=" . $i . "&id_marka=" . $_GET['id_marka'] . "&sort=$sort1'>$i</a></td>";
            }
            else
                {
                echo "<td> <a href='listalka_sort_filtr.php?page=" . $i . "&sort=$sort1'>$i</a></td>";
            }
        }
    }
    if ($active_page == $count_page)
    {
        echo "<td> >> </td>";
    }
    else {
        if (isset($_GET['id_marka']) && !empty($_GET['id_marka'])) {
            echo "<td> <a href='listalka_sort_filtr.php?page=" . ($active_page + 1) . "&id_marka=" . $_GET['id_marka'] . "&sort=$sort1'> >> </a></td>";
        } else {
            echo "<td> <a href='listalka_sort_filtr.php?page=" . ($active_page + 1) . "&sort=$sort1'> >> </a></td>";
        }
    }
echo"</table></tr>";
mysqli_close($dbc)
?>
</body>
</html>