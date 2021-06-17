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
if(isset($_GET['id']) &&!empty($_GET['id'])) {
    $query = "Select name from marka WHERE id=" . $_GET['id'];
    $rez = mysqli_query($dbc, $query) or die("query error");
    $next = mysqli_fetch_array($rez);
    ?>
    <form action="edit_marka.php" method="post">
        <label>змініть назву марки</label>
        <br>
        <input type="text" name="name" value="<?= $next['name'] ?>">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <input type="submit" name="send" value="редагувати">
    </form>
    <?php
}
else if(isset($_POST['send'],$_POST['name'],$_POST['id']) &&!empty($_POST['name']) &&!empty($_POST['id']))
{
    $query="Update marka SET name='".$_POST['name']."' WHERE id=".$_POST['id'];
    mysqli_query($dbc,$query) or die("query error");
    echo"ваші дані відредаговано";

}
else{
    echo"редагування відмінено або неможливе";
}

?>
<a href="index_marka.php">список марок</a>

</body>
</html>