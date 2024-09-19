<?php

require '../init.php';
require '../func/f_user.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $post_pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $error = false;

    if (is_null($post_login) || !$post_login) {
        print "Вы не ввели и имя.  ";
        $error = 1;
    }

    if (is_null($post_pass) || !$post_pass) {
        print "Вы не ввели пароль. ";
        $error = 1;
    }

    if ($error) {
        //error post
        formLoginUser();
    } else {
        //success post
        $result_user = $mysql->query("SELECT * FROM `users` WHERE '$post_login'=`name` AND '$post_pass'=`pass`");
        $result_email = $mysql->query("SELECT * FROM `users` WHERE '$post_login'=`email` AND '$post_pass'='pass'");

        $exists_user = true;
        if ($result_user->num_rows > 0) {
            $first = $result_user->fetch_assoc();
            session_start();
            $_SESSION['name'] = $first['name'];
            header("Location: ../");
            exit();
        } elseif ($result_email->num_rows > 0) {
            $first = $result_email->fetch_assoc();
            session_start();
            $_SESSION['name'] = $first['name'];
            header("Location: ../");
            exit();
        } else {
            $exists_user = false;
        }

        if (!$exists_user) {
            if ($post_login || $post_pass)
                print "Вы неправильно ввели логин или пароль.";
            formLoginUser();
        }
    }
} else {
    formLoginUser();
}

?>