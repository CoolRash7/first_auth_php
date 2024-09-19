<?php


function printComments($mysql) {
    print "<h1>Комментарии долбоебов</h1>";
    $result = $mysql->query("SELECT * FROM `comments`");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            print <<<_HTML
            <b>$row[name] (написал $row[date])</b>
            <p>$row[comment]</p>
            _HTML;

            if (isset($_SESSION['name']) && $row['name'] == $_SESSION['name']) 
                print <<<_HTML
                <a href="/change_comment.php?id=$row[id]">Изменить комментарий</a></br></br>
                _HTML;

        }
    } else {
        print "<h2> нету комментариев :(</h2>";
    }
}

function addComment($mysql) {
   
    if(!isset($_SESSION['name']) ) {
        print "Вы не вошли в сайт. Для комментария нужно логин.";
        return;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $post_comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $error = false;

        if (is_null($post_comment) || !$post_comment) {
            print('нету комментария (comment)');
            $error = 1;
        }

        if ($error) {
            //FAIL
            formComment();
        } else {
            //SUCCESS
            print "Вы успешно добавили комментарий!";
            $user_name = $_SESSION['name'];
            $mysql->query("INSERT INTO `comments` (`name`, `comment`) VALUE ('$user_name', '$post_comment')");
            header("Location: ../");
            exit();
        }
    } 

}

//forms
function formComment() {
    if(!isset($_SESSION['name']) ) {
        print "Вы не вошли в сайт. Для комментария нужно логин.";
        return;
    }

    print <<<_HTML
    <br><br>
    <form method='POST' action="add_comment.php">
    $_SESSION[name]
    <br>
    Ваш комментарий: <input type="text" name="comment"><br>
    <input type="submit" value="Добавить комментарий">
    </form>
    _HTML;
}

function formChangeComment($mysql) {

    $post_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if (is_null($post_id) || (!$post_id && $post_id > 0)) {
        print "ебанат, где ID сука? ты совсем ебанутый?";
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $post_comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (is_null($post_comment) || !$post_comment) {
            print "Пустой комментарий чет бро... Не удалось кароч обновить комментарий";
            return;
        }

        $result = $mysql->query("UPDATE `comments` SET `comment` = '$post_comment' WHERE '$post_id' = `id`");
        header("Location: ../");
        exit();

       
    } else {

        $result = $mysql->query("SELECT * FROM `comments` WHERE '$post_id' = `id`");

        $first = $result->fetch_assoc();

        if ($first) {
            print <<<_HTML
            <br><br>
            <form method='POST' action="change_comment.php?id=$post_id">

            Ваш комментарий: <input type="text" name="comment" value="$first[comment]"><br>
            <input type="submit" value="Изменить комментарий">
            </form>
            _HTML;
        } else {
            print "не нашли такого комментария с такой id :(";
        }

        
    }


    
}
?>