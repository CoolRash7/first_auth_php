<?php

//form
function formUploadImage() {
    print <<<_HTML
    <form action="upload_image.php" method="post" enctype="multipart/form-data">
        <input type="file" name="user_avatar"/>
        <button type="submit">Upload</button>
    </form>

    _HTML;
}

?>