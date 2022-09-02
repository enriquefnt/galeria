<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<div id="post-box">
    <form method="post" enctype="multipart/form-data">
        <textarea name="post_title" class="photo-caption"></textarea>
        <div id="post-box-footer">
            <input type="file" name="media-file-input"
                id="media-file-input" />
            <div class="photo-icon">
                <img src="photo.png" />
            </div>
            <input type="submit" name="save_to_fb" class="photo_publish">
        </div>
    </form>
</div>


<?php
require_once 'FBUserPhoto.php';
$fbUserPhoto = new FBUserPhoto();
if(!empty($_POST["upload_to_fb"])) {
    $photoPath = "";
    if(!empty($_FILES["media_file_input"]["name"])) {
        $uploadFile = "uploads/" . basename($_FILES["media_file_input"]["name"]);
        if (move_uploaded_file($_FILES["media_file_input"]["tmp_name"], $uploadFile)) {
            $photoPath = $uploadFile;
        }
    }
    $fbUserPhoto->uploadPhoto($_POST["photo_caption"],$photoPath);
}
$postData = $fbUserPhoto->getPhotos();
?>


</body>
</html>