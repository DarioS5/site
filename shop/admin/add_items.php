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
if(!isset($_POST['send']))
{
    ?>
<form action="add_items.php" method="post" enctype="multipart/form-data"><!-- enctype="multipart/form-data"- обовязковий параметр для передачі формою файлів працює в парі з методом пост якщо його не буде файли передаваться не будуть-->
    <input type="text" placeholder="введіть назву товару" name="name">
    <br>
    <textarea name="har" placeholder="введіть характеристику товару"></textarea><br>
    <input type="date" placeholder="введіть дату" name="dv">
    <br>
    <input type="price" placeholder="введіть ціну" name="price">
    <br>
    <label>виберіть фото</label>
    <br>
    <input type="file" name="photo"><br>
    <label> оберіть категорію </label>
    <br>
    <select name="id_marka">

        <?php
        $queryM="Select id,name from marka";
        $rezM=mysqli_query($dbc,$queryM) or die("queryM error");
        while($nextM=mysqli_fetch_array($rezM))
        {
            echo"<option value='".$nextM['id']."'>".$nextM['name']."</option>";

        }
        ?>
    </select><br>
    <input type="submit" name="send" value="додати">
</form>


    <?php
}
else if(isset($_POST['send'], $_POST['name'],$_POST['har'],$_POST['dv'],$_POST['price'] , $_POST['id_marka'])  && !empty($_POST['name']) && !empty($_POST['har']) && !empty($_POST['dv']) && !empty($_POST['price'])){
    /*
     * робота з файлами
     * при завантаження файла він попадає в спеціальний суперглобальний масив $_FILES в який можуть попати декілька файлів від одного користувача тому в масиві створиться елемент наприклад:$_FILE['photo']- назва елементу лтримана з html форми з елементу   <input type="file" name="photo"><br>
     * суперголобаний масив FILES для кожного завантаженого файлу мж 5 вл.
     * 1. $_FILES['photo']['size']- повертає розмір завантаженого файлу
     *
     * 2. $_FILES['photo']['type']- повертає мемотип завантаженого файду наприклад- img/png text/doc
     * 3.$_FILES['photo']['name']- повертає назву файла як він називався на пк клієнта
     * 4. $_FILES['photo']['tmp_name']- повертає тимчасове місце та тимчасову назву файла на сервері
     * 5. $_FILES['photo']['error']- повертає помилку завантаження файлу на сервер якщо файл на сервері завантажився успішно то код помилки=0
     *
     */
    if($_FILES['photo']['error']==0)// пеервіряємо якщо файл на сервер авантажився успішно
    {
        $filenameTMP=$_FILES['photo']['tmp_name'];//  отримуємо тимчасову назву та місце розташування файлу на сервері
        $filename=time().$_FILES['photo']['name'];// отримуємо назву як називався файл на пк клієнта та хмінюємо її ф-цією тайм додавши мілісікунди до початку назви файла
        move_uploaded_file($filenameTMP, "../img/$filename");// ф-ція пеерміщає файл в указуну папку сайта та перейменовує його
        //ф-ція має параметри 1. де файл на сервері взять 2. куди файл положить і як його назвать
        // запит містить назву завантаженого файлу

        $query="Insert into shouse(name,har,dv,price,id_marka , photo) values('".$_POST['name']."', '".$_POST['har']."', '".$_POST['dv']."','".$_POST['price']."','".$_POST['id_marka']."', '".$filename."')";

    }
    else{// інакше запит буде містити всі дані про товар крім файлу
        $query="Insert into shouse(name,har,dv,price,id_marka) values('".$_POST['name']."', '".$_POST['har']."', '".$_POST['dv']."','".$_POST['price']."','".$_POST['id_marka']."')";
    }


    echo"$query";
    mysqli_query($dbc,$query) or die("query error");
    echo"ваші дані відправлені";
mysqli_close($dbc);

}
else {
    echo "недостатньо даних для додання <a href='add_items.php'>додати знову</a>";
}
?>
</body>
</html>