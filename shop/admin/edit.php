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
    $query = "Select  id,name,har,dv,price,photo,id_marka from shouse WHERE id=" . $_GET['id'];
    $rez = mysqli_query($dbc, $query) or die("query error");
    $next = mysqli_fetch_array($rez);
    if(empty($next['photo']))
    {
        $next['photo']="no.png";

    }
    ?>
    <form action="edit.php" method="post" enctype="multipart/form-data">
        <label>змініть назву товару</label><br>
        <input type="text" name="name" value="<?= $next['name'] ?>">
        <br>
        <label>змініть характерисику</label>
        <br>
        <textarea name="har"> <?=$next['har']?></textarea><br>
        <label>відредагуйте дату</label><br>
       <input type="date" name="dv" value="<?=$next['dv']?>"><br>
        <label>відредагуйте ціну</label><br>
        <input type="text" name="price" value="<?=$next['price']?>"><br>
        <br>
        <img src="../img/<?=$next['photo']?>" width="250px"><br>
        <input type="hidden" name="oldphoto" value="<?=$next['photo']?>">

        <label>виберіть фото</label>
        <br>
        <input type="file" name="newphoto"><br>
        <label>виберіть категорію</label>
        <br>
        <select name="id_marka">
            <?php
            $queryM="Select name,id from marka";

            $rezM=mysqli_query($dbc,$queryM) or die("query error");
            while($nextM=mysqli_fetch_array($rezM)){
                if($next['id_marka']==$nextM['id']) {// перевіряємо якщо id_marka з таблиці товари співпадає з id із таблиці марка то в елемент оптіоп обавляємо параметр селет який буде помічати марку як вибрану (як встановлено по замовчування)
                    echo "<option selected value='" . $nextM['id'] . "'> " . $nextM['name'] . "</option>";
                }
                else{
                    echo "<option  value='" . $nextM['id'] . "'> " . $nextM['name'] . "</option>";

                }

            }


            ?>
        </select><br>

        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <input type="submit" name="send" value="редагувати">
    </form>
    <?php
}
else if(isset($_POST['send'],$_POST['id'],$_POST['name'],$_POST['har'],$_POST['dv'],$_POST['price'], $_POST['id_marka'])&&!empty($_POST['id']) &&!empty($_POST['name']) &&!empty($_POST['har']) &&!empty($_POST['dv']) &&!empty($_POST['price']))
{
 if($_FILES['newphoto']['error']==0)
 {
     if(isset($_POST['oldphoto']) && $_POST['oldphoto']!="no.png")
     {
         unlink("../img/".$_POST['oldphoto']);
     }
     $filenameTMP=$_FILES['newphoto']['tmp_name'];
     $filename=time().$_FILES['newphoto']['name'];
     move_uploaded_file($filenameTMP, "../img/$filename");
     $query="Update shouse SET name='".$_POST['name']."', har='".$_POST['har']."', dv='".$_POST['dv']."', price='".$_POST['price']."',id_marka='".$_POST['id_marka']."', photo='".$filename."' WHERE id=".$_POST['id'];
 }
 else {

     $query = "Update shouse SET name='" . $_POST['name'] . "', har='" . $_POST['har'] . "', dv='" . $_POST['dv'] . "', price='" . $_POST['price'] . "',id_marka='" . $_POST['id_marka'] . "' WHERE id=" . $_POST['id'];
 }
    mysqli_query($dbc,$query)or die("query error");
    echo"ваші дані відредаговано";
}
else{
    echo"редагування відмінено або неможливе";
}
?>
<a href="index_item.php">список товарів</a>


</body>
</html>