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
if(!isset($_POST['send'])) {
    ?>
    <form action="login.php" method="post" enctype="multipart/form-data">
        <input type="text" placeholder="Введіть логін" name="login"><br>
        <input type="password" placeholder="Введіть пароль" name="password"><br>
        <input type="submit" name="send" value="Вхід"><br>

    </form>
    <?php
}
else if(isset($_POST['send'],$_POST['login'],$_POST['password'])&&!empty($_POST['login'])&&!empty($_POST['password'])) {
    $query = "Select id,name,email,phone,avatar from users WHERE login='" . $_POST['login'] . "' AND password=sha1('" . $_POST['password'] . "')";
    $rez = mysqli_query($dbc, $query) or die("query error");
    if (mysqli_num_rows($rez) == 1) {//перевіряємо якщо запит пеервіряє 1 рядок то такий користувач у нас унікальний і вхід  є правильним
        $next = mysqli_fetch_array($rez);
        echo "Ви зайшли<br>
        <H4>Ваше ім'я:" . $next['name'] . "</H4>
        <H4>Ваш телефон:" . $next['phone'] . "</H4>
        <H4><img src='img/" . $next['avatar'] . "' width='150px' style='border_radius:8px'></H4>";

    } else {
        echo "Невірний логін  або пароль<a href='users.php'>назад</a>";

    }
}
else {

        echo"Недостатньо даних для входу <a href='login.php'>нзад</a>";
    }


mysqli_close($dbc);
?>

</body>
</html>