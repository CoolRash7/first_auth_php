<html>
<body>
<?php
require 'init.php';
require 'func/f_comment.php';

session_start();

addComment($mysql);
?>
</body>
</html>