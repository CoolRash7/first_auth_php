<html>
<body>
<?php
// session_start();
require 'init.php';
require 'func/f_user.php';
require 'func/f_comment.php';
require 'func/f_upload_image.php';

// printComments($mysql);

// formComment();

buttonUser($mysql);

printComments($mysql);

formComment();

print "<br><br>";

formUploadImage();


?>


</body>
</html>