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
$query="Select id,name,photo from shouse";
$rez=mysqli_query($dbc,$query) or die("query error");
echo"<table border='3'>
<tr><th>№</th>
<th>фото</th>
<th>назва</th>
<th>редагувати</th>
<th>видалити</th>
</tr>";
$count=1;
while($next=mysqli_fetch_array($rez)) {
    $id = $next['id'];
    $name = $next['name'];
    $photo=$next['photo'];
    if(empty($photo)){
        $photo="no.png";
    }
    echo "<tr><td>$count</td>
<td><img width='130px' src='../img/".$photo."'> </td>
<td>$name</td>
<td><a href='edit.php?id=" . $id . "'>редагувати</a></td>
<td><a href='del.php?id=" . $id . "&name=".$next['name']."'>видалити</a></td>
</tr>";
    $count++;
}
echo"</table>";
mysqli_close($dbc);
?>

</body>
</html>



