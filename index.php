<html>
<body>
<?php
session_start();
require 'init.php';
require 'func/f_user.php';
require 'func/f_comment.php';

// printComments($mysql);

// formComment();

buttonUser($mysql);

printComments($mysql);

formComment();

?>


</body>
</html>