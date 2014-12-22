<?php
$uploaddir = '../../images/';

$path = $_FILES['userfile']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);
$nombre="img_".rand(9, 9999999).".".$ext;

$uploadfile = $uploaddir . $nombre;

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
  echo $nombre;
} else {
  echo "null";
}
?>