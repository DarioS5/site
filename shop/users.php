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
require_once("admin/param.php");
if(!isset($_POST['send']))
{
?>
<form action="users.php" method="post" enctype="multipart/form-data">
    <input type="text" placeholder="Введіть ім'я" name="name"><br>
    <input type="text" placeholder="Введіть логін" name="login"><br>
    <input type="password" placeholder="Введіть пароль" name="password"><br>
    <input type="password" placeholder="Повторіть пароль" name="password1"><br>
    <input type="text" placeholder="Введіть емейл" name="email"><br>
    <input type="text" placeholder="Введіть тел" name="phone"><br>
<label>Оберть фото</label><br>
    <input type="file" name="photo"><br>

    <input type="submit" name="send" value="зареєструватися"><br>

</form>

<?php
}
else if(isset($_POST['send'],$_POST['name'],$_POST['login'],$_POST['password'],$_POST['password1'],$_POST['email'],$_POST['phone'])&&!empty($_POST['name'])&&!empty($_POST['login'])&&!empty($_POST['password'])&&$_POST['password']==$_POST['password1']&&!empty($_POST['email'])&&!empty($_POST['phone']))
{
    if($_FILES['photo']['error']==0)
    {
      $filenameTMP=$_FILES['photo']['tmp_name'];
      $filename=time().$_FILES['photo']['name'];
      move_uploaded_file($filenameTMP,"img/$filename");
      $query="Insert into users(name,login,password,email,phone,avatar) values('".$_POST['name']."','".$_POST['login']."',sha1('".$_POST['password']."'),'".$_POST['email']."','".$_POST['phone']."','".$filename."')";

          //sha1 шифрує парол в хеш ннабор в момент додання його до бд
    }
    else{
        $query="Insert into users(name,login,password,email,phone) values('".$_POST['name']."','".$_POST['login']."',sha1('".$_POST['password']."')";
    }
    echo $query;
    mysqli_query($dbc,$query) or die("query error");
    echo"Ви успішно зареєстровані";
}
else{
    echo"Недостатньо даних для реєстрації<a href='users.php'>назад</a>";

}
mysqli_close($dbc);

?>

</body>
</html>