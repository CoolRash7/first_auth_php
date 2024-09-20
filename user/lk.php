<?php
session_start();

require '../init.php';
require '../func/f_user.php';

printUserData($mysql);

formUploadAvatar();
?>