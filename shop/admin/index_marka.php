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
require_once("param.php");
$query="Select id,name from marka";
$rez=mysqli_query($dbc,$query) or die("query error");
echo"<table border='2'>
<tr><th>№</th>
<th>назва</th>
<th>редагування</th>
<th>видалення</th>
</tr>";
while($next=mysqli_fetch_array($rez))
{
    echo"<tr>
        <td>".$next['id']."</td>
        <td>".$next['name']."</td>
        <td><a href='edit_marka.php?id=".$next['id']."'>редагувати</a></td>
        <td><a href='del_marka.php?id=".$next['id']."&name=".$next['name']."'>видалити</a></td></tr>";

}
echo"</table>";
?>

</body>
</html>