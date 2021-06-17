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

///////////////
$queryM="Select id,name from marka";
$rezM=mysqli_query($dbc,$queryM) or die("query error");
while($nextM=mysqli_fetch_array($rezM))
{
    echo"<a href='listalka_filtr.php?idmarka=".$nextM['id']."'>".$nextM['name']."</a> |";
}
echo"<a href='listalka_filtr.php'> Всі</a>";

////////////////
$zapis="3";
if(isset($_GET['idmarka']) && !empty($_GET['idmarka']))
{
    $queryZ="Select id from shouse WHERE id_marka=".$_GET['idmarka'];

}
else{
    $queryZ="Select id from shouse";
}

$rezZ=mysqli_query($dbc,$queryZ) or die("query error1");
$count_zapis=mysqli_num_rows($rezZ);
$count_pages=ceil($count_zapis/$zapis);
if( isset($_GET["page"]))
{
    $aktive_page=$_GET["page"];
}
else{
    $aktive_page=1;
}

$propusk=($aktive_page-1)*$zapis;
if(isset($_GET['idmarka']) &&!empty($_GET['idmarka']))
{
    $query = "Select id,name,har,dv,price,photo from shouse WHERE id_marka=".$_GET['idmarka']." LIMIT $propusk,$zapis";

}
else {

    $query = "Select id,name,har,dv,price,photo from shouse LIMIT $propusk,$zapis";
}

//echo"$query";
$rez=mysqli_query($dbc,$query) or die("query error2");
echo"<table border='2'>
<tr><th>№</th>
<th>назва</th>
<th>характеристика</th>
<th>дата виходу</th>
<th>ціна</th>
<th>фото</th>
</tr>";
$num=$propusk+1;

while($next=mysqli_fetch_array($rez))
{
    if(empty($next['photo']))
    {
        $next['photo']="no.png";
    }
    echo"<tr>
<td>".$next['id']."</td>
<td>".$next['name']."</td>
<td>".$next['har']."</td>
<td>".$next['dv']."</td>
<td>".$next['price']."</td>
<td><img width='300' src='../img/".$next['photo']."' </td>
</tr>";
$num++;
}
echo"</table>";

echo"<table><tr>";
if($aktive_page==1)
{
echo"<td> << </td>";
}
else{
    if(isset($_GET['idmarka']) &&!empty($_GET['idmarka']))
    {
        echo"<td><a href='listalka_filtr.php?page=".($aktive_page-1)."&idmarka=".$_GET['idmarka']."'> << </a></td>";

    }
    else {

        echo "<td><a href='listalka_filtr.php?page=" . ($aktive_page - 1) . "'> << </a></td>";
    }
}
for($i=1;$i<=$count_pages;$i++) {
    if ($aktive_page == $i) {
        echo "<td> $i</td>";

    } else {
        if(isset($_GET['idmarka']) &&!empty($_GET['idmarka']))
        {
            echo "<td> <a href='listalka_filtr.php?page=" . $i . "&idmarka=".$_GET['idmarka']."'>$i</a></td>";
        }
            else {


                echo "<td> <a href='listalka_filtr.php?page=" . $i . "'>$i</a></td>";
            }
    }
}
    if($aktive_page==$count_pages) {
        echo "<td> >> </td>";
    }
        else{
            if(isset($_GET['idmarka']) &&!empty($_GET['idmarka']))//перевіряємо якщо є фйдімарки то посилка яка передає номер сторінки повинна передавати ще айдімарки
            {
                echo"<td> <a href='listalka_filtr.php?page=".($aktive_page+1)."&idmarka=".$_GET['idmarka']."'> >> </a></td>";// добавляємо параметром в посилці айдімарки
}

    else{
        echo "<td> <a href='listalka_filtr.php?page=" . ($aktive_page + 1). "'> >> </a></td>";
    }


}
echo"</tr></table";
mysqli_close($dbc);
?>

</body>
</html>