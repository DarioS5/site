<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<?php
require_once("param.php");
if(isset($_GET['id'],$_GET['name']) &&!empty($_GET['id']) &&!empty($_GET['name']))
{
    ?>
    <form action="del_marka.php" method="POST">
          <h1>ви хочете видалити <?=$_GET['name']?> </h1>
    <input type='radio' name="del" value="yes" checked>да
    <input type="radio" name="del" value="no">нет
    <input type="hidden" name="id" value="<?=$_GET['id']?>">
    <input type="submit" name="send" value="підтвердити">
</form>
<?php
}
else if(isset($_POST['send'],$_POST['id']) &&!empty($_POST['id']) && $_POST['del']=="yes")
{
  $query="Delete from marka where id=".$_POST['id'];
  mysqli_query($dbc,$query) or die("query error");
  echo"марка успішно видалена";
  mysqli_close($dbc);

}
else{
    echo"видалення відмінено або неможливе";


}
?>
<br>
<a href="index_marka.php">список марок </a>
</body>
</html>