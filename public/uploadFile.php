<?php
$target_dir = __DIR__ . "/../uploads/";
$target_file = $target_dir . "data.txt";
$uploadOk = 1;

session_start();
unset($_SESSION['FILE_UPLOADED']);
// Check if txt file is real or fake
if(isset($_POST["submit"])) {
  $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an txt file wiht size - " . $check;
    $uploadOk = 1;
  } else {
    echo "File is a real txt file.";
    $uploadOk = 0;
  }
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    $_SESSION['FILE_UPLOADED'] = true;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>