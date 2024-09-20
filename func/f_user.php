<?php

function formNewUser() {
    print <<<_HTML
    <form method="POST" action="../user/registration.php">

    Введите ваш логин:
    <input type="text" name="name">
    <br>
    Введите вашу почту:
    <input type="text" name="email">
    <br>
    Введите ваш пароль:
    <input type="pass" name="pass">
    <br>

    <input type="submit" value="Зарегестрироватся">
    </form>
    _HTML;
}

function formLoginUser() {
    print <<<_HTML
    <form method="POST" action="../user/login.php">

    Имя/Почта:
    <input type="text" name="login">
    <br>

    Почта:
    <input type="text" name="pass">
    <br>

    <input type="submit" value="Войти">
    </form>

    <a href="../user/registration.php">Нету аккаунта? Зарегестрируйтесь!</a>
    _HTML;
}

function printUserData($mysql) {
    if (isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
        $user = $mysql->query("SELECT * FROM `users` WHERE '$name'=`name`");

        $first = $user->fetch_assoc();
        print "imgavavar: ".$first['img_avatar'];
        if (strlen($first['img_avatar']) <=0) {
            print <<<_HTML
                <img src="../res/avatar_none.png" alt="avatar_none" width="30px">
                _HTML;
        } else {
            print <<<_HTML
                <img src="../php_test/$first[img_avatar]" alt="avatar_none" width="30px">
                _HTML;
        }
        print <<<_HTML
        <p>Имя: $first[name]</p></br>
        <p>Почта: $first[email]</p></br>
        <p>Зарегестрировался: $first[created]</p></br>
        <p>Пароль: $first[pass]</p></br>
        </br>
        <a href='../user/logout.php'>Выйти</a>

        _HTML;
    }
}

function buttonUser($mysql) {
    if (isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
        $user = $mysql->query("SELECT * FROM `users` WHERE '$name'=`name`");
        $first = $user->fetch_assoc();

        print <<<_HTML
        <p>Добро пожаловать, <a href="../user/lk.php">$first[name]</a> </p><br>
        _HTML;

    } else {
        print <<<_HTML
        <p>Вы еще не вошли. <a href="../user/login.php">Войти</a></p>
        _HTML;
    }
}

function uploadAvatar() {

    
}

function formUploadAvatar() {
    print <<<_HTML
    <form action="../user/upload_avatar.php" method="post" enctype="multipart/form-data">
        <input type="file" name="user_avatar"/>
        <button type="submit">Upload</button>
    </form>

    _HTML;
}

?>