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
$query="Select id,name,har,dv,price,photo from shouse";
if(isset($_GET['sort']))
{
    $sort=$_GET['sort'];
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
    $query=$query." ORDER BY price $sort";//до запиту буде добавлено параметр сортування по ціні


}
///////////////////////////

if(isset($_GET['sort1']))
{
    $sort1=$_GET['sort1'];
    switch($sort1)
    {
        case "ASC":
            $sort1="DESC";
            break;
        case "DESC":
            $sort1="ASC";
            break;
        default:
            $sort1="ASC";
            break;
    }
    $query.=" ORDER BY name $sort1";// до запиту буде добавлено параметр сортування по назві
}
    // //////////////////////////
 // оператор ORDER BY - сортовати по і вказуємо назву полля по яому сортуємо а після назви вказуємо оператор аск- по збільшенню і деск-по зменшенню

$rez=mysqli_query($dbc,$query) or die("query error");
echo"<table border=2>
<tr><th>№</th>
<th> <a href='sort.php?sort1=".$sort1."'>Нaзва</a></th>
<th>Характеристика</th>
<th>ДАта виходу</th>
<th> <a href='sort.php?sort=".$sort."'>Ціна</a></th>
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