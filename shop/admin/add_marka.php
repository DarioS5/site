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
if(!isset($_POST['send']) ) {


    ?>
    <form action='add_marka.php' method="POST">
        <input type="text" name="name" placeholder="введіть назву марки">
        <input type="submit" name="send" value="додати">

    </form>
    <?php
}
else if(isset($_POST['send'],$_POST['name']) && !empty($_POST['name'])){
    require_once('param.php');
$query="insert into marka(name) value('".$_POST['name']."')" ;
mysqli_query($dbc,$query) or die("query error");
echo"марка додана<br>";
mysqli_close($dbc);
}
else{
    echo"не введена назва марки";
}

?>
<a href="add_marka.php">додати знову</a>

</body>
</html>