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
/////////////////////
$zapis=3;//змінна зберігає к-сть записів які бууть показуваться на сторінці
$queryZ="Select id from shouse";//запит вибирає з бд найменше поле яке гарантовано є в кожному рядку(товарі) значення не цівтить цікавить к-сть(полів)

$rezZ=mysqli_query($dbc,$queryZ) or die("query error1");
$count_zapis=mysqli_num_rows($rezZ);//ф-ція mysqli_num_rows підраховує к-сть рядків в результаті запиту селект який отримали від бд
$count_pages=ceil($count_zapis/$zapis);//в результаті ділення к-сті записі всього в бд на к-сть записів однієї сторінки - отримуємо к-сть сторінок
//ф-ція ceil округля результат ділення до більшого цілого
//round- округля резульать до найблищого цілого
//floor-до найменшого цілого
//echo"$count_pages";
if(isset($_GET['page']))// якщо нажата силка в листалці то це значить що користувач обрав сторінку товари яої хоче перегляянуть
{
    $aktive_page=$_GET['page'];//отримуємо номер активної сторінки на яку переходить користувач

}
else{// інакше якщо посилка не нажата то номер активної сторінки 1
    $aktive_page=1;
}
$propusk=($aktive_page-1)*$zapis;// змінна зберігає к-сть записів які потрібно пропустити перед показом записів активної сторінки
// від активної сторінки віднімаємо 1 отримуємо к-сть попередніх сторінок перемножаємо на к-сть записів однієї сторінки отримуємо загальну к-сть записів які необхідно пропустити

/// ///////////////////
$query="Select id,name,har,dv,price,photo from shouse LIMIT $propusk,$zapis";// встановлюємо ліміт який має 2 параметри 1.к-сть записів в бд які необхідно пропустити
//2. к-сть записів які небхідно показати (вибрати з бд)


$rez=mysqli_query($dbc,$query) or die("query error");
echo"<table border='2'>
<tr><th>№</th>
<th>назва</th>
<th>характеристика</th>
<th>дата виходу</th>
<th>ціна</th>
<th>фото</th>
</tr>";
$num=$propusk+1;//??(номерація товарів 1.2.3 і на наступній сторінці +1=4)змінна зберігає номер першого запису кожно сторінки якщо перща сторінка то змінна пропуск буде 0 до якого додамо 1 отримаємо номер першої записі 1
while($next=mysqli_fetch_array($rez))
{
    if(empty($next['photo']))
    {
        $next['photo']="no.png";
    }
    echo"<tr><td>".$num."</td>
<td>".$next['name']."</td>
<td>".$next['har']."</td>
<td>".$next['dv']."</td>
<td>".$next['price']."</td>
<td><img width='300' src='../img/".$next['photo']."'></td>
</tr>";
    $num++;
}
echo"</table>";
//////////////////
echo"<table><tr>";
if($aktive_page==1)
{
    echo"<td> << </td>";

}
else {
    echo "<td><a href='listalka.php?page=" . ($aktive_page - 1) . "'> << </a></td>";
}
for($i=1;$i<=$count_pages;$i++)// робимо не посилку на активну сторінку. і посилку на неактивну сторінку
{
    if($aktive_page==$i)// якщо співпадає номер активної сторінки( які зараз показується) з номером сторінки то робимо цей номер сторінки не посилкою а всі наступні посилкою

    {
        echo"<td>$i</td>";

    }
    else {

        echo "<td><a href='listalka.php?page=" . $i . "'>$i</a></td>";
    }

}

if($aktive_page==$count_pages)//якщо активна сторінка відповідає останній то стрілочки робимо не посилками інакше посилками
{
    echo"<td> >> </td>";

}
else {

    echo "<td><a href='listalka.php?page=" . ($aktive_page + 1) . "'> >> </a></td>";
}


echo"</tr></table>";

/// /////////////////
mysqli_close($dbc);
?>

</body>
</html>