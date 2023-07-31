<?php
require_once("../connMySQL.php");
echo "<pre>";
var_dump($_FILES);


// // tạo truy vấn INSERT để lưu trữ ảnh trong cơ sở dữ liệu
if (count($_FILES) > 0) {

  // lấy thông tin về tệp ảnh
  $file_name = $_FILES["img_post"]["name"];
  $file_size = $_FILES["img_post"]["size"];
  $file_tmp = $_FILES["img_post"]["tmp_name"];
  $file_type = $_FILES["img_post"]["type"];

  // mở tệp ảnh và đọc dữ liệu
  $fp = fopen($file_tmp, 'r');
  $data = fread($fp, filesize($file_tmp));
  $data = addslashes($data);
  fclose($fp);
  $sql = $pdo->prepare("INSERT INTO images (name, size, type, data) VALUES ('$file_name', '$file_size', '$file_type', '$data')");
  $sql->execute();
  echo "Thành công";
} else {
  echo "Thất bại";
}
      // thực hiện truy vấn
