<?php
require '../init.php';
require '../func/f_user.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $post_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $post_pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $error = false;
    if (is_null($post_name) || !$post_name) {
        print "Вы не ввели имя.";
        $error=1;
    }

    if (is_null($post_email) || !$post_email) {
        print "Вы не ввели почту. ";
        $error=1;
    }

    if (is_null($post_pass) || !$post_pass) {
        print "Вы не ввели пароль. ";
        $error=1;
    }
    if ($error)
        //fail
        formNewUser();
    else {
        //success
        $error = false;

        $exists_name = $mysql->query("SELECT `name` FROM `users` WHERE '$post_name'=`name`");
        $exists_email = $mysql->query("SELECT `email` FROM `users` WHERE '$post_email'=`email`");

        if ($exists_name->num_rows > 0) {
            print "Пользователь с таким именем существует. пожалуйста поменяйте имя. ";
            $error = 1;
        }

        if ($exists_email->num_rows > 0) {
            print "Пользователь с таким почтой существует. поменятйе email. ";
            $error = 1;
        }

        if ($error) {
            formNewUser();
        } else {
            $mysql->query("INSERT INTO `users` (`name`, `email`, `pass`) VALUE ('$post_name', '$post_email', '$post_pass')");
            //session_start();
            $_SESSION['name'] = $post_name;
            header("Location: ../");
            exit();
        }
        
    }
} else {
    formNewUser();
}
?>